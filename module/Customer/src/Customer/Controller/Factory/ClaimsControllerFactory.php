<?php
namespace Customer\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Controller\ClaimsController;

class ClaimsControllerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new ClaimsController();

        $renderer = $serviceLocator->getServiceLocator()->get("ViewRenderer");
        $clientGeneralService = $serviceLocator->getServiceLocator()->get('Customer\Service\ClientGeneralService');
        $boardService = $serviceLocator->getServiceLocator()->get('Customer\Service\CustomerBoardService');
        $em = $clientGeneralService->getEntityManager();
        $blobService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\BlobService");
        $clientGeneralService = $serviceLocator->getServiceLocator()->get('Customer\Service\ClientGeneralService');
        $formElementManager = $serviceLocator->getServicelocator()->get("FormElementManager");
        $claimService = $serviceLocator->getServiceLocator()->get("Claims\Service\ClaimsService");
        $claimPreForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Customer\Form\CustomerClaimsPreForm');

        $commentForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get("Comments\Form\CommentForm");

        $claimsForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Claims\Form\ClaimsForm');

        $dropZoneUploadForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("GeneralServicer\Form\DropZoneDocUploadForm");
        try {
            $claimsMotorForm = $formElementManager->get("Claims\Form\ClaimsMotorForm");
            $claimsCashInTransitForm = $formElementManager->get("Claims\Form\ClaimsCashInTransitForm");
            $claimsDefaultForm = $formElementManager->get("Claims\Form\ClaimsDefaultForm");
            $claimsGitForm = $formElementManager->get("Claims\Form\ClaimsGitForm");
            $claimsBurglaryForm = $formElementManager->get("Claims\Form\ClaimsBurglaryForm");
            $claimsContractorAllRiskForm = $formElementManager->get("Claims\Form\ClaimsContractorsAllRiskForm");
            $claimsProfessionalIndemnityForm = $formElementManager->get("Claims\Form\ClaimsProfessionalIndemnityForm");
            $claimsEmployerLiabilityForm = $formElementManager->get("Claims\Form\ClaimsEmployerLiabilityForm");
            $claimsFireLossForm = $formElementManager->get("Claims\Form\ClaimsFireLossForm");
           
            $claimsFidelityGuarateeForm = $formElementManager->get("Claims\Form\ClaimsFidelityGaurateeForm");
            $claimsMarineCargoForm = $formElementManager->get("Claims\Form\ClaimsMarineCargoForm");
        } catch (\Exception $e) {
            echo var_dump($e->getMessage());
        }
       
        $ctr->setEntityManager($em)
            ->setClaimsService($claimService)
            ->setCustomerClaimsSession($claimService->getCustomerClaimsSession())
            ->setClaimsForm($claimsForm)
            ->setCustomerBoardService($boardService)
            ->setDropZoneForm($dropZoneUploadForm)
            ->setBlobService($blobService)
            ->setClientrGeneralService($clientGeneralService)
            ->setCommentForm($commentForm)
            ->setRenderer($renderer);
           
        $ctr->setClaimsMotorForm($claimsMotorForm)
            ->setClaimsDefaultForm($claimsDefaultForm)
            ->setClaismCashInTransitForm($claimsCashInTransitForm)
            ->setClaimsGitForm($claimsGitForm)
            ->setClaimsBurglaryForm($claimsBurglaryForm)
            ->setClaimsContractorAllRiskForm($claimsContractorAllRiskForm)
            ->setClaimsMarineCargoForm($claimsMarineCargoForm)
            ->setClaimsEmployerLiabilityForm($claimsEmployerLiabilityForm)
            ->setClaimsFirelossForm($claimsFireLossForm)
            ->setClaimsProfessionalindemnityForm($claimsProfessionalIndemnityForm)
            ->setClaimsFidelityGuarateeForm($claimsFidelityGuarateeForm);
           
        return $ctr;
    }
}