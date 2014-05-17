<?php
App::uses('EntityAttributeValue', 'Model');

/**
 * EntityAttributeValue Test Case
 *
 */
class EntityAttributeValueTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.entity_attribute_value',
		'app.entity',
		'app.attribute'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->EntityAttributeValue = ClassRegistry::init('EntityAttributeValue');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->EntityAttributeValue);

		parent::tearDown();
	}

}
