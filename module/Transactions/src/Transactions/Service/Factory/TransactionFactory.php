<?php
namespace Transactions\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Transactions\Service\TransactionService;

/**
 *
 * @author swoopfx
 *        
 */
class TransactionFactory implements FactoryInterface
{

    private $auth;

    /**
     *
     * @var object
     */
    private $user;

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
        $serve = new TransactionService();
        $generalService = $serviceLocator->get('GeneralServicer\Service\GeneralService');
       // $clientGeneralService = $serviceLocator->get("Customer\Service\ClientGeneralService");
        $auth = $generalService->getAuth();
        $this->auth = $auth;
        $centralBrokerId = $generalService->getCentralBroker();
        $this->getUserObject();
        $serve->setEntityManager($generalService->getEntityManager())
            ->setUser($this->user)
            ->setUserId($generalService->getUserId())
            ->setCentralBrokerId($centralBrokerId)
            ->setGeneralService($generalService);
           // ->setCustomerId($clientGeneralService->getCustomerId());
        return $serve;
    }

    private function getUserObject()
    {
        if ($this->auth->hasIdentity()) {
            $this->user = $this->auth->getIdentity();
        }
    }
}

