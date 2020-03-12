<?php
namespace GeneralServicer\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use GeneralServicer\Form\Fieldset\ManualPremiumFieldset;


/**
 *
 * @author otaba
 *        
 */
class ManualPremiumFieldsetFactory implements FactoryInterface
{

    

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
        $fieldset = new ManualPremiumFieldset();
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        
        $em = $generalService->getEntityManager();
        $fieldset->setEntityManager($em);
        return $fieldset ;
    }
}

