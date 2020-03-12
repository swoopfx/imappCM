<?php
namespace Offer\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Offer\Form\OfferForm;

/**
 *
 * @author swoopfx
 *        
 */
class OfferFormFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new OfferForm();
        
        return $form;
    }
}

?>