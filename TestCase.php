<?php

/**
 * #########################################
 * Easy4PHPUnit
 * #########################################
 *
 * TestCase.php
 *
 * Created on : Feb 19, 2013
 * Author     : Ahmed Fakhry
 *
 * #########################################
 */

require_once 'TestIncludes.php';

/**
 * TestCase
 * abstract class meant to be inherited by concrete classes that
 * must implement the run() method which should contain the testing
 * code of the derived TestCase
 * 
 * @author ahmed
 *
 */
abstract class TestCase
{

	/*********************************************************
	 * constructor
	 * creates a test case and registers it automatically on
	 * TestContainer
	 ********************************************************/
	function __construct()
	{
		TestContainer::getInstance()->addTest($this);
	}

	/********************************************************
	 * Abstract, needs to be implemented by derived classes
	 *******************************************************/
	abstract public function run();

	/********************************************************
	 * Unit Testing Methods
	 *******************************************************/
	protected function check_equal($expected, $actual)
	{
		if ($expected != $actual)
		{
			$backTrace = debug_backtrace();
			$lastTrace = $backTrace[0];
			
			$fileName = $lastTrace['file'];
			$lineNum = $lastTrace['line'];
			
			// register this failure
			$f = new Failure("check_equal", $expected, $actual, $lineNum, $fileName);
			TestContainer::getInstance()->addFailure($f);
		}
	}

	protected function check_float_equal($expected, $actual, $epsilon = 0.00001)
	{
		if (abs($expected - $actual) > $epsilon)
		{
			$backTrace = debug_backtrace();
			$lastTrace = $backTrace[0];
			
			$fileName = $lastTrace['file'];
			$lineNum = $lastTrace['line'];
			
			// register this failure
			$f = new Failure("check_float_equal", $expected, $actual, $lineNum, $fileName);
			TestContainer::getInstance()->addFailure($f);
		}
	}
}

?>