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
 * Index Controller Test
 *
 * @category  Zend_XHTML5
 * @package   Tests
 * @group     controllers
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_XHTML5
 */
class IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
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
     * Index Action
     *
     * @return void
     */
    public function testCallToDocumentRootShouldPullFromIndexAction()
    {
        $this->dispatch('/');
        $this->assertController('index');
        $this->assertAction('index');
    }
}