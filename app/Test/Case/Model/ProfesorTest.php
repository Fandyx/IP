<?php
App::uses('Profesor', 'Model');

/**
 * Profesor Test Case
 *
 */
class ProfesorTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.profesor',
		'app.user',
		'app.area',
		'app.profesor_area',
		'app.usuario',
		'app.pregunta_voto',
		'app.pregunta',
		'app.respuesta_voto',
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
		$this->Profesor = ClassRegistry::init('Profesor');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Profesor);

		parent::tearDown();
	}

}
