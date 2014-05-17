<?php
App::uses('AppController', 'Controller');
/**
 * Experiments Controller
 *
 * @property Experiment $Experiment
 */
class ExperimentsController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('select');
	}
	
/**
 * index method
 *
 * @return void
 */
	public function index($id = null) {
		$this->set('title_for_layout', 'Current Experiments');
		
		if($id != null){
			$experiments = $this->Experiment->find('all', array('conditions' => array('Experiment.project_id' => $id)));
		} else if($this->Session->read('Project.id') != null) {
			$experiments = $this->Experiment->find('all', array('conditions' => array('Experiment.project_id' => $this->Session->read('Project.id'))));
		} else {
			$experiments = array();
		}
		$this->set('experiments', $experiments);
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
			if ($this->Experiment->save($this->request->data)) {
				$this->Session->setFlash(__('The experiment has been saved!'), 'flash_custom', array('class' => 'alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The experiment could not be saved. Please, try again.'), 'flash_custom', array('class' => 'alert-error'));
			}
		} else {
			$this->request->data = $this->Experiment->read(null, $id);
		}
		
		$this->loadModel('Role');		
		$roles = $this->Role->find('list', array('conditions' => array('Role.id > ' => 1)));
		$this->set(compact('roles'));
		
		$this->loadModel('User');
		$users = $this->User->find('list', array('conditions' => array('user.id != ' => $this->Auth->user('id')), 'fields' => array('User.id', 'User.first_name')));
		$this->set(compact('users'));
		
		$projects = $this->Experiment->Project->find('list');
		$this->set(compact('projects'));
		
		$this->loadModel('Privilege');
		$privileges = $this->Privilege->find('all', array('conditions' => array('Privilege.experiment_id' => $id)));
		//$this->debug(json_encode($accesses));
		$this->set('privileges', $privileges);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Experiment->create();
			$experiment['Experiment'] = $this->request->data;			
			$experiment['Experiment']['project_id'] = $this->Session->read("Project.id");
			if ($this->Experiment->save($experiment)) {
				$this->Session->setFlash(__('The experiment has been saved!'), 'flash_custom', array('class' => 'alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The experiment could not be saved. Please, try again.'), 'flash_custom', array('class' => 'alert-error'));
			}
		}
		$projects = $this->Experiment->Project->find('list');
		$this->set(compact('projects'));
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
			$this->debug("EXPERIMENT : " . json_encode($this->request->data));
			if ($this->Experiment->save($this->request->data)) {
				$this->Session->setFlash(__('The experiment has been saved!'), 'flash_custom', array('class' => 'alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The experiment could not be saved. Please, try again.'), 'flash_custom', array('class' => 'alert-error'));
			}
		} else {
			$this->request->data = $this->Experiment->read(null, $id);
		}
		
		$this->loadModel('Role');		
		$roles = $this->Role->find('list', array('conditions' => array('Role.id > ' => 1)));
		$this->set(compact('roles'));
		
		$this->loadModel('User');
		$users = $this->User->find('list', array('conditions' => array('user.id != ' => $this->Auth->user('id')), 'fields' => array('User.id', 'User.first_name')));
		$this->set(compact('users'));
		
		$projects = $this->Experiment->Project->find('list');
		$this->set(compact('projects'));
		
		$this->loadModel('Privilege');
		$privileges = $this->Privilege->find('all', array('conditions' => array('Privilege.experiment_id' => $id)));
		$this->set('privileges', $privileges);
	}
	
	public function getProjectExperiments($id = null) {
		$this->set('title_for_layout', 'Current Experiments');
		$experiments = $this->Experiment->find('all', array('conditions' => array('Experiment.project_id' => $id)));
		$this->set('experiments', $experiments);
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Experiment->id = $id;
		if (!$this->Experiment->exists()) {
			throw new NotFoundException(__('Invalid experiment'));
		}
		if ($this->Experiment->delete()) {
			$this->Session->setFlash(__('Experiment deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Experiment was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	public function select(){
		$this->autoRender = false;
		$this->Experiment->id = $_POST['id'];		
		if (!$this->Experiment->exists()) {
			throw new NotFoundException(__('Invalid experiment'));
		}		
		$this->Session->write('Experiment.id', $_POST['id']);
		$this->Session->write('Experiment.name', $this->Experiment->field('name'));
		$this->Session->write('Experiment.description', $this->Experiment->field('description'));
	}
}
