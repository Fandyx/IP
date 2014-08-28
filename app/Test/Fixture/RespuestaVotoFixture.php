<?php
/**
 * RespuestaVotoFixture
 *
 */
class RespuestaVotoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'respuesta' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'usuario_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'fecha' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_spanish2_ci', 'charset' => 'utf8'),
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
			'respuesta' => 1,
			'usuario_id' => 1,
			'fecha' => 'Lorem ipsum dolor sit amet'
		),
	);

}
