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

/**
 * Application Bootstrap
 *
 * @category  Zend_XHTML5
 * @package   Bootstrap
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_XHTML5
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    /**
     * Store config in registry
     *
     * @return void
     */
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

    /**
     * Negotiate Content-Type
     *
     * @return void
     */
    protected function _initNegotiateContent()
    {
        /** Ensure FrontController is loaded */
        $this->bootstrap('frontController');

        /** Register plugin */
        $this
            ->frontController
            ->registerPlugin(new Mend_Controller_Plugin_XhtmlNegotiation());
    }
}
