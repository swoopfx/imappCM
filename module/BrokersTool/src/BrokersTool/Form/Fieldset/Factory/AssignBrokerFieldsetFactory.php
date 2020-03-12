<?php
namespace BrokersTool\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use BrokersTool\Form\Fieldset\AssignBrokerFieldset;

/**
 *
 * @author swoopfx
 *        
 */
class AssignBrokerFieldsetFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $field = new AssignBrokerFieldset();
        $generalService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
        $em = $generalService->getEntityManager();
        $centralBrokerId = $generalService->getCentralBroker();
        
        $field->setEntityManager($em)->setCentralBrokerId($centralBrokerId);
        return $field;
    }
}

