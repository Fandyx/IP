<?php
/**
 * UsuarioAreaFixture
 *
 */
class UsuarioAreaFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'usuario_area';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'usuario' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'area' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
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
			'usuario' => 1,
			'area' => 1
		),
	);

}
