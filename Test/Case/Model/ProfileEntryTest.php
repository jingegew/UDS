<?php
App::uses('ProfileEntry', 'Model');

/**
 * ProfileEntry Test Case
 *
 */
class ProfileEntryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.profile_entry',
		'app.participant',
		'app.affiliation',
		'app.secondary_type',
		'app.secondary',
		'app.experiment',
		'app.project',
		'app.user',
		'app.grant',
		'app.agency',
		'app.response',
		'app.stimulus_condition',
		'app.profile_attribute'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProfileEntry = ClassRegistry::init('ProfileEntry');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProfileEntry);

		parent::tearDown();
	}

}
