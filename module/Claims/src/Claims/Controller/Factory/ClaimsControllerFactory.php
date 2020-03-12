<?php
namespace Claims\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Claims\Controller\ClaimsController;

/**
 *
 * @author swoopfx
 *        
 */
class ClaimsControllerFactory implements FactoryInterface
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
        $ctr = new ClaimsController();
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');

        $renderer = $generalService->getViewRender();
        $claimsForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Claims\Form\ClaimsForm');
        $claimsService = $serviceLocator->getServiceLocator()->get("Claims\Service\ClaimsService");
        $blobService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\BlobService");
        $brokerClaimsSession = $claimsService->getBrokerClaimsSession();

        $claimsMotorForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Claims\Form\ClaimsMotorForm');

        $commentForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Comments\Form\CommentForm");

        $dropZoneUploadForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("GeneralServicer\Form\DropZoneDocUploadForm");

        $claimsExportForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("Claims\Form\ClaimsExportClaimsForm");

        $claimsApprovedForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("Claims\Form\CLaimsApprovedForm");

        $claimsRejectedForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("Claims\Form\ClaimsRejectedForm");

        // var_dump($commentForm);

        $ctr->setGeneralService($generalService)
            ->setClaimsForm($claimsForm)
            ->setClaimsService($claimsService)
            ->setClaimsMotorForm($claimsMotorForm)
            ->setEntityManager($generalService->getEntityManager())
            ->setCommentForm($commentForm)
            ->setClaimsApprovedForm($claimsApprovedForm)
            ->setClaimsExportForm($claimsExportForm)
            ->setClaimsRejectedForm($claimsRejectedForm)
            ->setDropZoneForm($dropZoneUploadForm)
            ->setRenderer($renderer)
            ->setBlobService($blobService)
            ->setLocator($serviceLocator->getServiceLocator())
            ->setBrokerClaimsSession($brokerClaimsSession);
        return $ctr;
    }
}

