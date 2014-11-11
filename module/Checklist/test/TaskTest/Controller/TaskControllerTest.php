<?php

namespace TaskTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class TaskControllerTest extends AbstractHttpControllerTestCase {
	protected $traceError = true;
	public function setUp() {
		$this->setApplicationConfig ( include 'config/application.config.php' );
		parent::setUp ();
	}
	public function testIndexActionCanBeAccessed() {
		$this->dispatch ( '/task' );
		$this->assertResponseStatusCode ( 200 );
		
		$this->assertModuleName ( 'Checklist' );
		$this->assertControllerName ( 'Checklist\Controller\Task' );
		$this->assertControllerClass ( 'TaskController' );
		$this->assertMatchedRouteName ( 'task' );
	}
	public function testaddAction() {
		$postData = array (
				'id' => "",
				'task' => 'todo',
				'created' => '2014-11-07',
				'compledted'=>0, 
		);
		$this->dispatch ( '/task/add', 'POST', $postData );
		$this->assertResponseStatusCode ( 302,$this->getResponse() );
		$this->assertRedirectTo ( '/task/' );
	}
}