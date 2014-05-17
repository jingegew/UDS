<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {


	public function beforeFilter() {
		$this->Auth->autoRedirect = false;
		parent::beforeFilter();
		$this->Auth->allow();
		$this->Auth->allow('logout');
		$this->Auth->allow('initDB'); // We can remove this line after we're finished
	}

	public function login() {
		$this->layout = 'frame';
		if ($this->Auth->login()) {
			$this->Session->write('user_id', $this->Auth->user('id'));
			$this->Session->write('email', $this->Auth->user('email'));
			$this->Session->write('navigation', array());
			if($this->Auth->user('role_id') == 1){
				$this->redirect(array('controller' => 'users', 'action' => 'adminSplash'));
			} else {
				$this->redirect(array('controller' => 'projects', 'action' => 'index'));
			}
		}
		$roles = $this->User->Role->find('list');
		$this->Session->write('Roles', $roles);
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash('Valid username and password are required.', 'flash_custom', array('class' => 'alert-error'));
			}
		}
	}

	public function logout() {
		$this->Session->delete('Project');
		$this->Session->delete('Experiment');
		$this->Session->delete('User');
		$this->redirect($this->Auth->logout());
	}

	public function register() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('You registration request has been filed for approval, if granted, you would be able to login within 24 hours.', 'flash_custom', array('class' => 'alert-success'));
				$this->redirect(array('action' => 'login'));
			} else {
				$this->Session->setFlash('Items marked * are required for registration.', 'flash_custom', array('class' => 'alert-error'));
			}
		}
		$roles = $this->User->Role->find('list', array('conditions' =>array('id > ' => 1)));
		//TODO security question list
		$this->set(compact('roles'));
	}

	public function getUsers(){
		$this->autoRender = false;
		$users = $this->User->find('all', array('conditions' =>array('User.role_id >' => 1)));
		$results = array();
		foreach($users as $user){
			$results[] = $user['User']['email'];
		}
		$this->debug("User List " . json_encode($results));
		echo json_encode($results);
	}

	public function activate($id = null) {
		$this->User->read(null, $id);
		$this->User->set('status', true);
		if ($this->User->save()) {
			$this->Session->setFlash('The user has been activated.', 'flash_custom', array('class' => 'alert-success'));
			$this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash('The user could not be activated.', 'flash_custom', array('class' => 'alert-success'));
		}
	}

	public function deactivate($id = null) {
		$this->User->read(null, $id);
		$this->User->set('status', false);
		if ($this->User->save()) {
			$this->Session->setFlash('The user has been deactivated.', 'flash_custom', array('class' => 'alert-success'));
			$this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash('The user could not be deactivated.', 'flash_custom', array('class' => 'alert-success'));
		}
	}

	public function resetPassword(){
		$this->layout = 'frame';
		if($this->request->is('post')){
			$user = $this->User->find('first', array('conditions' => array('User.email' => $this->request->data['User']['email'], 'User.last_name' => $this->request->data['User']['last_name'])));

			if (empty($user)) {
				$this->Session->setFlash('The email/last name does not exist, or doesn\'t match.', 'flash_custom', array('class' => 'alert-error'));
				$this->redirect(array('action' => 'resetPassword'));
			} else {
				$this->User->save($user);
				$user['User']['password'] = $this->randomPassword();
				$this->User->save($user);
				$this->request->data['Privilege']['user_id'] = $this->User->id;
				$EmailSend = new CakeEmail('gmail');
				$EmailSend->from(array('wjin1210@gmail.com' => 'Unified Data System'));
				$EmailSend->to($user['User']['email']);
				$EmailSend->subject('Your temporary password for UDS');
				$emailContent = "You could log on the UDS by using this password: " .  $user['User']['password'];
				$EmailSend->send($emailContent);
				$this->Session->setFlash('A temporary password has been sent to your mail box, please check it.', 'flash_custom', array('class' => 'alert-success'));
				$this->redirect(array('action' => 'login'));
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

	public function profile(){
		$id = $this->Auth->user('id');
		$this->User->id = $id;
		if ($this->request->is('post') || $this->request->is('put')) {
			$newPassword = $this->request->data['User']['new_password'];
			if(!empty($newPassword)){
				$this->request->data['User']['password'] = $newPassword;
			}
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('You profile has been saved.', 'flash_custom', array('class' => 'alert-success'));
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash('Items maked * are required.', 'flash_custom', array('class' => 'alert-error'));
			}
		} else {
			if (!$this->User->exists()) {
				throw new NotFoundException(__('Invalid user'));
			}
			$this->request->data = $this->User->read(null, $id);
			$roles = $this->User->Role->find('list');
			$this->set(compact('roles'));
		}
	}

	public function verify(){
		if (count($this->request->data['User']) == 2) {
			if ($this->Auth->login()) {
				$id = $this->Auth->user('id');
				$this->User->id = $id;
				if (!$this->User->exists()) {
					throw new NotFoundException(__('Invalid user'));
				}
				$this->request->data = $this->User->read(null, $id);
				$roles = $this->User->Role->find('list');
				$this->set(compact('roles'));
			} else {
				$this->Session->setFlash('Invalid username or password, try again!', 'flash_custom', array('class' => 'alert-error'));
				//$this->redirect(array('action' => 'resetPassword'));
			}
		} else {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('The user has been saved.', 'flash_custom', array('class' => 'alert-success'));
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash('The user could not be saved. Please, try again.', 'flash_custom', array('class' => 'alert-error'));
			}
		}
	}

	public function adminSplash(){
		$this->set('title_for_layout', 'Pending Registrations');
		$pendingRegistrations = $this->User->find('all', array(
				'conditions' => array('User.role_id' => '2', 'User.status' => 0)
		));
		$this->set('users', $pendingRegistrations);
		$roles = $this->User->Role->find('list',array('conditions' => array('Role.id > ' => '1')));
		$this->set(compact('roles'));

	}

	public function update(){

		$this->debug("Update: " . json_encode($this->request->data));

		if(empty($this->request->data['user_ids'])){
			$this->Session->setFlash('Please select a user to approve.', 'flash_custom', array('class' => 'alert-error'));
		} else {
			$ids = preg_split('/\s+/', $this->request->data['user_ids']);
			foreach($ids as $id){
				$this->User->read(null, $id);
				$this->User->set('role_id', $this->request->data['role_id']);
				$this->User->set('status', 1);
				$this->User->save();
			}
			$this->Session->setFlash('The user has been approved.', 'flash_custom', array('class' => 'alert-success'));
		}
		$this->redirect(array('action' => 'adminSplash'));
	}

	public function decline(){
		if(empty($this->request->data)){
			$this->Session->setFlash('Please select a user to decline.', 'flash_custom', array('class' => 'alert-error'));
		} else {
			$ids = preg_split('/\s+/', $this->request->data['user_ids']);
			foreach($ids as $id){
				$this->User->read(null, $id);
				$this->User->delete();
			}
			$this->Session->setFlash('The user has been declined.', 'flash_custom', array('class' => 'alert-error'));
		}
		$this->redirect(array('action' => 'adminSplash'));
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
		$roles = $this->User->Role->find('list');
		$this->set(compact('roles'));
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('The user has been saved.', 'flash_custom', array('class' => 'alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The user could not be saved. Please, try again.', 'flash_custom', array('class' => 'alert-error'));
			}
		}
		$roles = $this->User->Role->find('list');
		$this->set(compact('roles'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$newPassword = $this->request->data['User']['new_password'];
			if(!empty($newPassword)){
				$this->request->data['User']['password'] = $newPassword;
			}
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('The user has been saved.', 'flash_custom', array('class' => 'alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The user could not be saved. Please, try again.', 'flash_custom', array('class' => 'alert-error'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
		$roles = $this->User->Role->find('list');
		$this->set(compact('roles'));
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash('User deleted.', 'flash_custom', array('class' => 'alert-success'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('User was not deleted.', 'flash_custom', array('class' => 'alert-error'));
		$this->redirect(array('action' => 'index'));
	}

	public function initDB() {
		$role = $this->User->Role;

		//Allow admins to everything
		$role->id = 1;
		$this->Acl->allow($role, 'controllers');

		//allow PIs to posts and widgets
		$role->id = 2;
		$this->Acl->deny($role, 'controllers');
		$this->Acl->allow($role, 'controllers/Projects');
		$this->Acl->allow($role, 'controllers/Experiments');
		$this->Acl->allow($role, 'controllers/Participants');
		$this->Acl->allow($role, 'controllers/Users/index');
		$this->Acl->allow($role, 'controllers/Users/view');
		$this->Acl->allow($role, 'controllers/Users/logout');
		$this->Acl->allow($role, 'controllers/Stimuli');
		$this->Acl->allow($role, 'controllers/Responses');
		$this->Acl->allow($role, 'controllers/Privileges');
		$this->Acl->allow($role, 'controllers/Uploads');
		$this->Acl->allow($role, 'controllers/Attributes');


		//allow researchers to only add and edit on posts and widgets
		$role->id = 3;
		$this->Acl->deny($role, 'controllers');
		$this->Acl->allow($role, 'controllers/Projects/index');
		$this->Acl->allow($role, 'controllers/Projects/view');
		$this->Acl->allow($role, 'controllers/Experiments/index');
		$this->Acl->allow($role, 'controllers/Experiments/view');
		$this->Acl->allow($role, 'controllers/Participants/index');
		$this->Acl->allow($role, 'controllers/Participants/view');
		$this->Acl->allow($role, 'controllers/Stimuli/index');
		$this->Acl->allow($role, 'controllers/Stimuli/view');
		$this->Acl->allow($role, 'controllers/Responses/index');
		$this->Acl->allow($role, 'controllers/Responses/view');
		$this->Acl->allow($role, 'controllers/Uploads');
		$this->Acl->allow($role, 'controllers/Users/index');
		$this->Acl->allow($role, 'controllers/Users/view');
		$this->Acl->allow($role, 'controllers/Users/logout');
		$this->Acl->allow($role, 'controllers/Attributes/index');
		$this->Acl->allow($role, 'controllers/Attributes/view');

		//allow visitor to only add and edit on posts and widgets
		$role->id = 4;
		$this->Acl->deny($role, 'controllers');
		$this->Acl->allow($role, 'controllers/Projects/index');
		$this->Acl->allow($role, 'controllers/Projects/view');
		$this->Acl->allow($role, 'controllers/Experiments/index');
		$this->Acl->allow($role, 'controllers/Experiments/view');
		$this->Acl->allow($role, 'controllers/Stimuli/index');
		$this->Acl->allow($role, 'controllers/Stimuli/view');
		$this->Acl->allow($role, 'controllers/Responses/index');
		$this->Acl->allow($role, 'controllers/Responses/view');
		$this->Acl->allow($role, 'controllers/Users/logout');

		//we add an exit to avoid an ugly "missing views" error message
		echo "all done";
		exit;
	}
}
