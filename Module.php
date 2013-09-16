<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace SchwarzesSachsenCore;

use Zend\Validator\AbstractValidator;

use SchwarzesSachsenCore\Upload\Upload;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $translator = $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $translator->addTranslationFile(
            'phpArray',
            __DIR__ . '/language/de/Zend_Validate.php',
            'default',
            'de_DE'
        );
        AbstractValidator::setDefaultTranslator($translator);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Upload' => function($sm)
                {
                    return new Upload($sm);
                }
            )
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'invokables' =>
                array('breadcrumb' => 'SchwarzesSachsenCore\View\Helper\Breadcrumb')
            );
    }
}
