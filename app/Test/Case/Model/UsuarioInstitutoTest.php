<?php
App::uses('UsuarioInstituto', 'Model');

/**
 * UsuarioInstituto Test Case
 *
 */
class UsuarioInstitutoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.usuario_instituto'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UsuarioInstituto = ClassRegistry::init('UsuarioInstituto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UsuarioInstituto);

		parent::tearDown();
	}

}
