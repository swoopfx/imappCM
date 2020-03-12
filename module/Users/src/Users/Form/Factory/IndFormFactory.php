<?php
namespace Users\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Users\Form\IndForm;

/**
 *
 * @author swoopfx
 *        
 */
class IndFormFactory implements FactoryInterface
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
        $form = new IndForm();
        $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $form->setEntityManager($em);
        return $form;
    }
}

