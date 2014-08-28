<?php
App::uses('ProfesorArea', 'Model');

/**
 * ProfesorArea Test Case
 *
 */
class ProfesorAreaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.profesor_area'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProfesorArea = ClassRegistry::init('ProfesorArea');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProfesorArea);

		parent::tearDown();
	}

}
