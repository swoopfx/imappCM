<?php
namespace Users\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Users\Form\Fieldset\AgentRegisterFieldset;

/**
 *
 * @author swoopfx
 *        
 */
class AgentRegsiterFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $agentRegisterFeild = new AgentRegisterFieldset();
        // $op = $serviceLocator->get('users_module_options');
        $entityManager = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        // $agentRegisterFeild->setOptions($op);
        $agentRegisterFeild->setEntityManager($entityManager);
        
        return $agentRegisterFeild;
        
        // TODO - Insert your code here
    }
}

?>