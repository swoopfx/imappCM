<?php
namespace BrokersTool\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use BrokersTool\Form\Fieldset\BrokerChildProfileFieldset;


/**
 *
 * @author swoopfx
 *        
 */
class BrokerChildProfileFieldsetFactory implements FactoryInterface
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
        
        $fieldset = new BrokerChildProfileFieldset();
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        //var_dump($em);
        $fieldset->setGeneralService($generalService)->setEntityManager($em);
        return $fieldset;
    }
}

