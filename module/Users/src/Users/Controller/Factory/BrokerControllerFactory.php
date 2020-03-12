<?php
namespace Users\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Users\Controller\BrokerController;
use Users\Entity\InsuranceBrokerRegistered;

/**
 *
 * @author swoopfx
 *        
 */
class BrokerControllerFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new BrokerController();
        $renderer = $serviceLocator->getServiceLocator()->get("ViewRenderer");
        $dataEntity = new InsuranceBrokerRegistered();
        $generalService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\GeneralService');
        $blobService = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\BlobService");
        $em = $generalService->getEntityManager();
        $brokerSetupService = $serviceLocator->getServiceLocator()->get('Users\Service\BrokerSetupService');
        $invoiceService = $serviceLocator->getServiceLocator()->get('Transactions\Service\InvoiceService');
        $transactionService = $serviceLocator->getServiceLocator()->get('Transactions\Service\TransactionService');
        $centralBroekrId = $generalService->getCentralBroker();
        $setUpInfoForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Users\Form\BrokerSetupInfoForm');

        $mailService = $generalService->getMailService();
        $setUpDataForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Users\Form\BrokerSetUpDataForm');

        $uploadForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Users\Form\BrokerLogoUploadForm');
        
            $dropZoneUploadForm = $serviceLocator->getServiceLocator()
            ->get("FormElementManager")
            ->get("GeneralServicer\Form\DropZoneDocUploadForm");

        $paymentForm = $serviceLocator->getServiceLocator()
            ->get('FormElementManager')
            ->get('Transactions\Form\UserCardPaymentForm');

        // $mailer = $serviceLocator->getServiceLocator()->get("GeneralServicer\Service\MailService");
        $smsService = $serviceLocator->getServiceLocator()->get("SMS\Service\SMSService");
        $paymentService = $serviceLocator->getServiceLocator()->get("Transactions\Service\PaymentService");

        $brokerGeneralService = $serviceLocator->getServiceLocator()->get('Users\Service\BrokerGeneralService');
        $brokerSubService = $serviceLocator->getServiceLocator()->get('GeneralServicer\Service\BrokerSubscriptionService');

        $ctr->setEntityManager($em)
            ->setSetUpInfoForm($setUpInfoForm)
            ->setSetUpDataForm($setUpDataForm)
            ->setGeneralService($generalService)
            ->setDataEntity($dataEntity)
            ->setBrokerSetupService($brokerSetupService)
            ->setBrokerGeneralService($brokerGeneralService)
            ->setInvoiceService($invoiceService)
            ->setTransactService($transactionService)
            ->setPaymentForm($paymentForm)
            ->setBrokerSubService($brokerSubService)
            ->setUploadForm($uploadForm)
            ->setPaymentService($paymentService)
            ->setMailService($mailService)
            ->setRenderer($renderer)
            ->setSmsService($smsService)
            ->setCentralBrokerId($centralBroekrId)
            ->setDropzoneForm($dropZoneUploadForm)
            ->setBlobService($blobService);

        return $ctr;
    }
}

?>