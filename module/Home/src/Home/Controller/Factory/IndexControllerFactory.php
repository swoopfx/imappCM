<?php
namespace Home\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Home\Controller\IndexController;

/**
 *
 * @author swoopfx
 *        
 */
class IndexControllerFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new IndexController();
       

            $offerService = $serviceLocator->getServiceLocator()->get('Offer\Service\OfferService');
            // $firebase = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\FireBaseService");
            $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
            $renderer = $generalService->getViewRender();
            $em = $generalService->getEntityManager();
            // $uploadForm = $serviceLocator->getServiceLocator()->get('GeneralServicer\Form\GeneralUploadForm');
            // $regObjects = $serviceLocator->getServiceLocator()->get('object_service_main');
            $brokerProfileForm = $serviceLocator->getServiceLocator()
                ->get("FormElementManager")
                ->get("Home\Form\BrokerProfileForm");

            $logoForm = $serviceLocator->getServiceLocator()
                ->get("FormElementManager")
                ->get("GeneralServicer\Form\LogoUploadForm");
            $customerService = $serviceLocator->getServiceLocator()->get('Customer\Service\CustomerService');
            $proposalService = $serviceLocator->getServiceLocator()->get('Proposal\Service\ProposalService');
            $claimsService = $serviceLocator->getServiceLocator()->get('Claims\Service\ClaimsService');

            $invoiceService = $serviceLocator->getServiceLocator()->get('Transactions\Service\InvoiceService');

            $chatkitService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\PusherChatkitService');

            $homeService = $serviceLocator->getServiceLocator()->get('Home\Service\HomeService');
            $dateCal = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\DateCalculationService');
            $blobService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\BlobService");
            $policyService = $serviceLocator->getServiceLocator()->get("Policy\Service\PolicyService");
            $centralBrokerId = $generalService->getCentralBroker();
//             $mailService = $generalService->getMailService();
        
        $ctr->setCustomerService($customerService)
            ->setGeneralService($generalService)
            ->setEntityManager($em)
            ->setProposalService($proposalService)
            ->setClaimsService($claimsService)
            ->setInoiveService($invoiceService)
            ->setHomeService($homeService)
            ->setDateCalculationService($dateCal)
            ->setOfferService($offerService)
            ->setPolicyService($policyService)
//             ->setMailService($mailService)
            ->setCentralBrokerId($centralBrokerId)
            ->setBrokerProfileForm($brokerProfileForm)
            ->setLogoForm($logoForm)
            ->setChatkitService($chatkitService)
            ->setRenderer($renderer)
            ->setBlobService($blobService);
        return $ctr;
    }
}

