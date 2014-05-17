<?php
App::uses('Stimulus', 'Model');

/**
 * Stimulus Test Case
 *
 */
class StimulusTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.stimulus',
		'app.response',
		'app.participant',
		'app.experiment',
		'app.project',
		'app.grant',
		'app.agency',
		'app.user',
		'app.access',
		'app.stimulus_condition'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Stimulus = ClassRegistry::init('Stimulus');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Stimulus);

		parent::tearDown();
	}

}
