<?php
/**
 * Zend XHTML5
 *
 * PHP version 5.3
 *
 * @category  Zend_XHTML5
 * @package   Bootstrap
 * @author    Doug Hurst <doug@echoeastcreative.com>
 * @copyright 2011 Echo East Creative, LLC
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      https://github.com/echoeastcreative/Zend_XHTML5
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

/** Zend_Application */
require_once 'Zend/Application.php';

// Create, bootstrap, and run the application
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap()->run();