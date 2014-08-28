<?php
App::uses('InstitutoTipo', 'Model');

/**
 * InstitutoTipo Test Case
 *
 */
class InstitutoTipoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.instituto_tipo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->InstitutoTipo = ClassRegistry::init('InstitutoTipo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->InstitutoTipo);

		parent::tearDown();
	}

}
