<?php
App::uses('SecondaryIdType', 'Model');

/**
 * SecondaryIdType Test Case
 *
 */
class SecondaryIdTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.secondary_id_type',
		'app.participant',
		'app.affiliation',
		'app.secondary_type',
		'app.secondary',
		'app.experiment',
		'app.project',
		'app.grant',
		'app.agency',
		'app.user',
		'app.profile_attribute',
		'app.profile_entry',
		'app.response',
		'app.stimulus',
		'app.stimulus_condition',
		'app.participant_group'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SecondaryIdType = ClassRegistry::init('SecondaryIdType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SecondaryIdType);

		parent::tearDown();
	}

}
