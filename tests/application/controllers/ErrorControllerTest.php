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


/**
 * Error Controller Test
 *
 * @category  Zend_XHTML5
 * @package   Tests
 * @group     controllers
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_XHTML5
 */
class ErrorControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{
    /**
     * Bootstrap Zend_Application
     *
     * @return void
     */
    public function setUp()
    {
        $this->bootstrap = new Zend_Application(
            'testing',
            APPLICATION_PATH . '/configs/application.ini'
        );

        parent::setUp();
    }

    /**
     * Direct call to error page
     *
     * @return void
     */
    public function testDirectCallDisplaysYouAreHereMessage()
    {
        $this->dispatch('/error/error');
        $this->assertController('error');
        $this->assertAction('error');
        $this->assertXpathContentContains('/html/body/h2', 'You have reached the error page');
    }

    /**
     * HTTP 404
     *
     * @return void
     */
    public function testCallToNonExtistantPathResultsInPageNotFound()
    {
        $this->dispatch('/does-not-exist');
        $this->assertController('error');
        $this->assertAction('error');
        $this->assertXpathContentContains('/html/body/h2', 'Page not found');
    }

    /**
     * Application Error
     *
     * @return void
     */
    public function testApplicationErrorsResultInServerError()
    {
        $this->getResponse()->setException(new DomainException('Test Exception'));
        $this->dispatch('/');
        $this->assertController('error');
        $this->assertAction('error');
        $this->assertXpathContentContains('/html/body/h2', 'Application error');
        $this->assertXpathContentContains('/html/body/section/p', 'Test Exception');
    }
}