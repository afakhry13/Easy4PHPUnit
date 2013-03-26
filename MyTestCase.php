<?php

/**
 * #########################################
 * Easy4PHPUnit
 * #########################################
 * 
 * MyTestCase.php
 *
 * Created on : Feb 19, 2013
 * Author     : Ahmed Fakhry
 *
 * #########################################
 */

/******************************************************
 * Step 1: Create a file or files that will have your
 *         test cases and require the TestIncludes.php 
 *         file.
 ******************************************************/
require_once 'TestIncludes.php';


/******************************************************
 * Step 2: Extend the abstract TestCase class
 *         With any concrete test case classes
 *         you need. Implement the run() method
 *         which will have your test code in it.
 *         You must use the Unit Testing methods
 *         of the TestCase class like check_equal()
 ******************************************************/
class NumEqualityTest extends TestCase 
{
	public function run()
	{
		$a = 5;
		$b = 5;
		
		$this->check_equal(5, $a);
	}
}

class StringEqualityTest extends TestCase
{
	public function run()
	{
		$s1 = "Hello";
		$s2 = "Hello";
		
		$this->check_equal("Hello", $s1);
		$this->check_equal("Hello", $s2);
		$this->check_equal($s1, $s2);
	}
}

class NonEqualStringsTest extends TestCase
{
	public function run()
	{
		$s1 = "hello";
		
		$this->check_equal("Hello", $s1);
	}
}

class FloatingPointTest1 extends TestCase
{
	public function run()
	{
		$float1 = 0.003;
		$float2 = 0.00302;
		
		$this->check_float_equal($float1, $float2);
	}
}

class FloatingPointTest2 extends  TestCase
{
	public function run()
	{
		$float1 = 0.003;
		$float2 = 0.003;
		
		$this->check_float_equal($float1, $float2);
	}
}


/******************************************************
 * Step 3: Instantiate your concrete test case class
 *         so that they're automatically added to the
 *         list of tests in TestContainer.
 ******************************************************/
$t1 = new NumEqualityTest();
$t2 = new StringEqualityTest();
$t3 = new NonEqualStringsTest();
$t4 = new FloatingPointTest1();
$t5 = new FloatingPointTest2();

?>