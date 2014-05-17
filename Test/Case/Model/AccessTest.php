<?php
App::uses('Access', 'Model');

/**
 * Access Test Case
 *
 */
class AccessTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.access',
		'app.user',
		'app.project',
		'app.experiment'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Access = ClassRegistry::init('Access');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Access);

		parent::tearDown();
	}

}
