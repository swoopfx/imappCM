<?php
namespace Customer\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Controller\TransactionController;

/**
 *
 * @author otaba
 *        
 */
class TransactionControllerFactory implements FactoryInterface
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
        $ctr = new TransactionController();
        $renderer = $serviceLocator->getServiceLocator()->get("ViewRenderer");
        $clientGeneralService = $serviceLocator->getServiceLocator()->get('Customer\Service\ClientGeneralService');

        $ctr->setEntityManager($clientGeneralService->getEntityManager())
            ->setClientGeneralService($clientGeneralService)
            ->setRenderer($renderer);
        return $ctr;
    }
}

