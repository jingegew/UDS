<?php
App::uses('AppController', 'Controller');
/**
 * ActivityLogsController Controller
 *
 * @property ActivityLog $ActivityLog
 */
class ActivityLogsController extends AppController {
	
	function getRecentActivityByUser($userID) {	
		$activity = $this->ActivityLog->find('first', array(
				'conditions'=> array(
						'user_id' => $userID,
						'NOT'=> array(
								'action' => 'send',
								'controller' => 'InterviewResponses')
				),
				'order'=>'created DESC')
		);	
		return $activity;
	}
	
	function extractActivityLog($userID, $filtered=TRUE){
		// $userID can be a single user or an array of ids
		// filtered = run the raw activity log entries through the mentor activity labels hash
	
		// might want to push this exclude list up as parameter
		$excludeList = array('chats');
		//'NOT'=> array( 'controller'=>$excludeList
		$activity = $this->ActivityLog->find('all', array(
				'conditions'=> array(
						'user_id' => $userID
				),
				'order'=>'created ASC')
		);
		$activity = Set::extract($activity, '{n}.ActivityLog');
	
		// add labels
		if($filtered){
			$labelsHash = $this->getMentorActivityLabels();
			foreach($activity as $index=>$entry) {
				if(isset($labelsHash[ $entry['controller'] ][  $entry['action'] ])){
					$activity[$index]['MentorLabel'] = $labelsHash[ $entry['controller'] ][  $entry['action'] ];
				}
			}
		}	
		return $activity;
	}
	
	function reset() {
		if($this->Auth->User('role_id') != ROLE_PLAYER) {
			$this->ActivityLog->deleteAll('1 = 1');
			$this->ActivityLog->query("ALTER TABLE activity_logs AUTO_INCREMENT = 1;");
		}
	}
	
}
