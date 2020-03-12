<?php
namespace Users\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Users\Service\BrokerSetupService;
use Transactions\Entity\Invoice;
use GeneralServicer\Entity\BrokerSubscription;
use Users\Entity\BrokerBankAccount;
use Transactions\Entity\InvoiceUser;
use Zend\Session\Container;

/**
 *
 * @author swoopfx
 *        
 */
class BrokerSetupFactory implements FactoryInterface
{

    private $auth;

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
        $serve = new BrokerSetupService();
        $userInvoiceEntity = new InvoiceUser();
        $invoiceEntity = new Invoice();
        $sub = new BrokerSubscription();
        $bankEntity = new BrokerBankAccount();
        $brokerSetupInvoice = new Container("setupInvoice");
        $brokerSetupInvoice->setExpirationSeconds(60 * 60 * 24);
        $smsService = $serviceLocator->get('SMS\Service\SMSService');
        
        $generalService = $serviceLocator->get('GeneralServicer\Service\GeneralService');
        $em = $generalService->getEntityManager();
        $auth = $generalService->getAuth();
        $invoiceService = $serviceLocator->get('Transactions\Service\InvoiceService');
        $setUpService = $serviceLocator->get('Users\Service\SetupService');
        $redirect = $serviceLocator->get('ControllerPluginManager')->get('redirect');
        $flashMessaenger = $serviceLocator->get('ControllerPluginManager')->get('flashMessenger');
        $urlPlugin = $generalService->getUrlPlugin();
        $urlViewHelper = $generalService->getUrlViewHelper();
        // $mailer = $serviceLocator->get("GeneralServicer\Service\MailService");
        $paymentService = $serviceLocator->get("Transactions\Service\PaymentService");
        $blobService = $serviceLocator->get("GeneralServicer\Service\BlobService");
        $mailService = $generalService->getMailService();
        // $mail = $generalService->getMailService();
        $userId = $generalService->getUserId();
        
        $serve->setUserId($userId)
            ->setEntityManager($em)
            ->setSetUpService($setUpService)
            ->setInvoiceService($invoiceService)
            ->setUserInvoiceEntity($userInvoiceEntity)
            ->setInvoiceEntity($invoiceEntity)
            ->setRedirect($redirect)
            ->setSubEntity($sub)
            ->setFlashMessenger($flashMessaenger)
            ->setSmsService($smsService)
            ->setBrokerSetupInvoiceSession($brokerSetupInvoice)
            ->setUrlPlugin($urlPlugin)
            ->setGeneralService($generalService)
            ->setMailService($mailService)
            ->setPaymentService($paymentService)
            ->setBlobService($blobService);
        return $serve;
    }
}

