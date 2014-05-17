<?php
App::uses('AppController', 'Controller');
/**
 * Stimuli Controller
 *
 * @property Stimulus $Stimulus
 */
class StimuliController extends AppController {
	
	public $uses = array('Stimulus', 'EntityAttributeValue', 'Attribute');

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {	
		$this->Attribute->recursive = -1;
		$sname = $this->Attribute->find('first', array('conditions' => array('Attribute.type' => 'Stimulus Name', 'Attribute.experiment_id' => $this->Session->read('Experiment.id')), 'fields' => array('Attribute.name', 'Attribute.description')));
		$header = array();
		$header['Stimulus']['name'] = empty($sname) ? null : $sname['Attribute']['name'];
		$header['Stimulus']['description'] = empty($sname) ? null : $sname['Attribute']['description'];
		$this->set('header', $header);

		$allStimuli = array();
		$attributes = array();
		$this->Stimulus->recursive = -1;
		$stimuli = $this->Stimulus->find('all', array('conditions' => array('Stimulus.experiment_id' => $this->Session->read('Experiment.id'))));
		$i = 0;
		foreach($stimuli as $stimulus){
			$entityAttributeValues = $this->EntityAttributeValue->find('all', array('conditions' => array('EntityAttributeValue.entity_id' => $stimulus['Stimulus']['id'], 'EntityAttributeValue.entity_type' => 'Stimulus')));
			$allStimuli[$i]['Stimulus']['id'] = $stimulus['Stimulus']['id'];
			$allStimuli[$i]['Stimulus']['name'] = $stimulus['Stimulus']['name'];
			foreach($entityAttributeValues as $eav){
				$allStimuli[$i]['Stimulus'][$eav['Attribute']['name']] = $eav['EntityAttributeValue']['value'];
				$attributes[$eav['Attribute']['name']] = $eav['Attribute']['description'];
			}
			$i++;
		}
		$allAttributes = array();
		$i = 0;
		foreach ($attributes as $key => $value){
			$allAttributes[$i]['name'] = $key;
			$allAttributes[$i]['description'] = $value;
			$i++;
		}
		$this->set('stimuli', $allStimuli);
		$this->set('attributes', $allAttributes);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Stimulus->id = $id;
		if (!$this->Stimulus->exists()) {
			throw new NotFoundException(__('Invalid stimulus'));
		}
		$this->set('stimulus', $this->Stimulus->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Stimulus->create();
			if ($this->Stimulus->save($this->request->data)) {
				$this->Session->setFlash(__('The stimulus has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The stimulus could not be saved. Please, try again.'));
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
		$this->Stimulus->id = $id;
		if (!$this->Stimulus->exists()) {
			throw new NotFoundException(__('Invalid stimulus'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Stimulus->save($this->request->data)) {
				$this->Session->setFlash(__('The stimulus has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The stimulus could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Stimulus->read(null, $id);
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
		$this->Stimulus->id = $id;
		if (!$this->Stimulus->exists()) {
			throw new NotFoundException(__('Invalid stimulus'));
		}
		if ($this->Stimulus->delete()) {
			$this->Session->setFlash(__('Stimulus deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Stimulus was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
