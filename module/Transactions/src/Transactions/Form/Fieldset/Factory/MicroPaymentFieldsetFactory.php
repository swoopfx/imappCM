<?php
namespace Transactions\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Transactions\Form\Fieldset\MicroPaymentFieldset;


/**
 *
 * @author otaba
 *        
 */
class MicroPaymentFieldsetFactory implements FactoryInterface
{

    /**
     */
    public function __construct()
    {
        
        
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
        $fieldset = new MicroPaymentFieldset();
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        $fieldset->setEntityManager($generalService->getEntityManager());
        return $fieldset;
    }
}

