<?php
App::uses('PreguntaTag', 'Model');

/**
 * PreguntaTag Test Case
 *
 */
class PreguntaTagTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.pregunta_tag'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PreguntaTag = ClassRegistry::init('PreguntaTag');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PreguntaTag);

		parent::tearDown();
	}

}
