<?php
/**
 * Zend XHTML5
 *
 * PHP version 5.3
 *
 * @category  Zend_XHTML5
 * @package   Tests
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_XHTML5
 */

//  Set conforming error level
error_reporting(E_ALL | E_STRICT);

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV') || define('APPLICATION_ENV', 'testing');

//  Maximize memory for testing
ini_set('memory_limit', '-1');

//  Class-map Autoloading
//  @link http://weierophinney.net/matthew/archives/245-Autoloading-Benchmarks.html
require_once APPLICATION_PATH.'/../resources/classmap.application.php';
require_once APPLICATION_PATH.'/../resources/classmap.Zend_Mend.php';
require_once APPLICATION_PATH.'/../resources/classmap.Zend.php';
require_once APPLICATION_PATH.'/../resources/classmap.ZendX.php';

//  Start Zend Autoloader
$loader = Zend_Loader_Autoloader::getInstance();
$loader->setFallbackAutoloader(true);

//  Load Application Module Autoloader
$applicationLoader = new Zend_Application_Module_Autoloader(
    array(
        'basePath' => realpath(dirname(__FILE__) . '/../application'),
        'namespace' => 'Application'
    )
);
$loader->pushAutoloader($applicationLoader, 'Application_');

//  Get Application Configuration
$config = new Zend_Config_Ini(
    APPLICATION_PATH . '/configs/application.ini',
    APPLICATION_ENV
);

//  Setup DB Connection
if ($config->resources->db) {
    $dbAdapter = Zend_Db::factory($config->resources->db);
    $connection = new Zend_Test_PHPUnit_Db_Connection($dbAdapter, 'unit_tests');
    Zend_Db_Table_Abstract::setDefaultAdapter($dbAdapter);

    //  Put Connection in Registry
    Zend_Registry::set('connection', $connection);
}
