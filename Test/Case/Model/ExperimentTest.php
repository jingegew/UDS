<?php
App::uses('Experiment', 'Model');

/**
 * Experiment Test Case
 *
 */
class ExperimentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.experiment',
		'app.project',
		'app.access',
		'app.user',
		'app.response'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Experiment = ClassRegistry::init('Experiment');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Experiment);

		parent::tearDown();
	}

}
