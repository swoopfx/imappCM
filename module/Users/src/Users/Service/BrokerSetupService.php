<?php
namespace Users\Service;

use Transactions\Service\InvoiceService;
use CsnUser\Service\RoleService;
use SMS\Service\SMSService;
use SMS\Entity\SMSAccount;

/**
 *
 * @author swoopfx
 *        
 */
class BrokerSetupService
{

    private $entityManager;

    private $userId;

    private $user;

    private $setupService;

    private $months;

    private $finalMths;

    private $package;

    private $startDate;

    private $endDate;

    private $subPrice;

    private $invoiceService;

    private $invoiceEntity;

    private $userInvoiceEntity;

    private $redirect;

    private $setupSub;

    private $bankEntity;

    private $mailService;

    private $smsService;

    private $flashMessenger;

    private $url;

    private $urlViewHelper;

    private $brokerSetupInvoiceSession;

    private $generalService;

    private $blobService;

    // private $mailer;
    private $paymentService;

    const PAID = 1;

    const UNPAID = 2;

    const BROKER_PACKAGE_FREMIUM = 1;

    const BROKER_PACKAGE_PREMIUM = 2;

    public function __construct()
    {}

    public function hydrateBrokerSetup($dataEntity)
    {
        $em = $this->entityManager;
        $invoiceService = $this->invoiceService;
        $userInvoiceEntity = $this->userInvoiceEntity;
        $invoiceEntity = $this->invoiceEntity;
        $brokerSession = $this->brokerSetupInvoiceSession;
        $flash = $this->flashMessenger;
        
        /**
         * strip phone number of the -
         */
        
        $dataEntity->setUser($em->find('CsnUser\Entity\User', $this->userId));
        $dataEntity->setDateEntered(new \DateTime());
        $dataEntity->setBrokerUid($this->generateBrokerUid());
        $dataEntity->setActivationCode($this->generateActivationCode());
        $phone = $string = str_replace("-", "", $dataEntity->getOfficialPhone());
        $dataEntity->setOfficialPhone($phone);
        
        $broker = $em->find('Settings\Entity\InsuranceBrokerAvailable', $dataEntity->getIdInduranceBoker());
        $brokerName = $broker->getCompanyName();
        
        $this->setMonths(1);
        $this->setPackage($dataEntity->getSubscription()
            ->getPackage());
        
        $this->setPackageService();
        
        $invoiceService->setAmount($this->subPrice);
        $dataEntity->getSubscription()->setPackage($em->find('Settings\Entity\Packages', $dataEntity->getSubscription()
            ->getPackage()));
        $dataEntity->getSubscription()->setMonths($this->finalMths);
        $dataEntity->getSubscription()->setStartDate($this->startDate);
        $dataEntity->getSubscription()->setEndDate($this->endDate);
        $dataEntity->getSubscription()->setCreatedOn(new \DateTime('NOW'));
        $dataEntity->getSubscription()->setBroker($dataEntity);
        $dataEntity->getSubscription()->setIsValid(false);
        $dataEntity->getSubscription()->setInvoice($invoiceEntity);
        // End Subscription
        
        // Begin Invoice Setters
        $userInvoiceEntity->setUser($em->find('CsnUser\Entity\User', $this->userId));
        $userInvoiceEntity->setInvoice($invoiceEntity);
        $invoiceEntity->setGeneratedOn(new \DateTime('NOW'));
        // $invoiceEntity->setUserId($em->find('CsnUser\Entity\User', $this->userId));
        $invoiceEntity->setAmount($this->subPrice);
        $invoiceEntity->setStatus($em->find('Transactions\Entity\InvoiceStatus', InvoiceService::INVOICE_UNPAID_STATUS)); // Paid and Unpaid // set it as unpaid
        $invoiceEntity->setInvoiceCategory($em->find('Transactions\Entity\InvoiceCategory', InvoiceService::INVOICE_CAT_BROKER_SUB)); // This is Broker SetUp Invoice
        $invoiceEntity->setCurrency($em->find('Settings\Entity\Currency', InvoiceService::NIGERIA_NAIRA_CURRENCY)); // tis is set to Naira
        $invoiceEntity->setTransaction(NULL);
        $invoiceEntity->setInvoiceUid($invoiceService->generateInvoiceNumber());
        $invoiceEntity->setExpiryDate(new \DateTime());
        $invoiceEntity->setIsOpen(TRUE);
        
        // End Invoice Setters
        
        // BeginUser Update
        $dataEntity->getUser()
            ->setProfiled(true)
            ->setRole($em->find('CsnUser\Entity\Role', RoleService::BROKER_SETUP));
        
        try {
            
            // create SMS account
            $smsAccount = new SMSAccount();
            $smsAccount->setAlias("IMAPP CM")
                ->setCreatedOn(new \DateTime())
                ->setAvailableCredit(300)
                ->setBroker($dataEntity);
            
            $em->persist($invoiceEntity);
            $em->persist($userInvoiceEntity);
            $em->persist($dataEntity);
            
            // echo $this->finalMths;
            
            $em->flush();
            
            $brokerSession->invoiceId = $invoiceEntity->getId();
            
            return TRUE;
        } catch (\Exception $e) {
            
            $this->flashMessenger->addErrorMessage("There was a problem creating your account");
            $this->redirect->toRoute("user_broker", array(
                "action" => "setup"
            ));
        }
    }

