<?php
namespace GeneralServicer\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use GeneralServicer\Form\DropZoneDocUploadForm;

/**
 *
 * @author otaba
 *        
 */
class DropZoneDocUploadFormFactory implements FactoryInterface
{

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
        $form = new DropZoneDocUploadForm();
        return $form;
    }
}

