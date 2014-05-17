<?php
App::uses('StimulusType', 'Model');

/**
 * StimulusType Test Case
 *
 */
class StimulusTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.stimulus_type',
		'app.stimulus'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->StimulusType = ClassRegistry::init('StimulusType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->StimulusType);

		parent::tearDown();
	}

}
