<?php
App::uses('AppController', 'Controller');
/**
 * Participants Controller
 *
 * @property Participant $Participant
 */
class ParticipantsController extends AppController {
	
	public $uses = array('Participant', 'EntityAttributeValue', 'Attribute');

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->paginate = array(
				'conditions' => array('Participant.project_id' => $this->Session->read('Project.id')),
				'limit' => 10
		);
		
		$this->Attribute->recursive = -1;
		$uid = $this->Attribute->find('first', array('conditions' => array('Attribute.type' => 'Participant UID', 'Attribute.project_id' => $this->Session->read('Project.id')), 'fields' => array('Attribute.name', 'Attribute.description')));
		$header = array();
		$header['Participant']['id'] = empty($uid) ? null : $uid['Attribute']['name'];
		$header['Participant']['description'] = empty($uid) ? null : $uid['Attribute']['description'];
		$this->set('header', $header);
		
		$attributes = array();
		$this->Participant->recursive = 0;
		$participants = $this->paginate('Participant');
		$this->loadModel('EntityAttributeValue');
		foreach($participants as &$participant){
			$entityAttributeValues = $this->EntityAttributeValue->find('all', array('conditions' => array('EntityAttributeValue.entity_id' => $participant['Participant']['id'], 'EntityAttributeValue.entity_type' => 'Participant')));
			foreach($entityAttributeValues as $eav){
				if($eav['Attribute']['display']){
					$participant['Participant'][$eav['Attribute']['name']] = $eav['EntityAttributeValue']['value'];
					$attributes[$eav['Attribute']['name']] = $eav['Attribute']['description'];
				}
			}
		}
		$allAttributes = array();
		$i = 0;
		foreach ($attributes as $key => $value){
			$allAttributes[$i]['name'] = $key;
			$allAttributes[$i]['description'] = $value;
			$i++;
		}
		$this->set('participants', $participants);
		$this->set('attributes', $allAttributes);
	}
	
	public function getParticipantById($id = null){
		
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->Participant->id = $id;
		if (!$this->Participant->exists()) {
			throw new NotFoundException(__('Invalid participant'));
		}
		$this->set('participant', $this->Participant->read(null, $id));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Participant->create();
			if ($this->Participant->save($this->request->data)) {
				$this->Session->setFlash(__('The participant has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The participant could not be saved. Please, try again.'));
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
		$this->Participant->id = $id;
		if (!$this->Participant->exists()) {
			throw new NotFoundException(__('Invalid participant'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Participant->save($this->request->data)) {
				$this->Session->setFlash(__('The participant has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The participant could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Participant->read(null, $id);
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
		$this->Participant->id = $id;
		if (!$this->Participant->exists()) {
			throw new NotFoundException(__('Invalid participant'));
		}
		if ($this->Participant->delete()) {
			$this->Session->setFlash(__('Participant deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Participant was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
