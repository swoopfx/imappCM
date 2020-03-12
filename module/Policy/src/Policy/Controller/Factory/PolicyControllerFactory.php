<?php
namespace Policy\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Policy\Controller\PolicyController;

/**
 *
 * @author otaba
 *        
 */
class PolicyControllerFactory implements FactoryInterface
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
        $ctr = new PolicyController();

        $generalService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\GeneralService");
        $policyService = $serviceLocator->getServiceLocator()->get('Policy\Service\PolicyService');
        $coverNoteService = $serviceLocator->getServiceLocator()->get("Policy\Service\CoverNoteService");
        $smsService = $serviceLocator->getServicelocator()->get("SMS\Service\SMSService");
        $customerService = $serviceLocator->getServiceLocator()->get('Customer\Service\CustomerService');
        $brokerCustomerSession = $customerService->getBrokerCustomerSession();
        $blobService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\BlobService");
        $renderer = $generalService->getViewRender();

        $policyRevokeForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("Policy\Form\PolicyRevokeForm");

        $policySpecialTermsForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("Policy\Form\PolicySpecialTermsForm");

        $policyGenerationForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("Policy\Form\PolicyForm");

        $renewPolicyForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Policy\Form\RenewPolicyForm');

        $policyStatusForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Policy\Form\PolicyStatusForm');

        $policyPremiumPayableForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Policy\Form\PolicyPremiumPayableForm');

        // $uploadPolicyForm = $serviceLocator->getServiceLocator()
        // ->get("FormElementManager")
        // ->get("Policy\Form\UploadPolicyForm");

        $policyFloatForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("Policy\Form\PolicyFloatForm");

        $dropZoneUploadForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("GeneralServicer\Form\DropZoneDocUploadForm");

        // $mailService = $generalService->getMailService();
        $em = $generalService->getEntityManager();
        $centralBrokerId = $generalService->getCentralBroker();
        $ctr->setEntityManager($em)
            ->setPolicyService($policyService)
            ->
        // ->setMailService($mailService)
        setPolicyForm($policyGenerationForm)
            ->setCentralBrokerId($centralBrokerId)
            ->setCoverNoteService($coverNoteService)
            ->setPolicyGenerationForm($policyGenerationForm)
            ->setSmsService($smsService)
            ->setGeneralService($generalService)
            ->setBrokerCustomerSession($brokerCustomerSession)
            ->setPolicyPremiumPayableForm($policyPremiumPayableForm)
            ->setRenewPolicyForm($renewPolicyForm)
            ->setRenderer($renderer)
            ->setPolicyFloatForm($policyFloatForm)
            ->setPolicyStatusForm($policyStatusForm)
            ->setDropZoneForm($dropZoneUploadForm)
            ->setPolicySpecialTerms($policySpecialTermsForm)
            ->setPolicyRevokeForm($policyRevokeForm)
            ->setBlobService($blobService);
        return $ctr;
    }
}

