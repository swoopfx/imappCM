<?php
namespace Proposal\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Proposal\Service\PremiumGeneratorService;

/**
 *
 * @author otaba
 *        
 */
class PremiumGeneratorServiceFactory implements FactoryInterface
{

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
       $xserv = new PremiumGeneratorService();
       return $xserv;
    }
}

