<?php
namespace Policy\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Policy\Service\PolicyService;
use Zend\Session\Container;

/**
 *
 * @author swoopfx
 *        
 */
class PolicyServiceFactory implements FactoryInterface
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
        $xserv = new PolicyService();
        
        $policySession = new Container("broker_policy_session");
//         var_dump($policySession);
        $generalService = $serviceLocator->get('GeneralServicer\Service\GeneralService');
        $invoiceService = $serviceLocator->get("Transactions\Service\InvoiceService");
        $em = $generalService->getEntityManager();
        $centralBrokerId = $generalService->getCentralBroker();
        $xserv->setGeneralService($generalService)
            ->setEntityManager($em)
            ->setCentralBrokerId($centralBrokerId)
            ->setUrlViewHelper($generalService->getUrlViewHelper())
            ->setPolicySession($policySession)->setInvoiceService($invoiceService);
        return $xserv;
    }
}

