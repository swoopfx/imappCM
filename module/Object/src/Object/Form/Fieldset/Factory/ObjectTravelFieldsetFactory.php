<?php
namespace Object\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Object\Form\Fieldset\ObjectTravelFieldset;

/**
 *
 * @author otaba
 *        
 */
class ObjectTravelFieldsetFactory implements FactoryInterface
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
        $fiedlset = new ObjectTravelFieldset();
        $generalService = $serviceLocator->getServicelocator()->get("GeneralServicer\Service\GeneralService");
        $em = $generalService->getEntityManager();
        $fiedlset->setEntityManager($em);
        return $fiedlset;
    }
}

