<?php
namespace Json\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Json\Controller\PackageController;


/**
 *
 * @author swoopfx
 *        
 */
class PackageControllerFactory implements FactoryInterface
{

    /**
     */
    public function __construct()
    {}

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new PackageController();
        $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $ctr->setEntityManager($em);
        return $ctr;
    }
}

