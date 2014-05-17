<?php
App::uses('AppController', 'Controller');
/**
 * Agencies Controller
 *
 * @property Agency $Agency
 */
class AgenciesController extends AppController {
	
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
		$this->Agency->recursive = 0;
		$this->set('agencies', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Agency->id = $id;
		if (!$this->Agency->exists()) {
			throw new NotFoundException(__('Invalid agency'));
		}
		$this->set('agency', $this->Agency->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Agency->create();
			if ($this->Agency->save($this->request->data)) {
				$this->Session->setFlash(__('The agency has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The agency could not be saved. Please, try again.'));
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
		$this->Agency->id = $id;
		if (!$this->Agency->exists()) {
			throw new NotFoundException(__('Invalid agency'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Agency->save($this->request->data)) {
				$this->Session->setFlash('The agency has been saved!', 'flash_custom', array('class' => 'alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The agency could not be saved. Please, try again.', 'flash_custom', array('class' => 'alert-error'));
			}
		} else {
			$this->request->data = $this->Agency->read(null, $id);
		}
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
		$this->Agency->id = $id;
		if (!$this->Agency->exists()) {
			throw new NotFoundException(__('Invalid agency'));
		}
		if ($this->Agency->delete()) {
			$this->Session->setFlash(__('Agency deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Agency was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
