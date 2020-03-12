<?php
namespace Messages\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Messages\Form\Fieldset\Massagefieldset;


/**
 *
 * @author otaba
 *        
 */
class MessageFieldsetFactory implements FactoryInterface
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
        $fieldset = new Massagefieldset();
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        $em = $generalService->getEntityManager();
        $fieldset->setEntityManager($em);
        return $fieldset;
    }
}