    public function configMail($to)
    {
       /**
        * todo this mail must also include training mategrilas
        * Generate training materials and inlcude it in 
        *
        */ 
        $varArray = array(
            "logo" => $this->urlViewHelper('user-index', array(), array(
                'force_canonical' => true
            )) . "images/logow.png",
            "brokerLogin" => $this->urlViewHelper('user-index', array(), array(
                'force_canonical' => true
            )),
            "customerLogin" => $this->urlViewHelper("client_login", array(
                "brokerid" => $this->generalService->getBrokerCentralUid()
            ), array(
                'force_canonical' => true
            )),
            "customerRegister" => $this->urlViewHelper("client_register", array(
                "brokerid" => $this->generalService->getBrokerCentralUid()
            ), array(
                'force_canonical' => true
            ))
        );
        
        $mailService = $this->mailService;
        $mailService->getMessage()
            ->addTo($to)
            ->setFrom("info@imapp.ng", "IMAPP CM");
        $mailService->setTemplate("general-broker-config-email", $varArray)->setSubject("IMAPP CM : Welcome Aboard");
        $mailService->send();
    }

    public function hydrateBrokerFreeSetup($dataEntity)
    {
        $em = $this->entityManager;
        $mailService = $this->mailService;
        $dataEntity->setUser($em->find('CsnUser\Entity\User', $this->userId));
        $dataEntity->setDateEntered(new \DateTime());
        $dataEntity->setBrokerUid($this->generateBrokerUid());
        $dataEntity->setActivationCode($this->generateActivationCode());
        $phone = $string = str_replace("-", "", $dataEntity->getOfficialPhone());
        $dataEntity->setOfficialPhone($phone);
        
        $broker = $em->find('Settings\Entity\InsuranceBrokerAvailable', $dataEntity->getIdInduranceBoker());
        $brokerName = $broker->getCompanyName();
        
        $this->setMonths(30);
        $this->setPackage( BrokerSetupService::BROKER_PACKAGE_FREMIUM);
        
        $this->setPackageService();
        
        // $invoiceService->setAmount($this->subPrice);
        $dataEntity->getSubscription()->setPackage($em->find('Settings\Entity\Packages', $dataEntity->getSubscription()
            ->getPackage()));
        $dataEntity->getSubscription()->setMonths($this->finalMths);
        $dataEntity->getSubscription()->setStartDate($this->startDate);
        $dataEntity->getSubscription()->setEndDate($this->endDate);
        $dataEntity->getSubscription()->setCreatedOn(new \DateTime('NOW'));
        $dataEntity->getSubscription()->setBroker($dataEntity);
        $dataEntity->getSubscription()->setIsValid(TRUE);
        // $dataEntity->getSubscription()->setInvoice($invoiceEntity);
        
        $dataEntity->getUser()
            ->setProfiled(true)
            ->setRole($em->find('CsnUser\Entity\Role', RoleService::BROKER));
        
        $smsAccount = new SMSAccount();
        $smsAccount->setAlias("IMAPP CM")
            ->setCreatedOn(new \DateTime())
            ->setAvailableCredit(100)
            ->setBroker($dataEntity);
        
        try {
            // Send mail
            // $this->configMail($dataEntity->getUser()
            // ->getEmail());
            
            $em->persist($smsAccount);
            $em->persist($dataEntity);
            $em->flush();
            
            $message = "Welcome aboard IMAPP CM, Please check your email for configuration details into your website";
           
            
//             $this->smsService->sendGeneralSms($dataEntity->getUser()
//                 ->getUsername(), "IMAPP CM", $message);
            
            $this->blobService->createContainer($dataEntity->getBrokerUid());
            
            return TRUE;
        } catch (\Exception $e) {
            $this->flashMessenger->addErrorMessage("There was a problem creating your account");
            $this->redirect->toRoute("user_broker", array(
                "action" => "setup"
            ));
        }
    }

