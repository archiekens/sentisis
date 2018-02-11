<?php
App::uses('SystemUser', 'Model');

/**
 * SystemUser Test Case
 */
class SystemUserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.system_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SystemUser = ClassRegistry::init('SystemUser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SystemUser);

		parent::tearDown();
	}

}
