<?php
App::uses('AppController', 'Controller');
/**
 * Attributes Controller
 *
 * @property Attribute $Attribute
 */
class AttributesController extends AppController {

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->Attribute->recursive = 0;
		$experiment_id = $this->Session->read("Experiment.id");
		if(isset($experiment_id)){
			$conditions = array(
					'OR' => array(
							array(
									'AND' => array(
											'Attribute.project_id' => $this->Session->read("Project.id"),
											'Attribute.type LIKE' => 'Participant%')
							),
							'Attribute.experiment_id' => $this->Session->read("Experiment.id")
					)
			);
		} else {
			$conditions = array('Attribute.project_id' => $this->Session->read("Project.id"), 'Attribute.type LIKE' => 'Participant%');
		}
		$this->paginate = array('conditions' => $conditions,'limit' => 25);
		$this->set('attributes', $this->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->Attribute->id = $id;
		if (!$this->Attribute->exists()) {
			throw new NotFoundException(__('Invalid attribute'));
		}
		$this->set('attribute', $this->Attribute->read(null, $id));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Attribute->create();
			$this->debug("Attributes: " . json_encode($this->request->data));
			$this->request->data['Attribute']['project_id'] = $this->Session->read('Project.id');
			$this->request->data['Attribute']['experiment_id'] = $this->Session->read('Experiment.id');
			if ($this->Attribute->save($this->request->data)) {
				$this->Session->setFlash(__('The attribute has been saved!'), 'flash_custom', array('class' => 'alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attribute could not be saved. Please, try again.'), 'flash_custom', array('class' => 'alert-error'));
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
		$this->Attribute->id = $id;
		if (!$this->Attribute->exists()) {
			throw new NotFoundException(__('Invalid attribute'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Attribute->save($this->request->data)) {
				$this->Session->setFlash(__('The attribute has been saved!'), 'flash_custom', array('class' => 'alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attribute could not be saved. Please, try again.'), 'flash_custom', array('class' => 'alert-error'));
			}
		} else {
			$this->request->data = $this->Attribute->read(null, $id);
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
		$this->Attribute->id = $id;
		if (!$this->Attribute->exists()) {
			throw new NotFoundException(__('Invalid attribute'));
		}
		if ($this->Attribute->delete()) {
			$this->Session->setFlash('Attribute deleted.', 'flash_custom', array('class' => 'alert-success'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Attribute was not deleted.', 'flash_custom', array('class' => 'alert-error'));
		$this->redirect(array('action' => 'index'));
	}
}