    public function setPackageService()
    {
        // this is used to setup the hydration date
        // concentration should be kept on the end date
        // call setup service
        $setupService = $this->setupService;
        $res = $setupService->calculateService($this->months, $this->package);
        
        $this->startDate = $res['startDate'];
        $this->endDate = $res['endDate'];
        $vat = ($res['price'] * 5) / 100;
        $this->subPrice = $res['price'] + $vat;
        $this->finalMths = $res['mths'];
    }

    public function setMonths($mts)
    {
        $this->months = $mts;
        return $this;
    }

    public function generateBrokerUid()
    {
        $const = "brk";
        $code = \uniqid($const);
        return $code . $this->userId;
    }

    public function generateActivationCode()
    {
        $const = 'act';
        $code = \uniqid($const);
        return $code;
    }

    /**
     * This checks if the rba code and company name actually match each other
     *
     * @param string $data            
     */
    public function rbaConfirmation($data)
    {
        $em = $this->entityManager;
        $broker = $em->find('Settings\Entity\InsuranceBrokerAvailable', $data['idInduranceBoker']);
        $rbNumber = $broker->getRbNumber();
        if ($rbNumber == $data['rbaCode']) {
            return true; // the verification is valid
        } else {
            return false; // verification is not valid
        }
    }

    public function getBrokerSetupInvoiceSession()
    {
        return $this->brokerSetupInvoiceSession;
    }

    // Begin Setters
    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setUserId($id)
    {
        $this->userId = $id;
        return $this;
    }

    public function setSetUpService($service)
    {
        $this->setupService = $service;
        
        return $this;
    }

    public function setInvoiceService($service)
    {
        $this->invoiceService = $service;
        
        return $this;
    }

    public function setPackage($package)
    {
        $this->package = $package;
        
        return $this;
    }

    public function setInvoiceEntity($entity)
    {
        $this->invoiceEntity = $entity;
        
        return $this;
    }

    public function setRedirect($red)
    {
        $this->redirect = $red;
        
        return $this;
    }

    public function setSubEntity($sub)
    {
        $this->setupSub = $sub;
        return $this;
    }

    public function setBankEntity($banK)
    {
        $this->bankEntity = $banK;
        return $this;
    }

    public function setMailService($mail)
    {
        $this->mailService = $mail;
        return $this;
    }

    public function setFlashMessenger($flash)
    {
        $this->flashMessenger = $flash;
        return $this;
    }

    public function setUserInvoiceEntity($en)
    {
        $this->userInvoiceEntity = $en;
        return $this;
    }

    public function setSmsService($serv)
    {
        $this->smsService = $serv;
        return $this;
    }

    public function setBrokerSetupInvoiceSession($xserv)
    {
        $this->brokerSetupInvoiceSession = $xserv;
        return $this;
    }

    public function setUrlPlugin($plugin)
    {
        $this->url = $plugin;
        return $this;
    }

    public function setGeneralService($xserve)
    {
        $this->generalService = $xserve;
        return $this;
    }

    public function setUrlViewHelper($helper)
    {
        $this->urlViewHelper = $helper;
        return $this;
    }

    public function setPaymentService($xserv)
    {
        $this->paymentService = $xserv;
        return $this;
    }

    public function setBlobService($xserv)
    {
        $this->blobService = $xserv;
        return $this;
    }
    
    // End setters
}

