<?php
namespace Users\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Users\Controller\AgentController;

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
        $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $setUpInfoForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Users\Form\AgentSetupInfoForm');
        
        $setUpDataForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Users\Form\AgentSetupInfoForm');
        
        $ctr->setEntityManager($em)
            ->setSetUpInfoForm($setUpInfoForm)
            ->setSetUpDataForm($setUpDataForm);
        
        return $ctr;
    }
}

?>