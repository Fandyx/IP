<?php
App::uses('Area', 'Model');

/**
 * Area Test Case
 *
 */
class AreaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.area',
		'app.profesor',
		'app.user',
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
		$this->Area = ClassRegistry::init('Area');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Area);

		parent::tearDown();
	}

}
