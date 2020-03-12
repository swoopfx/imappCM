<?php
namespace Packages\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Packages\Form\Fieldset\FeaturedPackagesFieldset;


/**
 *
 * @author otaba
 *        
 */
class FeaturedPackagesFieldsetFactory implements FactoryInterface
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
        $feildest = new FeaturedPackagesFieldset();
        $generalService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
        $em = $generalService->getEntityManager();
        $centralBrokerId = $generalService->getCentralBroker();
        $feildest->setEntityManager($em)->setCentralBrokerId($centralBrokerId);
        return $feildest;
    }
}

