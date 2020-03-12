<?php
namespace Transactions\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Transactions\Form\Fieldset\CardBillingFieldset;


/**
 *
 * @author otaba
 *        
 */
class CardBillingFieldsetFactory implements FactoryInterface
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
        
       $fieldset = new CardBillingFieldset();
       $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
       $fieldset->setEntityManager($generalService->getEntityManager());
       return $fieldset;
    }
}

