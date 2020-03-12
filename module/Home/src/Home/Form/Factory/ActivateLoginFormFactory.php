<?php
namespace Home\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Home\Form\ActivateLoginForm;


/**
 *
 * @author otaba
 *        
 */
class ActivateLoginFormFactory implements FactoryInterface
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
        $form = new ActivateLoginForm();
        $generalService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
        $em = $generalService->getEntityManager();
        $form->setEntityManager($em);
        return $form;
    }
}

