<?php
/**
 * RespuestumFixture
 *
 */
class RespuestumFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'pregunta' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'respuesta' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 1000, 'collate' => 'utf8_spanish2_ci', 'charset' => 'utf8'),
		'id_usuario_res' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'fecha_respuesta' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'mejor_respuesta' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
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
			'pregunta' => 1,
			'respuesta' => 'Lorem ipsum dolor sit amet',
			'id_usuario_res' => 1,
			'fecha_respuesta' => '2014-08-14 02:39:53',
			'mejor_respuesta' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);

}
