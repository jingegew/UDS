<?php
App::uses('AppController', 'Controller');
/**
 * Questions Controller
 *
 * @property Question $Question
 */
class QuestionsController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
	}

	public function getSurvey(){
		$this->autoRender = false;
		$results = array();
		$questions = $this->Question->find('all', array('conditions' =>array('Question.version' => $this->request->data['version'])));
		foreach($questions as $question){
			$results[$question['Question']['qid']] = $question['Question']['question'];
		}
		echo json_encode($results);
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->loadModel('User');
		$this->loadModel('Answer');
		$this->loadModel('Admin');
		$version = $this->getCurrentVersion();
		if ($this->request->is('post')) {
			$comment = array_pop($this->request->data);			
			if(!empty($comment)){
				
				$oldComment = $this->Answer->find('first',array('conditions' => array('qid'=>13, 'user_id' => $this->Auth->user('id'), 'version' => $version), 'fields' => array('Answer.id', 'Answer.answer')));
				
				if(empty($oldComment)){
					$answer = array();
					$this->Answer->create();
					$answer['Answer']['qid'] = 13;
					$answer['Answer']['answer'] = $comment['comment'];
					$answer['Answer']['user_id'] = $this->Auth->user('id');
					$answer['Answer']['version'] = $version;
					$this->Answer->save($answer);
				} else if($oldComment['Answer']['answer'] == $comment['comment']) {
					
				} else {	
					$this->Answer->read(null, $oldComment['Answer']['id']);
					$this->Answer->set('answer', $comment['comment']);
					$this->Answer->save();
				}
			}
			//Avoid update password
			$user = array_pop($this->request->data);
			$this->User->id = $this->Auth->user('id');
			$this->User->saveField('race', $user['race']);
			$this->User->saveField('age', $user['age']);
			foreach (array_keys($this->request->data) as $qid){
				$existAnswer = $this->Answer->find('first', array('conditions' => array('Answer.user_id' => $this->Auth->user('id'), 'Answer.qid' => $qid, 'Answer.version' => $version), 'fields' => array('Answer.id', 'Answer.answer')));
				if(empty($existAnswer)){
					$answer = array();
					$this->Answer->create();
					$answer['Answer']['qid'] = $qid;
					$answer['Answer']['answer'] = $this->request->data[$qid];
					$answer['Answer']['user_id'] = $this->Auth->user('id');
					$answer['Answer']['version'] = $version;
					$this->Answer->save($answer);
				} else if($existAnswer['Answer']['answer'] == $this->request->data[$qid]){

				} else {
					$this->Answer->read(null, $existAnswer['Answer']['id']);
					$this->Answer->set('answer', $this->request->data[$qid]);
					$this->Answer->save();
				}
			}
			$this->Session->setFlash('Your responses have been recorded. Thank you for your participation.', 'flash_custom', array('class' => 'alert-success'));
			$this->redirect(array('controller' => 'projects', 'action' => 'index'));
		} else {
			$user = $this->User->read(null, $this->Auth->user('id'));
			$race = $user['User']['race'];
			$age = $user['User']['age'];
			$this->set('race', $race);
			$this->set('age', $age);			
			//$questions = $this->Question->query("select * from questions as Question where version = (select max(version) from questions) order by qid ASC;");
			$questions = $this->Question->find('all', array('conditions' => array('Question.version' => $version), 'order' => array('Question.qid')));
			$answers = $this->Answer->find('all', array('conditions' => array('Answer.user_id' => $this->Auth->user('id'), 'Answer.version' => $version)));
			$this->set('questions', $questions);
			$this->set('answers', $answers);
		}
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->Question->id = $id;
		if (!$this->Question->exists()) {
			throw new NotFoundException(__('Invalid question'));
		}
		$this->set('question', $this->Question->read(null, $id));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {

		$this->loadModel('Admin');
		$currentVersion = $this->getCurrentVersion();
		$versions = $this->Question->find('list', array('fields' => array('Question.version', 'Question.version'),'group' => array('Question.version')));
		$versions['999'] = 'New Version';
		$versions[$currentVersion] = $versions[$currentVersion] . " - Current Version";
		krsort($versions);
		$this->set(compact('versions'));

		if ($this->request->is('post')) {
			$version = $this->request->data['version'];
			if($version == 999){
				$version = $this->getLatestVersion() + 1;
			}			
			if(!empty($this->request->data['select'])){
				$this->Admin->read(null, 109);
				$this->Admin->set('meta_value', $version);
				$this->Admin->save();
			}
			
			array_shift($this->request->data);
			foreach (array_keys($this->request->data) as $qid) {
				if(!empty($this->request->data[$qid]['Question']['question'])){
					$existQuestion = $this->Question->find('first', array('conditions' => array('Question.qid' => $qid, 'Question.version' => $version), 'fields' => array('Question.id', 'Question.question')));
					if(empty($existQuestion)){
						$this->Question->create();
						$question = array();
						$question['Question']['qid'] = $qid;
						$question['Question']['question'] = $this->request->data[$qid]['Question']['question'];
						$question['Question']['version'] = $version;
						$this->Question->save($question);
					} else if($existQuestion['Question']['question'] == $this->request->data[$qid]['Question']['question']){
							
					} else {
						$this->Question->read(null, $existQuestion['Question']['id']);
						$this->Question->set('question', $this->request->data[$qid]['Question']['question']);
						$this->Question->save();
					}
				}
			}
			$this->Session->setFlash('Your survey has been saved successfully.', 'flash_custom', array('class' => 'alert-success'));
			$this->redirect(array('controller' => 'users', 'action' => 'adminSplash'));
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
		$this->Question->id = $id;
		if (!$this->Question->exists()) {
			throw new NotFoundException(__('Invalid question'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Question->save($this->request->data)) {
				$this->Session->setFlash(__('The question has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The question could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Question->read(null, $id);
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
		$this->Question->id = $id;
		if (!$this->Question->exists()) {
			throw new NotFoundException(__('Invalid question'));
		}
		if ($this->Question->delete()) {
			$this->Session->setFlash(__('Question deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Question was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	public function visualize() {
		$this->loadModel('User');
		$this->loadModel('Answer');
		$comments = array();
		$answers = $this->Answer->find('all', array('conditions' => array('Answer.version' => $this->getCurrentVersion())));
		$question = $this->Question->find('first', array('conditions' => array('Question.qid' => 0, 'Question.version' => $this->getCurrentVersion())));
		$introduction = $question['Question']['question'] ;
		$this->set('introduction', $introduction);
		if(!empty($answers)){
			foreach ($answers as $answer){
				if($answer['Answer']['qid'] == 13){
					$comments[] = $answer['Answer']['answer'];
					//array_push($comments, $answer['Answer']['answer']);
				}
			}
		}
		$this->set('comments', $comments);
	}

	public function visualizeData() {

		$this->autoRender = false ;

		$this->loadModel('User');
		$this->loadModel('Answer');

		$answers = $this->Answer->find('all', array('conditions' => array('Answer.version' => $this->getCurrentVersion())));

		if(!empty($answers)){
			//RACE
			$ids = array();
			foreach ($answers as $answer){
				$ids[$answer['Answer']['user_id']] = null;
			}

			$participants = $this->User->find('all',array(
					'conditions' => array('User.id' => array_keys($ids)),
					'fields' => array('User.race', 'SUM(User.id) AS count'), //array of field names
					'group' => array('User.race') //fields to GROUP BY
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
								array('v' => $participant['User']['race']),
								array('v' => intval($participant[0]['count']))
						)
				);
			}
			//AGE
			$participants = $this->User->find('all',array(
					'conditions' => array('User.id' => array_keys($ids)),
					'fields' => array('User.age')
			));

			$dataTable['age'] = array(
					'cols' => array(
							// each column needs an entry here, like this:
							array('type' => 'string', 'label' => 'age bracket'),
							array('type' => 'number', 'label' => 'Number')
					)
			);

			$ages = array(0,0,0,0,0,0,0,0,0,0,0);

			foreach ($participants as $participant) {
				$i = $participant['User']['age'] / 10;
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

			//SURVEY
			$dataTable['survey'] = array(
					'cols' => array(
							array('type' => 'string', 'label' => 'Question'),
							array('type' => 'number', 'label' => 'Strongly Disagree'),
							array('type' => 'number', 'label' => 'Disagree'),
							array('type' => 'number', 'label' => 'Neutral'),
							array('type' => 'number', 'label' => 'Agree'),
							array('type' => 'number', 'label' => 'Strongly Agree')
					)
			);

			$results = array();
			$qset = array();

			$questions = $this->Question->find('all', array('conditions' => array('Question.version' => $this->getCurrentVersion())));

			foreach ($questions as $question) {
				$qset[$question['Question']['qid']] = $question['Question']['question'];
			}

			foreach ($answers as $answer) {
				if($answer['Answer']['qid'] < 13){

					if(!isset($results[$qset[$answer['Answer']['qid']]][$answer['Answer']['answer']])){
						$results[$qset[$answer['Answer']['qid']]][$answer['Answer']['answer']] = 0;
					}
					$results[$qset[$answer['Answer']['qid']]][$answer['Answer']['answer']]++;
				}
			}
			$i = 1;
			foreach (array_keys($results) as $key){
				$dataTable['survey']['rows'][] = array(
						'c' => array (
								array('v' => $i),
								array('v' => isset($results[$key]['1']) ? $results[$key]['1'] : 0 ),
								array('v' => isset($results[$key]['2']) ? $results[$key]['2'] : 0 ),
								array('v' => isset($results[$key]['3']) ? $results[$key]['3'] : 0 ),
								array('v' => isset($results[$key]['4']) ? $results[$key]['4'] : 0 ),
								array('v' => isset($results[$key]['5']) ? $results[$key]['5'] : 0 )
						)
				);
				$i++;
			}
			$this->autoRender = false;
			echo json_encode($dataTable);
		}
		$this->autoRender = false;
	}

	public function getLatestVersion(){
		$version = 1;
		$qversion = $this->Question->find('first', array('fields' => array('MAX(Question.version) AS version')));
		if(!empty($qversion)){
			$version = $qversion[0]['version'];
		}
		return $version;
	}
	
	public function getCurrentVersion(){
		$this->loadModel('Admin');
		return $this->Admin->field('meta_value',array('meta_key'=>'current_survey'));
	}
}
