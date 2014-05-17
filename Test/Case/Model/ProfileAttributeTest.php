<?php
App::uses('ProfileAttribute', 'Model');

/**
 * ProfileAttribute Test Case
 *
 */
class ProfileAttributeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.profile_attribute',
		'app.project',
		'app.profile_entry'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProfileAttribute = ClassRegistry::init('ProfileAttribute');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProfileAttribute);

		parent::tearDown();
	}

}
