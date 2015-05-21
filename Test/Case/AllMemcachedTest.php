<?php

/**
 * AllMemcachedTest file
 *
 * PHP 5
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice
 *
 * @copyright     Wan Qi Chen <kami@kamisama.me>
 * @link          https://github.com/kamisama/CakePHP-Memcached-Engine
 * @package       Memcached.Test.Case.Cache.Engine
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * AllMemcachedTest
 */
class AllMemcachedTest extends PHPUnit_Framework_TestSuite {

	/**
	 * 	All Memcached tests suite
	 *
	 * @return PHPUnit_Framework_TestSuite the instance of PHPUnit_Framework_TestSuite
	 */
	public static function suite() {
		$suite = new CakeTestSuite('All Memcached Tests');
		$basePath = App::pluginPath('Memcached') . 'Test' . DS . 'Case' . DS;
		$suite->addTestDirectoryRecursive($basePath);
		return $suite;
	}

}
