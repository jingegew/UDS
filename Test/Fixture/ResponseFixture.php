<?php
/**
 * ResponseFixture
 *
 */
class ResponseFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 5, 'key' => 'primary'),
		'participant_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'stimulus_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 5),
		'experiment_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 8),
		'stimulus_condition_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 5),
		'start_time' => array('type' => 'date', 'null' => true, 'default' => null),
		'end_time' => array('type' => 'date', 'null' => true, 'default' => null),
		'misc_note' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'response_value' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'participant_id' => 1,
			'stimulus_id' => 1,
			'experiment_id' => 1,
			'stimulus_condition_id' => 1,
			'start_time' => '2013-02-26',
			'end_time' => '2013-02-26',
			'misc_note' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'response_value' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);

}
