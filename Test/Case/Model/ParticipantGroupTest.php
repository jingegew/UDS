<?php
App::uses('ParticipantGroup', 'Model');

/**
 * ParticipantGroup Test Case
 *
 */
class ParticipantGroupTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.participant_group',
		'app.response'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ParticipantGroup = ClassRegistry::init('ParticipantGroup');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ParticipantGroup);

		parent::tearDown();
	}

}
