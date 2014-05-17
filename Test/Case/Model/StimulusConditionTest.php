<?php
App::uses('StimulusCondition', 'Model');

/**
 * StimulusCondition Test Case
 *
 */
class StimulusConditionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.stimulus_condition',
		'app.response',
		'app.participant',
		'app.stimulus',
		'app.experiment',
		'app.project',
		'app.grant',
		'app.agency',
		'app.user',
		'app.access'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->StimulusCondition = ClassRegistry::init('StimulusCondition');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->StimulusCondition);

		parent::tearDown();
	}

}
