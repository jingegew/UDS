<?php
App::uses('StimulusCategory', 'Model');

/**
 * StimulusCategory Test Case
 *
 */
class StimulusCategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.stimulus_category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->StimulusCategory = ClassRegistry::init('StimulusCategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->StimulusCategory);

		parent::tearDown();
	}

}
