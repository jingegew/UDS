<?php
App::uses('Grant', 'Model');

/**
 * Grant Test Case
 *
 */
class GrantTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.grant',
		'app.agency',
		'app.user',
		'app.project'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Grant = ClassRegistry::init('Grant');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Grant);

		parent::tearDown();
	}

}
