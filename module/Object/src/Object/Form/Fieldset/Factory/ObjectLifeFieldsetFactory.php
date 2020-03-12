<?php
namespace Object\src\Object\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Object\Form\Fieldset\ObjectLifeFieldset;

class ObjectLifeFieldsetFactory implements FactoryInterface
{

    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $fieldset = new ObjectLifeFieldset();
        $generalService = $serviceLocator->getServicelocator()->get("GeneralServicer\Service\GeneralService");
        $em = $generalService->getEntityManager();
        $fieldset->setEntityManager($em);
        return $fieldset;
    }
}

