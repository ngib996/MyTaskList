<?php
require 'CsvFileIterator.php';
class DataProviderIteratorTest extends PHPUnit_Framework_TestCase {
	/**
	 * @dataProvider additionProvider
	 */
	public function testAdd($a, $b, $expected) {
		$this->assertEquals ( $expected, $a + $b );
	}
	public function additionProvider() {
		return new CsvFileIterator ( 'data.csv' ); // last csv line followed by CR!!
	}
}
?>