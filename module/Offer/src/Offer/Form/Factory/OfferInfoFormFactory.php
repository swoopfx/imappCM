<?php
namespace Offer\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Offer\Form\OfferInfoForm;


/**
 *
 * @author swoopfx
 *        
 */
class OfferInfoFormFactory implements FactoryInterface
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
        $offerInfoForm = new OfferInfoForm();
        $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $offerInfoForm->setEntityManager($em);
        return $offerInfoForm;
    }
}

