<?php
App::uses('Respuestum', 'Model');

/**
 * Respuestum Test Case
 *
 */
class RespuestumTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.respuestum'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Respuestum = ClassRegistry::init('Respuestum');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Respuestum);

		parent::tearDown();
	}

}
