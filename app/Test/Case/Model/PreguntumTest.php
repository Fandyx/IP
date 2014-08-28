<?php
App::uses('Preguntum', 'Model');

/**
 * Preguntum Test Case
 *
 */
class PreguntumTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.preguntum'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Preguntum = ClassRegistry::init('Preguntum');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Preguntum);

		parent::tearDown();
	}

}
