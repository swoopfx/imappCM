<?php
namespace Users\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Users\Form\Fieldset\UserProfileFieldset;

/**
 *
 * @author swoopfx
 *        
 */
class UserProfileFieldsetFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $fieldset = new UserProfileFieldset();
        $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $fieldset->setEntityManager($em);
        
        return $fieldset;
    }
}

?>