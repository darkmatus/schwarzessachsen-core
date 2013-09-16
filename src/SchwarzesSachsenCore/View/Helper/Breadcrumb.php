<?php
/**
 * Breadcrumb View Helper
 *
 * Breadcrumb view Helper for displaying a breadcrumb
 *
 * @copyright Copyright (c) 2013 Michael Mueller
 */
namespace SchwarzesSachsenCore\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Breadcrumb extends AbstractHelper
{
    /**
     * Builds a breadcrumb
     * @param array $path
     * @return string HTML Code
     */
    public function __invoke($path = array())
    {
        return $this->view->render('schwarzes-sachsen-core/view-helper/breadcrumb.phtml', array('path' => $path));
    }
}
