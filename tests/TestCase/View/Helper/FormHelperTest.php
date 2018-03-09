<?php
namespace SweetAlertHelper\Test\TestCase\View\Helper;

use SweetAlertHelper\View\Helper\FormHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
* App\View\Helper\FormHelperTest Test Case
*/
class FormHelperTest extends TestCase{
	/**
	* Test subject
	*
	* @var \SweetAlertHelper\View\Helper\FormHelper
	*/
	public $Form;
	
	/**
	* setUp method
	*
	* @return void
	*/
	public function setUp()
	{
		parent::setUp();
		$view = new View();
		$this->Form = new FormHelper($view);
	}
	
	
	public function testPostLink(){
		$result = $this->Form->postLink("test");
		$strings[] = "onclick";
		$strings[] = "a href";
		$strings[] = "test";
		$strings[] = "onclick";
		
		$this->assertNotEmpty($result);
		
		foreach($strings as $string){
			$this->assertContains($string,$result);
		}
	}
	
	
	/**
	* tearDown method
	*
	* @return void
	*/
	public function tearDown()
	{
		unset($this->Form);
		
		parent::tearDown();
	}
	
	/**
	* Test initial setup
	*
	* @return void
	*/
	public function testInitialization()
	{
		$this->markTestIncomplete('Not implemented yet.');
	}
}
