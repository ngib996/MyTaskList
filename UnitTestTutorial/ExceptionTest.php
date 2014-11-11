<?php
use Doctrine\Instantiator\Exception\InvalidArgumentException;
class ExceptionTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testException1()
	{
		// $this->setExpectedException('InvalidArgumentException'); alternative to DocBlock
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testException2()
	{
		// $this->setExpectedException('InvalidArgumentException'); alternative to DocBlock
		throw new InvalidArgumentException();
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 * @expectedExceptionMessage Some Message
	 * @expectedExceptionCode 20
	 */
	public function testExceptionHasRightMessage()
	{
		// $this->setExpectedException('InvalidArgumentException','Some Message', 10); alternative to DocBlock
		throw new InvalidArgumentException('Some Message', 10);
	}
}

?>