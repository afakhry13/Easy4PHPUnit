<?php

/**
 * #########################################
 * Easy4PHPUnit
 * #########################################
 *
 * run.php
 *
 * Created on : Feb 19, 2013
 * Author     : Ahmed Fakhry
 *
 * #########################################
 */


/***********************************************************
 * Step 4: Require your TestIncludes.php file and the file(s)
 *         that contain(s) your concrete test case classes,
 *         and invoke the runAll() method of the TestContainer
 *         Singleton class
 **********************************************************/
require_once 'TestIncludes.php';
require_once 'MyTestCase.php';

TestContainer::getInstance()->runAll();

?>