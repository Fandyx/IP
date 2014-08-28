<?php
/**
 * PreguntaVotoFixture
 *
 */
class PreguntaVotoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'pregunta_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'usuario_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'fecha' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'pregunta_id' => 1,
			'usuario_id' => 1,
			'fecha' => '2014-08-14 02:38:33'
		),
	);

}
