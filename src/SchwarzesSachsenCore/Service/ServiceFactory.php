<?php

namespace SchwarzesSachsenCore\Service;

use FlurfunkCore\Service\AbstractService;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Abstract Service factory
 *
 * This factory creates all flurfunk Services. They have to be named Flurfunk*\Service\*
 * Zend 2 will afterwards automatically inject the serviceLocator in Services that implement
 * the ServiceLocatorAwareInterface.
 *
 * @copyright Copyright (c) 2012 Unister GmbH
 */
class ServiceFactory implements AbstractFactoryInterface
{
    /**
     * Checks if the requested Service is a flurfunk Service
     *
     * It has to be named Flurfunk*\Service\*.
     *
     * @see \Zend\ServiceManager\AbstractFactoryInterface::canCreateServiceWithName()
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator Service locator
     * @param $name Service Name
     * @param $requestedName Requested service name
     * @return bool True if service can created, otherwise false
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return preg_match('/\\\\Service\\\\(.*)$/iu', $requestedName) != 0;
    }

    /**
     * Creates the service.
     *
     * If the Service implements the ServiceLocatorAwareInterface Zend2 will automatically
     * inject the Service Locator into it.
     *
     * @see \Zend\ServiceManager\AbstractFactoryInterface::createServiceWithName()
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator Service locator
     * @param $name Service Name
     * @param $requestedName Requested service name
     * @return AbstractService
     */
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return new $requestedName();
    }
}