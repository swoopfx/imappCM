<?php
namespace Offer\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Offer\Form\ReccomendInsurerForm;


/**
 *
 * @author otaba
 *        
 */
class RecomendInsurerFormFactory implements FactoryInterface
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
        $form = new ReccomendInsurerForm();
        $generalService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
        $form->setEntityManager($generalService->getEntityManager());
        return $form;
    }
}

