<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Privileges Controller
 *
 * @property Privilege $Privilege
 */
class PrivilegesController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
	}

	/*
	 Update: {
	"operation":"1","Privilege":{
	"user_id":"2","role_id":"2","start_time":"","end_time":""}
	}*/

	public function grantOrRevoke() {

		$this->autoRender = false;

		$operation = $this->request->data['operation'];

		$email = $this->request->data['email'];
		if(empty($email)){

		} else {
			$this->loadModel('User');
			$userId = $this->User->find('first', array( 'fields' => array('User.id'), 'conditions' => array('User.email' => $email)));
			//grant
			if($operation == 1){
				if(empty($userId)){
					$this->debug("Email: " . $email);
					$user = array();
					$this->User->create();
					$user['User']['email'] = $email;
					$user['User']['password'] = $this->randomPassword();
					$this->debug("Password: " . $user['User']['password']);
					$this->User->save($user);
					$this->request->data['Privilege']['user_id'] = $this->User->id;
					$EmailSend = new CakeEmail('gmail');
					$EmailSend->from(array('wjin1210@gmail.com' => 'Unified Data System'));
					$EmailSend->to($email);
					$EmailSend->subject('Invite you to join project: ' . $this->Session->read('Project.name'));
					$emailContent = "You could join in by clicking this link: http://141.225.41.243/uds/ \nYour login username:  " .  $email . " Password: " .  $user['User']['password'];
					$EmailSend->send($emailContent);
				} else {
					$this->request->data['Privilege']['user_id'] = $userId['User']['id'];
				}
				$this->Privilege->create();
				$this->request->data['Privilege']['project_id'] = $this->Session->read('Project.id');
				$this->request->data['Privilege']['experiment_id'] = $this->Session->read('Experiment.id');
				if ($this->Privilege->save($this->request->data)) {
					$this->Session->setFlash('The privilege has been saved!', 'flash_custom', array('class' => 'alert-success'));
					//$this->redirect(array('controller' => 'experiments', 'action' => 'index'));
				} else {
					$this->Session->setFlash('The privilege could not be saved.', 'flash_custom', array('class' => 'alert-error'));
					//$this->redirect(array('controller' => 'experiments', 'action' => 'index'));
				}
			}
			//revoke
			if($operation == 2){
				$user_id = $userId['User']['id'];
				if(!empty($user_id)){
					$id = $this->Privilege->find('first', array( 'fields' => array('Privilege.id'),
							'conditions' => array('Privilege.user_id' => $user_id,
									'Privilege.experiment_id' => $this->Session->read('Experiment.id'))));
					$this->Privilege->id = $id['Privilege']['id'];
					if ($this->Privilege->exists()) {
						if ($this->Privilege->delete()) {
							$this->Session->setFlash('Privilege deleted.', 'flash_custom', array('class' => 'alert-success'));
							//$this->redirect(array('controller' => 'experiments', 'action' => 'index'));
						}
					}
				}
			}
		}

	}

	public function grant() {
		$this->autoRender = false;
		$email = $this->request->data['Privilege']['invite'];
		if(empty($email)){

		} else {
			$this->loadModel('User');
			$userId = $this->User->find('first', array( 'fields' => array('User.id'), 'conditions' => array('User.email' => $email)));
			//grant
			if(empty($userId)){
				$this->debug("Email: " . $email);
				$user = array();
				$this->User->create();
				$user['User']['email'] = $email;
				$user['User']['password'] = $this->randomPassword();
				$this->debug("Password: " . $user['User']['password']);
				$this->User->save($user);
				$this->request->data['Privilege']['user_id'] = $this->User->id;
				$EmailSend = new CakeEmail('gmail');
				$EmailSend->from(array('wjin1210@gmail.com' => 'Unified Data System'));
				$EmailSend->to($email);
				$EmailSend->subject('Invite you to join project: ' . $this->Session->read('Project.name'));
				$emailContent = "You could join in by clicking this link: http://141.225.41.243/uds/ \nYour login username:  " .  $email . " Password: " .  $user['User']['password'];
				$EmailSend->send($emailContent);
			} else {
				$this->request->data['Privilege']['user_id'] = $userId['User']['id'];
			}
			$this->Privilege->create();
			$this->request->data['Privilege']['project_id'] = $this->Session->read('Project.id');
			$this->request->data['Privilege']['experiment_id'] = $this->Session->read('Experiment.id');
			if ($this->Privilege->save($this->request->data)) {
				$this->Session->setFlash('The privilege has been saved!', 'flash_custom', array('class' => 'alert-success'));
				$this->redirect(array('controller' => 'experiments', 'action' => 'edit', $this->Session->read('Experiment.id')));
			} else {
				$this->Session->setFlash('The privilege could not be saved.', 'flash_custom', array('class' => 'alert-error'));
				$this->redirect(array('controller' => 'experiments', 'action' => 'edit', $this->Session->read('Experiment.id')));
			}
		}
	}

	public function revoke() {
		$email = $this->request->data['email'];
		if(empty($email)){

		} else {
			$this->loadModel('User');
			$userId = $this->User->find('first', array( 'fields' => array('User.id'), 'conditions' => array('User.email' => $email)));
			//revoke
			$user_id = $userId['User']['id'];
			if(!empty($user_id)){
				$id = $this->Privilege->find('first', array( 'fields' => array('Privilege.id'),
						'conditions' => array('Privilege.user_id' => $user_id,
								'Privilege.experiment_id' => $this->Session->read('Experiment.id'))));
				$this->Privilege->id = $id['Privilege']['id'];
				if ($this->Privilege->exists()) {
					if ($this->Privilege->delete()) {
						$this->Session->setFlash('Privilege deleted.', 'flash_custom', array('class' => 'alert-success'));
						$this->redirect(array('controller' => 'experiments', 'action' => 'edit', $this->Session->read('Experiment.id')));
					}
				}
			}				
		}
	}

	private function randomPassword() {
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}


	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->Privilege->recursive = 0;
		$this->set('privileges', $this->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->Privilege->id = $id;
		if (!$this->Privilege->exists()) {
			throw new NotFoundException(__('Invalid privilege'));
		}
		$this->set('privilege', $this->Privilege->read(null, $id));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Privilege->create();
			$this->request->data['Privilege']['project_id'] = $this->Session->read('Project.id');
			$this->request->data['Privilege']['experiment_id'] = $this->Session->read('Experiment.id');
			if ($this->Privilege->save($this->request->data)) {
				$this->Session->setFlash('The privilege has been saved!', 'flash_custom', array('class' => 'alert-success'));
				$this->redirect($this->referer());
				//$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The privilege could not be saved. Please, try again.', 'flash_custom', array('class' => 'alert-error'));
			}
		}
		$users = $this->Privilege->User->find('list');
		$projects = $this->Privilege->Project->find('list');
		$experiments = $this->Privilege->Experiment->find('list');
		$this->set(compact('users', 'projects', 'experiments'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		$this->Privilege->id = $id;
		if (!$this->Privilege->exists()) {
			throw new NotFoundException(__('Invalid privilege'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Privilege->save($this->request->data)) {
				$this->Session->setFlash(__('The privilege has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The privilege could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Privilege->read(null, $id);
		}
		$users = $this->Privilege->User->find('list');
		$projects = $this->Privilege->Project->find('list');
		$experiments = $this->Privilege->Experiment->find('list');
		$this->set(compact('users', 'projects', 'experiments'));
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
			//throw new MethodNotAllowedException();
		}
		$this->Privilege->id = $id;
		if (!$this->Privilege->exists()) {
			throw new NotFoundException(__('Invalid privilege'));
		}
		if ($this->Privilege->delete()) {
			$this->Session->setFlash(__('Privilege deleted'));
			$this->redirect($this->referer());
			//$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Privilege was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
