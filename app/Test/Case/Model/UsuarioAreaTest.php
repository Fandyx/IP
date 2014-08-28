<?php
App::uses('UsuarioArea', 'Model');

/**
 * UsuarioArea Test Case
 *
 */
class UsuarioAreaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.usuario_area'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UsuarioArea = ClassRegistry::init('UsuarioArea');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UsuarioArea);

		parent::tearDown();
	}

}
