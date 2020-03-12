<?php
namespace Welcome\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Welcome\Controller\AgentController;

/**
 *
 * @author swoopfx
 *        
 */
class AgentControllerFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new AgentController();
        $op = $serviceLocator->getServiceLocator()->get('csnuser_module_options');
        $ctr->setOptions($op);
        $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $ctr->setEntityManager($em);
        $trans = $serviceLocator->getServiceLocator()->get('MvcTranslator');
        $ctr->setTranslator($trans);
        
        return $ctr;
    }
}

?>