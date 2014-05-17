<?php
App::uses('AppController', 'Controller');
/**
 * Responses Controller
 *
 * @property Response $Response
 */
class ResponsesController extends AppController {
	
	public $uses = array('Participant', 'Stimulus', 'Response', 'Attribute');

	public function beforeFilter() {
		$this->Auth->autoRedirect = false;
		parent::beforeFilter();
		$this->Auth->allow('visualizeData');
		$this->Auth->allow('index');
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		//$this->set('title_for_layout', 'View Experiment Data');
		$conditions = array('Response.experiment_id' => $this->Session->read('Experiment.id'));
		$query = "";
		if(isset($this->request->data['query'])){	
			$query = $this->request->data['query'];
			$conditions['OR'] = array(
					array('Response.response_value LIKE' => '%' . $query . '%')
					);
			/*
			array('OR' => array(
					array('Response.title LIKE' => '%one%'),
					array('Response.response_value LIKE' => '%two%')
			)); */
		}
				
		$this->paginate = array(
				'conditions' => $conditions,
				'limit' => 10
		); 
		
		$totalStimulus = $this->Response->find('count', array('fields' => 'DISTINCT Response.stimulus_id', 'conditions' => $conditions));
		$totalParticipant = $this->Response->find('count', array('fields' => 'DISTINCT Response.participant_id', 'conditions' => $conditions));	
		$totalResponse = $this->Response->find('count', array('conditions' => $conditions));
		
		$this->set('totalStimulus', $totalStimulus);
		$this->set('totalParticipant', $totalParticipant);
		$this->set('totalResponse', $totalResponse);
		
		//if ($this->request->is('post') || preg_match("/page:\d/", $this->here)) {
			$this->Attribute->recursive = -1;
			$uid = $this->Attribute->find('first', array('conditions' => array('Attribute.type' => 'Participant UID', 'Attribute.project_id' => $this->Session->read('Project.id')), 'fields' => array('Attribute.name', 'Attribute.description')));
			$stimulusName = $this->Attribute->find('first', array('conditions' => array('Attribute.type' => 'Stimulus Name', 'Attribute.experiment_id' => $this->Session->read('Experiment.id')), 'fields' => array('Attribute.name', 'Attribute.description')));
			$responseValue = $this->Attribute->find('first', array('conditions' => array('Attribute.type' => 'Response Value', 'Attribute.experiment_id' => $this->Session->read('Experiment.id')), 'fields' => array('Attribute.name', 'Attribute.description')));
			$header = array();
			$header['Participant']['id'] = empty($uid) ? null : $uid['Attribute']['name'];
			$header['Participant']['description'] = empty($uid) ? null : $uid['Attribute']['description'];
			$header['Stimulus']['name'] = empty($stimulusName) ? null : $stimulusName['Attribute']['name'];
			$header['Stimulus']['description'] = empty($stimulusName) ? null : $stimulusName['Attribute']['description'];
			$header['Response']['value_name'] = empty($responseValue) ? null : $responseValue['Attribute']['name'];
			$header['Response']['description'] = empty($responseValue) ? null : $responseValue['Attribute']['description'];
			//$this->Response->recursive = 0;
			//$this->set('responses', $this->paginate('Response'));
			$this->set('header', $header);			

			$attributes = array();
			$this->Response->recursive = 0;
			$responses = $this->paginate('Response');
			$this->loadModel('EntityAttributeValue');
			foreach($responses as &$response){
				$entityAttributeValues = $this->EntityAttributeValue->find('all', array('conditions' => array('EntityAttributeValue.entity_id' => $response['Response']['id'], 'EntityAttributeValue.entity_type' => 'Response')));
				foreach($entityAttributeValues as $eav){
					$response['Response'][$eav['Attribute']['name']] = $eav['EntityAttributeValue']['value'];
					$attributes[$eav['Attribute']['name']] = $eav['Attribute']['description'];
				}
			}
			$allAttributes = array();
			$i = 0;
			foreach ($attributes as $key => $value){
				$allAttributes[$i]['name'] = $key;
				$allAttributes[$i]['description'] = $value;
				$i++;
			}
			$this->set('responses', $responses);
			$this->set('attributes', $allAttributes);	
			$this->set('query', $query);
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->Response->id = $id;
		if (!$this->Response->exists()) {
			throw new NotFoundException(__('Invalid response'));
		}
		$this->set('response', $this->Response->read(null, $id));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Response->create();
			if ($this->Response->save($this->request->data)) {
				$this->Session->setFlash(__('The response has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The response could not be saved. Please, try again.'));
			}
		}
		$participants = $this->Response->Participant->find('list');
		$stimuli = $this->Response->Stimulus->find('list');
		$experiments = $this->Response->Experiment->find('list');
		$stimulusConditions = $this->Response->StimulusCondition->find('list');
		$this->set(compact('participants', 'stimuli', 'experiments', 'stimulusConditions'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		$this->Response->id = $id;
		if (!$this->Response->exists()) {
			throw new NotFoundException(__('Invalid response'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Response->save($this->request->data)) {
				$this->Session->setFlash(__('The response has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The response could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Response->read(null, $id);
		}
		$participants = $this->Response->Participant->find('list');
		$stimuli = $this->Response->Stimulus->find('list');
		$experiments = $this->Response->Experiment->find('list');
		$this->set(compact('participants', 'stimuli', 'experiments'));
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
		$this->Response->id = $id;
		if (!$this->Response->exists()) {
			throw new NotFoundException(__('Invalid response'));
		}
		if ($this->Response->delete()) {
			$this->Session->setFlash(__('Response deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Response was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	public function visualizeData() {

		$this->autoRender = false ;

		$responses = $this->Response->find('all', array('conditions' => array('Response.experiment_id' => $this->Session->read('Experiment.id'))));
		if(!empty($responses)){
			/*
			$participants = $this->Participant->find('all',array(
					'fields' => array('Participant.race', 'SUM(Participant.uid) AS count'), //array of field names
					'group' => array('Participant.race') //fields to GROUP BY
			));			

			$dataTable['race'] = array(
					'cols' => array(
							// each column needs an entry here, like this:
							array('type' => 'string', 'label' => 'Race'),
							array('type' => 'number', 'label' => 'Total Number')
					)
			);

			foreach ($participants as $participant) {
				$dataTable['race']['rows'][] = array(
						'c' => array (
								array('v' => $participant['Participant']['race']),
								array('v' => intval($participant[0]['count']))
						)
				);
			}
			
			$participants = $this->Participant->find('all', array('fields' => array('Participant.age')));	
			
			$dataTable['age'] = array(
					'cols' => array(
							// each column needs an entry here, like this:
							array('type' => 'string', 'label' => 'age bracket'),
							array('type' => 'number', 'label' => 'Number')
					)
			);
				
			$ages = array(0,0,0,0,0,0,0,0,0,0,0);
				
			foreach ($participants as $participant) {
				$i = $participant['Participant']['age'] % 10;
				if($i > 10){
					$i = 10;
				}
				$ages[$i]++;
			}
			
			for($i = 0; $i <11; $i++){
				if($i < 10){
					$index = "". $i*10;
				} else {
					$index = " > 100";
				}
				$dataTable['age']['rows'][] = array(
						'c' => array (
								array('v' => $index),
								array('v' => $ages[$i])
						)
				);
			}
			*/
			$dataTable['Response'] = array(
					'cols' => array(
							array('type' => 'string', 'label' => 'Stimulus'),
							array('type' => 'number', 'label' => 'Mastered'),
							array('type' => 'number', 'label' => 'Attempted')
				)
			);
			
			$results = array();
			
			foreach ($responses as $response) {	
				
				if(!isset($results[$response['Stimulus']['name']]['Mastered'])){
					$results[$response['Stimulus']['name']]['Mastered'] = 0;
				}
				if(!isset($results[$response['Stimulus']['name']]['Attempted'])){
					$results[$response['Stimulus']['name']]['Attempted'] = 0;
				}
				
				if($response['Response']['response_value'] == "Mastered"){
					$results[$response['Stimulus']['name']]['Mastered']++;					
				}				
				if($response['Response']['response_value'] == "Attempted"){
					$results[$response['Stimulus']['name']]['Attempted']++;
				}				
			}
			
			$this->debug("Results: " . json_encode($results));
			
			foreach (array_keys($results) as $key){				
				$dataTable['Response']['rows'][] = array(
						'c' => array (
								array('v' => $key),
								array('v' => isset($results[$key]['Mastered']) ? $results[$key]['Mastered'] : 0 ),
								array('v' => isset($results[$key]['Attempted']) ? $results[$key]['Attempted'] : 0 )
						)
				);
			}
			
			$this->autoRender = false;
			echo json_encode($dataTable);			
		}
		$this->autoRender = false;
	}
}
