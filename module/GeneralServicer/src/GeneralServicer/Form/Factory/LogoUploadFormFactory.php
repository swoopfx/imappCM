<?php
namespace GeneralServicer\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use GeneralServicer\Form\LogoUploadForm;


/**
 *
 * @author otaba
 *        
 */
class LogoUploadFormFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
        $form = new LogoUploadForm();
        return $form;
    }
}

