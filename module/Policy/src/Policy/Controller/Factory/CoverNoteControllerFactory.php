<?php
namespace Policy\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Policy\Controller\CoverNoteController;

/**
 *
 * @author otaba
 *        
 */
class CoverNoteControllerFactory implements FactoryInterface
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
        $ctr = new CoverNoteController();
        $generalService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
        $policyService = $serviceLocator->getServiceLocator()->get('Policy\Service\PolicyService');
        $centralBrokerId = $generalService->getCentralBroker();
        $coverNoteService = $serviceLocator->getServiceLocator()->get("Policy\Service\CoverNoteService");
        $renderer = $serviceLocator->getServiceLocator()->get("ViewRenderer");
        $policyForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Policy\Form\PolicyForm');
        
        $uploadDocForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('GeneralServicer\Form\DropZoneDocUploadForm');
        
        $em = $generalService->getEntityManager();
        $ctr->setEntityManager($em)
            ->setPolicyService($policyService)
            ->setCoverNoteService($coverNoteService)
            ->setPolicyForm($policyForm)
            ->setCentralBrokerId($centralBrokerId)
            ->setRenderer($renderer)->setUploadForm($uploadDocForm)->setGeneralService($generalService);
        return $ctr;
    }
}

