<?php
App::uses('AppController', 'Controller');
/**
 * EntityAttributeValues Controller
 *
 * @property EntityAttributeValue $EntityAttributeValue
 */
class EntityAttributeValuesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->EntityAttributeValue->recursive = 0;
		$this->set('entityAttributeValues', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->EntityAttributeValue->id = $id;
		if (!$this->EntityAttributeValue->exists()) {
			throw new NotFoundException(__('Invalid entity attribute value'));
		}
		$this->set('entityAttributeValue', $this->EntityAttributeValue->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->EntityAttributeValue->create();
			if ($this->EntityAttributeValue->save($this->request->data)) {
				$this->Session->setFlash('The entity attribute value has been saved!', 'flash_custom', array('class' => 'alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The entity attribute value could not be saved. Please, try again.', 'flash_custom', array('class' => 'alert-error'));
			}
		}
		$entities = $this->EntityAttributeValue->Entity->find('list');
		$attributes = $this->EntityAttributeValue->Attribute->find('list');
		$this->set(compact('entities', 'attributes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->EntityAttributeValue->id = $id;
		if (!$this->EntityAttributeValue->exists()) {
			throw new NotFoundException(__('Invalid entity attribute value'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->EntityAttributeValue->save($this->request->data)) {
				$this->Session->setFlash(__('The entity attribute value has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The entity attribute value could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->EntityAttributeValue->read(null, $id);
		}
		$entities = $this->EntityAttributeValue->Entity->find('list');
		$attributes = $this->EntityAttributeValue->Attribute->find('list');
		$this->set(compact('entities', 'attributes'));
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
		$this->EntityAttributeValue->id = $id;
		if (!$this->EntityAttributeValue->exists()) {
			throw new NotFoundException(__('Invalid entity attribute value'));
		}
		if ($this->EntityAttributeValue->delete()) {
			$this->Session->setFlash(__('Entity attribute value deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Entity attribute value was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
