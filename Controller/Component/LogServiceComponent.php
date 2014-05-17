<?php
/*
 * jQuery File Upload Plugin PHP Class 5.9.2
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */
App::uses('Component', 'Controller');
class LogServiceComponent extends Component {
	
    protected $options;
    
    function __construct( ComponentCollection $collection, $options = null ) {     
        $this->ActivityLog = ClassRegistry::init('ActivityLog');
    }

    public function logRequest($requestArray = array()){
    	// define what to log
    	if(isset($_SERVER['HTTP_REFERER'])){
    		$clicked_from = $_SERVER['HTTP_REFERER'];
    	} else {
    		$clicked_from = '';
    	}
    
    	$tmp = array(
    			'user_ip' => $_SERVER['REMOTE_ADDR'],
    			'user_browser' => $_SERVER['HTTP_USER_AGENT'],
    			'clicked_from' => $clicked_from);
    
    	$output['ActivityLog'] = array_merge($tmp,$requestArray);
    
    	// save to database
    	$this->ActivityLog->create();
    	$this->ActivityLog->save($output);
    }

}
