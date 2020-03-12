<?php
namespace Messages\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Messages\Form\Fieldset\MessageEnteredFieldset;


/**
 *
 * @author otaba
 *        
 */
class MessageEnteredFieldsetFactory implements FactoryInterface
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
        $fieldset = new MessageEnteredFieldset();
        $generalService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
        $em = $generalService->getEntityManager();
        $fieldset->setEntityManager($em);
        return $fieldset;
    }
}

