<?php
namespace Offer\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Offer\Form\OfferObjectForm;


/**
 *
 * @author swoopfx
 *        
 */
class OfferObjectFormFactory implements FactoryInterface
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
        $form = new OfferObjectForm();
        
        $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $auth = $serviceLocator->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        $form->setEntityManager($em);
        $form->setUserId($auth);
        return $form;
    }
}

