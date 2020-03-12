<?php
namespace Wallet\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Wallet\Service\WalletService;
use Zend\Session\Container;

class WalletServiceFactory implements FactoryInterface
{

    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $xserv = new WalletService();
        $generalService = $serviceLocator->get("GeneralServicer\Service\GeneralService");
        $walletSession = new Container("wallet_session");
        $em = $generalService->getEntityManager();
        $xserv->setGeneralService($generalService)
            ->setEntityManager($em)
            ->setWalletSession($walletSession);
        return $xserv;
    }
}

