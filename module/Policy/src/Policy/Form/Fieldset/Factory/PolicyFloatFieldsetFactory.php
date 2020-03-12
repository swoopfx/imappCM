<?php
namespace Policy\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Policy\Form\Fieldset\PolicyFloatFieldset;


/**
 *
 * @author otaba
 *        
 */
class PolicyFloatFieldsetFactory implements FactoryInterface
{

    

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
       $fieldset = new PolicyFloatFieldset();
       $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
       $em = $generalService->getEntityManager();
       
       $fieldset->setEntityManager($em);
       return $fieldset;
    }
}

