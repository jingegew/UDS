<?php
App::uses('ResponseType', 'Model');

/**
 * ResponseType Test Case
 *
 */
class ResponseTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.response_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ResponseType = ClassRegistry::init('ResponseType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ResponseType);

		parent::tearDown();
	}

}
