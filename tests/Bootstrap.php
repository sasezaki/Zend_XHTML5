<?php
//  Set conforming error level
error_reporting(E_ALL | E_STRICT);

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
