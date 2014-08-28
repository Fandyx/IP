<?php
/**
 * PreguntumFixture
 *
 */
class PreguntumFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'pregunta' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 1000, 'collate' => 'utf8_spanish2_ci', 'charset' => 'utf8'),
		'id_usuario_preg' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'fecha_pregunta' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'titulo' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_spanish2_ci', 'charset' => 'utf8'),
		'area' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish2_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'pregunta' => 'Lorem ipsum dolor sit amet',
			'id_usuario_preg' => 1,
			'fecha_pregunta' => '2014-08-14 02:44:57',
			'titulo' => 'Lorem ipsum dolor sit amet',
			'area' => 1
		),
	);

}
