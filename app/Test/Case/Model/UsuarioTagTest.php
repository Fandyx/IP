<?php
App::uses('UsuarioTag', 'Model');

/**
 * UsuarioTag Test Case
 *
 */
class UsuarioTagTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.usuario_tag',
		'app.tags'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UsuarioTag = ClassRegistry::init('UsuarioTag');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UsuarioTag);

		parent::tearDown();
	}

}
