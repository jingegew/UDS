<?php
App::uses('AppController', 'Controller');
/**
 * Projects Controller
 *
 * @property Project $Project
 */
class ProjectsController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('select');
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->set('title_for_layout', __d('default', 'My Projects'));
		$this->Project->recursive = 0;

		//Privilege
		$this->loadModel('Privilege');

		$privileges = $this->Privilege->find('all', array('conditions' => array('Privilege.user_id' => $this->Auth->user('id'))));

		$ids = array();
		foreach($privileges as $privilege){
			$ids[] = $privilege['Privilege']['project_id'];
		}

		$projects2 = $this->Project->find('all', array('conditions' => array('Project.id' => $ids)));

		$projects = $this->Project->find('all', array('conditions' => array('Project.user_id' => $this->Auth->user('id'))));

		$this->set('projects', array_merge($projects, $projects2));
		$users = $this->Project->User->find('list');
		$grants = $this->Project->Grant->find('list');
		$this->set(compact('users', 'grants'));

	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(__('The project has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The project could not be saved. Please, try again.');
			}
		} else {
			$this->request->data = $this->Project->read(null, $id);
		}
		//Inactive PI
		$users = $this->Project->User->find('list' , array('conditions' => array('User.role_id' => 2, "User.status" => 1), 'fields' => array('User.id','User.first_name')));
		$this->set(compact('users'));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Project->create();
			$project['Project'] = $this->request->data;
			$project['Project']['user_id'] = $this->Auth->user('id');
			if ($this->Project->save($project)) {
				$this->Session->setFlash(__('The project has been saved!'), 'flash_custom', array('class' => 'alert-success'));				
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.'), 'flash_custom', array('class' => 'alert-error'));
			}
		}
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(__('The project has been saved!'), 'flash_custom', array('class' => 'alert-success'));	
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.'), 'flash_custom', array('class' => 'alert-error'));
			}
		} else {
			$this->request->data = $this->Project->read(null, $id);
		}
		//Inactive PI
		$users = $this->Project->User->find('list' , array('conditions' => array('User.role_id' => 2, "User.status" => 1), 'fields' => array('User.id','User.first_name')));
		$grants = $this->Project->Grant->find('list' , array('fields' => array('Grant.id','Grant.name')));		
		$this->set(compact('users','grants'));
	}

	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Project->id = $id;
		if (!$this->Project->exists()) {
			throw new NotFoundException(__('Invalid project'));
		}
		if ($this->Project->delete()) {
			$this->Session->setFlash(__('Project deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Project was not deleted');
		$this->redirect(array('action' => 'index'));
	}

	public function select(){
		$this->autoRender = false;
		$this->Project->id = $_POST['id'];
		if (!$this->Project->exists()) {
			throw new NotFoundException(__('Invalid project'));
		}
		$this->Session->write('Project.id', $_POST['id']);
		$this->Session->write('Project.name', $this->Project->field('name'));
		$this->Session->write('Project.description', $this->Project->field('description'));
		$this->Session->write('Experiment.id', null);
		$this->Session->write('Experiment.name', null);
		$this->Session->write('Experiment.description', null);
	}

}
