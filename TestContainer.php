<?php

/**
 * #########################################
 * Easy4PHPUnit
 * #########################################
 *
 * TestContainer.php
 *
 * Created on : Feb 19, 2013
 * Author     : Ahmed Fakhry
 *
 * #########################################
 */

require_once 'TestIncludes.php';

/**
 * singleton class to contain all the test cases and test failures (if any)
 * 
 * can run all its registered tests, and reports the results
 */
class TestContainer
{
	private static $mInstance;
	private $mTests; // Tests containers
	private $mFailures; // Failures container

	private $mNumTests;
	private $mNumFailures;
	private $mNumSuccesses;

	/**
	 * getInstance()
	 * 
	 * Singleton interface.
	 * @return TestContainer refernce
	 */
	public static function getInstance()
	{
		if (self::$mInstance == null)
		{
			self::$mInstance = new TestContainer();
		}

		return self::$mInstance;
	}

	/**
	 * private constructor
	 * 
	 * Not allowed to be constructed from the outside
	 */
	private function __construct()
	{
		$this->mTests = array();
		$this->mFailures = array();

		$this->mNumTests = 0;
		$this->mNumFailures = 0;
		$this->mNumSuccesses = 0;
	}

	/**
	 * addTest()
	 * 
	 * Adds a test to the container
	 * @param TestCase $TestCase
	 */
	public function addTest(TestCase $TestCase)
	{
		$this->mTests[] = $TestCase; // append it to the end
		$this->mNumTests++;
		$this->mNumSuccesses++;
	}

	/**
	 * addFailure()
	 * Enter description here ...
	 * @param Failure $failure
	 */
	public function addFailure(Failure $failure)
	{
		$this->mFailures[] = $failure;
		$this->mNumFailures++;
		$this->mNumSuccesses = $this->mNumTests - $this->mNumFailures;
	}

	/**
	 * runAll()
	 * 
	 * Runs all the registered test cases and reports the results.
	 */
	public function runAll()
	{
		foreach ($this->mTests as $test)
		{
			$test->run();
		}

		// report failures (if any)
		$this->reportFailures();

		// report success if all succeeded
		$this->reportSuccess();

		// display the bar
		$this->displayBar();
	}

	///////////////////////////////////////////////////////
	///
	/// Private helper methods
	///
	///////////////////////////////////////////////////////

	/**
	 * reportFailures()
	 * 
	 * Reports the failed tests (if any).
	 */
	private function reportFailures()
	{
		if ($this->mNumFailures > 0)
		{
			foreach ($this->mFailures as $failure)
			{
				echo $failure->getMessage() . "<br /><br />";
			}

			// echo a couple of new lines
			echo "<br /><br />";

			echo "There were <b>{$this->mNumFailures}</b> failure(s) out of <b>{$this->mNumTests}</b> test(s).<br />";
		}
	}

	/**
	 * reportSuccess()
	 * 
	 * reports that all tests succeeded if there are no failures
	 */
	private function reportSuccess()
	{
		if ($this->mNumFailures == 0)
		{
			echo "All succeeded. {$this->mNumSuccesses}/{$this->mNumTests}.<br />";
		}
	}

	/**
	 * displayBar()
	 * 
	 * Displays the failure to success bar
	 */
	private function displayBar()
	{
		$successPerCent = ceil($this->mNumSuccesses * 100 / $this->mNumTests);
		$failurePerCent = floor($this->mNumFailures * 100 / $this->mNumTests);

		$html = <<<BARDOC
		
		<style type="text/css">
			div#bar {
				width: 60%;
				display: block;
				overflow: auto;
				border: 2px solid gray;
			}

			div#success {
				margin: 0px;
				height: 20px;
				border: 0px;
				background-color: green;
				width: {$successPerCent}%;
				float: right;
				display: block;
			}

			div#fail {
				margin: 0px;
				height: 20px;
				border: 0px;
				background-color: red;
				width: {$failurePerCent}%;
				float: left;
				display: block;
			}
		</style>
		
		<div id="bar">
			<div id="fail">{$failurePerCent}%</div>
			<div id="success">{$successPerCent}%</div>
		</div>
BARDOC;

		echo $html;
	}
}

?>