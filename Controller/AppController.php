<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	//public $theme = "Bootstrap";

	public $components = array(
			'Acl',
			'Auth' => array(
					'authorize' => array(
							'Actions' => array('actionPath' => 'controllers')
					),
					'authenticate' => array(
							'Form' => array(
									'fields' => array('username' => 'email', 'password' => 'password'),
							)
					)
			),
			'Session',
			'Cookie',
			'LogService'
	);

	public $helpers = array('Html', 'Form', 'Session');

	public function beforeFilter() {
		
		//$this->_setLanguage();
		//Configure::write('Config.language', $this->Session->read('Config.language'));
		
		//Language Choosing
		/*
		$this->Cookie->name = 'UDS';
		$this->Cookie->time = 3600*24*30;  // or '1 hour'
		$this->Cookie->path = '/cookie/preferences/';
		$this->Cookie->domain = 'uds.com';
		$this->Cookie->secure = true;  // i.e. only sent if using secure HTTPS
		$this->Cookie->key = 'qSI232qs*&sXOw!adre@34SAv!@*(XSL#$%)asGb$@11~_+!@#HKis~#^';
		$this->Cookie->httpOnly = true;
		*/
		$lang = $this->Cookie->read('lang');
		$this->debug("Cookie Lang: " . $lang);
		if($this->request->is('get') && array_key_exists('lang', $this->request->query)){
			$lang = $this->request->query['lang'];			
			$this->Cookie->write('lang', $lang, false, 3600*24*30);
		} 
		$this->Session->write('Config.language', $lang);
		if ($this->Session->check('Config.language')) {
			Configure::write('Config.language', $this->Session->read('Config.language'));
		} else {
			Configure::write('Config.language', 'en');
		}

		//Configure AuthComponent
		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
		$this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
		$this->Auth->loginError = "Not valid username or password.";

		//Set up Auth Component
		//$this->Auth->authenticate = array('Form');
		//$this->Auth->allow('index', 'view');
		//$this->Auth->allow();
		$urls = $this->Session->read('navigation');
		$urls = array();
		if($this->request->controller != "css" && $this->request->controller != "img"){
			$segments = explode('/', $this->here);
			$entity = $segments[2];
			if(!empty($segments[3]) && $segments[3] != "index"){
				$operate = $segments[3];
			} else {
				$operate = "";
			}
			if(!empty($segments[4])){
				$parameter = $segments[4];
			} else {
				$parameter = "";
			}
			$urls[$this->here] = ucfirst($operate) . " " . ucfirst($entity) . " " . $parameter;

			if(count($urls) > 3){
				array_shift($urls);
			}
		}
		$this->Session->write('navigation', $urls);

		$logRequestArray = array(
				'controller' => $this->name,
				'action' => $this->params['action'],
				'user_id' => $this->Auth->user('id'),
				'request' => $this->here);
		$this->LogService->logRequest($logRequestArray);
	}

	private function _setLanguage() {
		//if the cookie was previously set, and Config.language has not been set
		//write the Config.language with the value from the Cookie
		if ($this->Cookie->read('lang') && !$this->Session->check('Config.language')) {
			$this->Session->write('Config.language', $this->Cookie->read('lang'));
		}
		//if the user clicked the language URL
		else if (isset($this->params['lang']) &&
				($this->params['lang'] !=  $this->Session->read('Config.language'))
		) {
			//then update the value in Session and the one in Cookie
			$this->Session->write('Config.language', $this->params['lang']);
			$this->Cookie->write('lang', $this->params['lang'], false, '20 days');
		}
	}

	public function debug($msg) {
		$myFile = "C:\\workspace\\uds\\debug.txt";
		$fh = fopen($myFile, 'a') or die("can't open file");
		$stringData = $msg . "\n";
		fwrite($fh, $stringData);
		fclose($fh);
	}

}
