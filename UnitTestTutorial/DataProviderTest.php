<?php
class DataProviderTest extends PHPUnit_Framework_TestCase {
	/**
	 * @dataProvider additionProvider
	 */
	public function testAdd($a, $b, $expected) {
		$this->assertEquals ( $expected, $a + $b );
	}
	public function additionProvider() {
		return array (
				array (
						0,  //a
						0, //b
						0  //expected
				),
				array (
						0,
						1,
						1 
				),
				array (
						1,
						0,
						1 
				),
				array (
						1,
						1,
						3 
				) 
		);
	}
}
?>