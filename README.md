About Zend_XHTML5
=================

This project grew out of a more-or-less successful attempt at "Zend-ifying"
paulirish/html5-boilerplate. In the process of that project, I quickly became
depressed, not with html5-boilerplate in particular, but the way HTML5 is
written in general. Coming from an XML-heavy background, the syntax just made
my heart break. So this is my attempt at a clean HTML5+Zend template project
that conforms to the [XHTML Syntax of HTML5](http://www.w3.org/TR/html5/the-xhtml-syntax.html).

Things included:
----------------
* [jQuery](http://jquery.com/)
* [modernizr](http://www.modernizr.com/)
* html5boilerplate.css ([from html5-boilerplate](https://github.com/paulirish/html5-boilerplate))
* [Eric Meyer's reset.css](http://meyerweb.com/eric/tools/css/reset/)

Dependencies:
-------------
* [phpDocumentor](http://www.phpdoc.org/)
* [Phing](http://www.phing.info/)
* [PHPUnit](http://www.phpunit.de/)
* [Zend_Mend](https://github.com/echoeastcreative/Zend_Mend)

Setup:
------
    pear channel-discover pear.phpunit.de
    pear channel-discover components.ez.no
    pear channel-discover pear.symfony-project.com
    pear channel-discover pear.phing.info
    pear install PhpDocumentor
    pear install phpunit/PHPUnit
    pear install phing/phing
