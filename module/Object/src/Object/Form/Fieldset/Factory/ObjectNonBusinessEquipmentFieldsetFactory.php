<?php
namespace Object\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Object\Form\Fieldset\NonBusinessEquipmentFieldset;


/**
 *
 * @author otaba
 *        
 */
class ObjectNonBusinessEquipmentFieldsetFactory implements FactoryInterface
{

    /**
     */
    public function __construct()
    {}

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $fieldset = new NonBusinessEquipmentFieldset();
        $generalService = $serviceLocator->getServicelocator()->get("GeneralServicer\Service\GeneralService");
        $em = $generalService->getEntityManager();
        $fieldset->setEntityManager($em);
        return $fieldset;
    }
}

