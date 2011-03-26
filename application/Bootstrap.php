<?php
/**
 * Application Bootstrap
 *
 * Sets up environment for application
 *
 * @package Zend_XHTML5
 * @since Mar 25, 2011
 * @author Doug Hurst <doug@echoeastcreative.com>
 */

/**
 * Bootstrap
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    /** Store config in registry */
	protected function _initConfig()
	{
		/** Get Config */
		$config = new Zend_Config_Ini(
		    APPLICATION_PATH . '/configs/application.ini',
		    APPLICATION_ENV
		);

		/** Put Config in Registry */
		Zend_Registry::set('config', $config);
	}

	/** Register Namespaces for Zend_Autoloder **/
	protected function _initRegisterAutoloaderNamespaces()
	{
	    $this->getApplication()->getAutoloader()
	        ->registerNamespace('Mend_');
	}

	/** Initialize View Helpers */
	protected function _initViewPlaceholders()
	{
		/**  Ensure view is loaded */
		$this->bootstrap('view');
		$view = $this->getResource('view');

		/**
		 * jQuery
		 *
		 * The latest 1.x jQuery libraries from Google's CDN if in a
		 * production environment, otherwise load the local "jquery-latest"
		 * file.
		 *
		 * @link http://jquery.com/
		 * @link http://code.google.com/apis/libraries/devguide.html
		 */
		$view->addHelperPath(
			'ZendX/JQuery/View/Helper',
			'ZendX_JQuery_View_Helper'
		);
		if (APPLICATION_ENV == 'production') {
		    $view->jQuery()->setVersion('1.5.1');
		} else {
		    $view->jQuery()->setLocalPath($view->baseUrl('js/jquery-1.5.1.min.js'));
		}
		$view->jQuery()->enable();

		/**
		 * Zend_Mend Library
		 *
		 * Provides, among other things, the BodyScript view helper to write
		 * script elements into <body/> rather than <head/>
		 *
		 * @link http://github.com/echoeastcreative/Zend_Mend
		 */
		$view->setHelperPath(
			'Mend/View/Helper',
			'Mend_View_Helper'
		);
	}

	/** Negotiate Content-Type **/
	protected function _initNegotiateContent()
	{
	    /** Ensure FrontController is loaded */
	    $this->bootstrap('frontController');

	    /** Register plugin */
        $this->frontController
            ->registerPlugin(new Mend_Controller_Plugin_XhtmlNegotiation());
	}
}
