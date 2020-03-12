<?php
namespace Customer\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Service\CustomerProposalService;


/**
 *
 * @author otaba
 *        
 */
class CustomerProposalServiceFactory implements FactoryInterface
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
        
        $xserv = new CustomerProposalService();
        $clientGeneralService = $serviceLocator->get("Customer\Service\ClientGeneralService");
//         $em = $clientGeneralService->getEnti

        $em = $clientGeneralService->getEntityManager();
        $xserv->setClientGeneralService($clientGeneralService)->setEntityManager($em);
        return $xserv;
    }
}

