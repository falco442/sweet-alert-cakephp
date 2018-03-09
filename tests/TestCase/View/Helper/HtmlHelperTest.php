<?php
namespace SweetAlertHelper\Test\TestCase\View\Helper;

use SweetAlertHelper\View\Helper\HtmlHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
* App\View\Helper\HtmlHelperTest Test Case
*/
class HtmlHelperTest extends TestCase{
	/**
	* Test subject
	*
	* @var \SweetAlertHelper\View\Helper\HtmlHelper
	*/
	public $Html;
	
	/**
	* setUp method
	*
	* @return void
	*/
	public function setUp()
	{
		parent::setUp();
		$view = new View();
		$this->Html = new HtmlHelper($view);
	}
	
	public function testLink(){
		$result = $this->Html->link("test");
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
		unset($this->Html);
		
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
