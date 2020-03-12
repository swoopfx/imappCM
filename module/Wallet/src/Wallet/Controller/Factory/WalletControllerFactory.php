<?php
namespace Wallet\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Wallet\Controller\WalletController;
use GeneralServicer\Service\GeneralService;

class WalletControllerFactory implements FactoryInterface
{

    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        /**
         *
         * @var \Wallet\Controller\WalletController $ctr
         */
        $ctr = new WalletController();
        /**
         *
         * @var GeneralService $generalService
         */
        $generalService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
        $viewRender = $generalService->getViewRender();
        $walletService = $serviceLocator->getServiceLocator()->get("Wallet\Service\WalletService");
        $formElementManager = $serviceLocator->getServiceLocator()->get("formElementManager");
        $raveCardPaymentService = $serviceLocator->getServiceLocator()->get("Transactions\Service\RaveCardPaymentService");
        $walletTransactionForm = $formElementManager->get("Wallet\Form\WalletTransactionForm");
        $walletPasscodeForm = $formElementManager->get("Wallet\Form\WalletPasscodeForm");
        $walletAddFundForm = $formElementManager->get("Wallet\Form\WalletAddFundForm");
        $walletChangePasscodeForm = $formElementManager->get("Wallet\Form\WalletChangePasscodeFormFactory");
        $em = $generalService->getEntityManager();
 
        $ctr->setEntityManager($em)
            ->setGeneralService($generalService)
            ->setWalletService($walletService)
            ->setWalletTransactionForm($walletTransactionForm)
            ->setWalletPasscodeForm($walletPasscodeForm)
            ->setWalletAddFundForm($walletAddFundForm)
            ->setWalletChangePasscodeForm($walletChangePasscodeForm)
            ->setRaveCardPaymentService($raveCardPaymentService)
            ->setRenderer($viewRender);
        return $ctr;
    }
}

