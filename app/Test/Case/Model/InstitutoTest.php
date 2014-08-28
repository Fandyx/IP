<?php
App::uses('Instituto', 'Model');

/**
 * Instituto Test Case
 *
 */
class InstitutoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.instituto',
		'app.tipo',
		'app.instituto_tipo',
		'app.usuario',
		'app.pregunta_voto',
		'app.pregunta',
		'app.respuesta_voto',
		'app.area',
		'app.profesor',
		'app.user',
		'app.profesor_area',
		'app.usuario_area',
		'app.usuario_instituto'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Instituto = ClassRegistry::init('Instituto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Instituto);

		parent::tearDown();
	}

}
