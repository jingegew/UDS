<?php
App::uses('AppController', 'Controller');
/**
 * Grants Controller
 *
 * @property Grant $Grant
 */
class GrantsController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Grant->recursive = 0;
		$this->set('grants', $this->paginate());
		$agencies = $this->Grant->Agency->find('list');
		$users = $this->Grant->User->find('list');
		$this->set(compact('agencies', 'users'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Grant->id = $id;
		if (!$this->Grant->exists()) {
			throw new NotFoundException(__('Invalid grant'));
		}
		$this->set('grant', $this->Grant->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Grant->create();
			if ($this->Grant->save($this->request->data)) {
				$this->Session->setFlash('The grant has been saved!', 'flash_custom', array('class' => 'alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The grant could not be saved. Please, try again.', 'flash_custom', array('class' => 'alert-error'));
			}
		}
		$agencies = $this->Grant->Agency->find('list');
		$users = $this->Grant->User->find('list');
		$this->set(compact('agencies', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Grant->id = $id;
		if (!$this->Grant->exists()) {
			throw new NotFoundException(__('Invalid grant'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Grant->save($this->request->data)) {
				$this->Session->setFlash(__('The grant has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The grant could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Grant->read(null, $id);
		}
		$agencies = $this->Grant->Agency->find('list');
		$users = $this->Grant->User->find('list');
		$this->set(compact('agencies', 'users'));
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
		$this->Grant->id = $id;
		if (!$this->Grant->exists()) {
			throw new NotFoundException(__('Invalid grant'));
		}
		if ($this->Grant->delete()) {
			$this->Session->setFlash(__('Grant deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Grant was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
