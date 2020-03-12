<?php
namespace Settings\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Settings\Form\Fieldset\PolicyCoverTermedValueFieldset;


/**
 *
 * @author otaba
 *        
 */
class GeneralPocilyCoverTermedFieldsetFactory implements FactoryInterface
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
        
        $fieldset = new PolicyCoverTermedValueFieldset();
        $generalService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
        $em = $generalService->getEntityManager();
        
        $fieldset->setEntityManager($em);
        return  $fieldset;
    }
}

