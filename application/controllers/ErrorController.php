<?php
/**
 * Zend XHTML5
 *
 * PHP version 5.3
 *
 * @category  Zend_XHTML5
 * @package   Controllers
 * @author    Doug Hurst <doug@echoeastcreative.com>
 * @copyright 2011 Echo East Creative, LLC
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      https://github.com/echoeastcreative/Zend_XHTML5
 */


/**
 * Error Controller
 *
 * @category  Zend_XHTML5
 * @package   Controllers
 * @author    Doug Hurst <doug@echoeastcreative.com>
 * @copyright 2011 Echo East Creative, LLC
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      https://github.com/echoeastcreative/Zend_XHTML5
 */
class ErrorController extends Zend_Controller_Action
{
    /**
     * Error Action
     *
     * @return void
     */
    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');

        if (!$errors) {
            $this->view->message = 'You have reached the error page';
            return;
        }

        switch ($errors->type) {
        case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
        case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
        case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
            // 404 error -- controller or action not found
            $this->getResponse()->setHttpResponseCode(404);
            $this->view->message = 'Page not found';
            break;
        default:
            // application error
            $this->getResponse()->setHttpResponseCode(500);
            $this->view->message = 'Application error';
            break;
        }

        // Log exception, if logger available
        if ($this->getLog()) {
            $this->getLog()->crit($this->view->message, $errors->exception);
        }

        // conditionally display exceptions
        if (APPLICATION_ENV !== 'production') {
            $this->view->exception = $errors->exception;
        }

        $this->view->request   = $errors->request;
    }


    /**
     * Error Log Accessor
     *
     * @return Zend_Log
     */
    public function getLog()
    {
        $log = null;
        $bootstrap = $this->getInvokeArg('bootstrap');
        if ($bootstrap->hasResource('Log')) {
            $log = $bootstrap->getResource('Log');
        }
        return $log;
    }
}
