<?php
/**
 * Zend XHTML5
 *
 * PHP version 5.3
 *
 * @category  Zend_XHTML5
 * @package   Tests
 * @author    Doug Hurst <doug@echoeastcreative.com>
 * @copyright 2011 Echo East Creative, LLC
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      https://github.com/echoeastcreative/Zend_XHTML5
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

//  Ensure library/ is on include_path
set_include_path(
    implode(
        PATH_SEPARATOR,
        array(
            realpath(realpath(dirname(__FILE__) . '/../../Zend_Mend/library')),
            realpath('/usr/local/zend/share/ZendFramework/library'),
            get_include_path()
        )
    )
);

//  Start Zend Autoloader
require_once 'Zend/Loader/Autoloader.php';
$loader = Zend_Loader_Autoloader::getInstance();
$loader
    ->setFallbackAutoloader(true)
    ->registerNamespace('Mend_');

//  Load Application Module Autoloader
$applicationLoader = new Zend_Application_Module_Autoloader(array(
    'basePath' => realpath(dirname(__FILE__) . '/../application'),
    'namespace' => 'Application'
));
$loader->pushAutoloader($applicationLoader, 'Application_');

//  Get Application Configuration
$config = new Zend_Config_Ini(
    APPLICATION_PATH . '/configs/application.ini',
    APPLICATION_ENV
);

//  Setup DB Connection
$dbAdapter = Zend_Db::factory($config->resources->db);
$connection = new Zend_Test_PHPUnit_Db_Connection($dbAdapter, 'unit_tests');
Zend_Db_Table_Abstract::setDefaultAdapter($dbAdapter);

/** Put Connection in Registry */
Zend_Registry::set('connection', $connection);
