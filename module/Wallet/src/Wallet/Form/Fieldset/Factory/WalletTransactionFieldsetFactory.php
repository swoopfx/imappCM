<?php
namespace Wallet\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Wallet\Form\Fieldset\WalletTransactionFieldset;
use GeneralServicer\Service\GeneralService;

class WalletTransactionFieldsetFactory implements FactoryInterface
{

    public function __construct()
    {

        
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $fieldset = new WalletTransactionFieldset();
        /**
         * 
         * @var GeneralService $generalService
         */
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        $fieldset->setEntityManager($generalService->getEntityManager());
        return $fieldset;
    }
}

