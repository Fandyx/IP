<?php
App::uses('PreguntaVoto', 'Model');

/**
 * PreguntaVoto Test Case
 *
 */
class PreguntaVotoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.pregunta_voto',
		'app.pregunta',
		'app.usuario',
		'app.respuesta_voto',
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
		$this->PreguntaVoto = ClassRegistry::init('PreguntaVoto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PreguntaVoto);

		parent::tearDown();
	}

}
