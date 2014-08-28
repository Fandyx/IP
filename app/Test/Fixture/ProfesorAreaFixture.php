<?php
/**
 * ProfesorAreaFixture
 *
 */
class ProfesorAreaFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'profesor_area';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'profesor' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'area' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'profesor' => 1,
			'area' => 'Lorem ipsum dolor sit amet'
		),
	);

}
