<?php
class DependencyAndDataProviderComboTest extends PHPUnit_Framework_TestCase {
	public function provider() {
		return array (
				array (
						'provider1' 
				),
				array (
						'provider2'
				),
		);
	}
	public function testProducerFirst() {
		$this->assertTrue ( true );
		return 'first';
	}
	public function testProducerSecond() {
		$this->assertTrue ( true );
		return 'second';
	}
	/**
	 * @depends testProducerFirst
	 * @depends testProducerSecond
	 * @dataProvider provider
	 */
	public function testConsumer($a) {
		var_dump(func_get_args());
		$this->assertEquals ( array ($a,'first','second'), func_get_args () );
	}
}
?>