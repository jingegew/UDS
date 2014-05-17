<?php
App::uses('AppModel', 'Model');
/**
 * Response Model
 *
 * @property Participant $Participant
 * @property Stimulus $Stimulus
 * @property Experiment $Experiment
 * @property StimulusCondition $StimulusCondition
 */
class Response extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'participant_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'experiment_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Participant' => array(
			'className' => 'Participant',
			'foreignKey' => 'participant_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Stimulus' => array(
			'className' => 'Stimulus',
			'foreignKey' => 'stimulus_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Experiment' => array(
			'className' => 'Experiment',
			'foreignKey' => 'experiment_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
