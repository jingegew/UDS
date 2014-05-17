<?php
App::uses('AppModel', 'Model');
/**
 * EntityAttributeValue Model
 *
 * @property Entity $Entity
 * @property Attribute $Attribute
 */
class EntityAttributeValue extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Attribute' => array(
			'className' => 'Attribute',
			'foreignKey' => 'attribute_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
