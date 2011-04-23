<?php
/**
 * Zend XHTML5
 *
 * PHP version 5.3
 *
 * @category  Zend_XHTML5
 * @package   Bootstrap
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_XHTML5
 */

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define(
        'APPLICATION_ENV',
        (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production')
    );

//  Class-map Autoloading
//  @link http://weierophinney.net/matthew/archives/245-Autoloading-Benchmarks.html
require_once APPLICATION_PATH.'/../resources/classmap.application.php';
require_once APPLICATION_PATH.'/../resources/classmap.Zend_Mend.php';
require_once APPLICATION_PATH.'/../resources/classmap.Zend.php';
require_once APPLICATION_PATH.'/../resources/classmap.ZendX.php';

// Create, bootstrap, and run the application
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap()->run();