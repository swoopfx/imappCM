<?php
namespace Packages\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Packages\Form\FeaturedPackageForm;


/**
 *
 * @author otaba
 *        
 */
class FeaturedPackageFormFactory implements FactoryInterface
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
        $form = new FeaturedPackageForm();
        return $form;
    }
}

