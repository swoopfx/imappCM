<?php
namespace BrokersTool\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use BrokersTool\Form\Fieldset\BrokerChildFieldset;


class BrokerChildFieldsetFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $field = new BrokerChildFieldset();
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        $field->setEntityManager($generalService->getEntityManager());
        return $field;
    }
}

