<?php

/**
 * #########################################
 * Easy4PHPUnit
 * #########################################
 *
 * Failure.php
 *
 * Created on : Feb 19, 2013
 * Author     : Ahmed Fakhry
 *
 * #########################################
 */

require_once 'TestIncludes.php';

class Failure
{
	private $mExpected;
	private $mActual;
	private $mLine;
	private $mFile;
	private $mMessage;
	private $mFunctionName;
	
	public function __construct($functionName, $expected, $actual, $line, $file)
	{
		$this->mFunctionName = $functionName;
		$this->mExpected = $expected;
		$this->mActual = $actual;
		$this->mFile = $file;
		$this->mLine = $line;
		
		$this->mMessage = "Failure: <b>{$functionName}({$expected}, {$actual})</b> in File: <b>{$file}</b> in line: <b>{$line}</b>";
	}
	
	public function getMessage() 
	{
		return $this->mMessage;
	}
}

?>