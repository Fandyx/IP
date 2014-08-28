<?php
App::uses('RespuestaVoto', 'Model');

/**
 * RespuestaVoto Test Case
 *
 */
class RespuestaVotoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.respuesta_voto',
		'app.usuario',
		'app.pregunta_voto',
		'app.pregunta',
		'app.area',
		'app.profesor',
		'app.user',
		'app.profesor_area',
		'app.usuario_area',
		'app.instituto',
		'app.tipo',
		'app.instituto_tipo',
		'app.usuario_instituto'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->RespuestaVoto = ClassRegistry::init('RespuestaVoto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->RespuestaVoto);

		parent::tearDown();
	}

}
