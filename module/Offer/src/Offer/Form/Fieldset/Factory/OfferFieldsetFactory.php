<?php
namespace Offer\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Offer\Form\Fieldset\OfferFieldset;

/**
 *
 * @author swoopfx
 *        
 */
class OfferFieldsetFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $fieldset = new OfferFieldset();
        $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $fieldset->setEntityManager($em);
        return $fieldset;
    }
}

?>