<?php
namespace GeneralServicer\Service;

use CsnUser\Service\UserService;
use MicrosoftAzure\Storage\Common\Internal\Resources;
use Zend\Http\PhpEnvironment\RemoteAddress;
use Policy\Service\CoverNoteService;
use Zend\Mail\Message;
use Users\Entity\InsuranceBrokerRegistered;

/**
 *
 * @author swoopfx
 *        
 */
class GeneralService
{

    private $entityManager;

    private $userId;

    private $brokerId;

    private $childBrokerId;

    private $childBroker;

    private $motherBrokerId;

    private $auth;
    
    private $authorization;

    private $userRole;

    private $mailService;

    private $url;

    private $urlViewHelper;

    private $flashMessenger;

    private $redirect;

    private $basePath;

    private $viewRender;

    private $mailer;

    private $request;

    private $uploadForm;

    private $generalSession;

    private $pdfModelService;
    
    

    // this handles specific and general unprecedented session
    const GENERAL_EMPTY_FIELD = "<p style=' color: red;'>Not specified</p>";

    const APP_NAME = "IMAPP CM";

    const APP_COMPANY_NAME = "I-Manager Solutions";

    const ADMINSTRATOR_BROKER = 1;

    const ADMINISTRATOR_AGENT = 2;

    const LANGUAGE_ENGLISH = 1;

    const IMAPP_MAILER_DISCLAIMER = "Diasclaimer ";

    const IMAPP_TECH_EMAIL = 'info@imapp.ng';

    const INSURANCE_SERVICE_MOTOR = 1;

    const INSURANCE_SERVICE_LIFE = 2;

    const INSURANCE_SERVICE_AVIATION = 40;

    const INSURANCE_SERVICE_AGRIC = 4;

    const INSURANCE_SERVICE_GENERAL_BUSINESS = 5;

    const INSURANCE_SERVICE_HEALTH = 7;

    const INSURANCE_SERVICE_OIL_AND_ENERGY = 9;

    const INSURANCE_SERVICE_LIFE_INDIVIDUAL = 20;

    const INSURANCE_SERVICE_LIFE_GROUP = 30;

    const INSURANCE_SERVICE_BOND = 45;

    const INSURANCE_SERVICE_BUILDERS_LIABILITY = 49;

    const INSURANCE_SERVICE_BUGLARY_AND_HOUSE = 53;

    const INSURANCE_SERVICE_CASH_IN_TRANSIT = 57;

    const INSURANCE_SERVICE_CONSEQUENTIAL_LOSS = 59;

    const INSURANCE_SERVICE_CONTRACT_ALL_RISK = 61;

    const INSURANCE_SERVICE_ELECTRONI_EQUIPEMENT = 64;

    const INSURANCE_SERVICE_EMPLOYERS_LIABILITY = 67;

    const INSURANCE_SERVICE_ERECTION_ALL_RISK = 70;

    const INSURANCE_SERVICE_FIDELITY_GUARATEE = 71;

    const INSURANCE_SERVICE_FIRE_AND_BUGLARY = 73;

    const INSURANCE_SERVICE_FIRE_AND_SPECIAL_PERIL = 75;

    const INSURANCE_SERVICE_GOODS_IN_TRANSIT = 77;

    const INSURANCE_SERVICE_HOME = 79;

    const INSURANCE_SERVICE_MACHINERY_BREAKDOWN = 81;

    const INSURANCE_SERVICE_MACHINERY_LOSS_OF_PROFIT = 83;

    const INSURANCE_SERVICE_MARINE_CARGO = 85;

    const INSURANCE_SERVICE_MARINE_HULL = 87;

    const INSURANCE_SERVICE_OCCUPEIRS_LIABILITY = 89;

    const INSURANCE_SERVICE_PERSONAL_ACCIDENT = 90;

    const INSURANCE_SERVICE_PLANT_ALL_RISK = 92;

    const INSURANCE_SERVICE_PROFESSIONAL_INDEMNITY = 94;

    const INSURANCE_SERVICE_PUBLIC_LIABILITY = 97;

    const INSURANCE_SERVICE_TRAVEL = 101;

    const INSURANCE_SERVICE_CUSTOM_SERVICE = 500;

    const GENERAL_BLOB_CONNECTION_STRING = "UseDevelopmentStorage=true";

    const GENERAL_BLOB_LIVE_CONNECTION_STRING = "DefaultEndpointsProtocol=https;AccountName=imapp1diag388;AccountKey=uS2fxyYsdHHJsuzolG7RPVS3GgEV3qK8cdLjdNReKiz5PdbgEmzihCJJm76phDwWgTiRHmle3reaQa4xgIUTEA==;EndpointSuffix=core.windows.net";

    const GENERAL_LIVE_AZURE_BLOB_URL = "";

    const GENERAL_DEMO_AZURE_BLOB_URI = "http://" . Resources::EMULATOR_BLOB_URI;

    const GENERAL_DEMO_AZURE_DEV_STORE_NAME = Resources::DEV_STORE_NAME;

    const GENERAL_DEMO_AZURE_BLOB_FULL_URL = GeneralService::GENERAL_DEMO_AZURE_BLOB_URI . "/" . GeneralService::GENERAL_DEMO_AZURE_DEV_STORE_NAME;

    // const INSURANCE_SERVICE_MARINE = 7;

    // const INSRUANCE_SERVICE_OIL_ENERGY = 8;

    // const INSRUANCE_SERVICE_TRAVEL = 9;

    // const INSURANCE_SERVICE_OTHERS = 100;
    const CM_LOGO = GeneralService::CM_URL."images/cm.png";
    
    const CM_LOCAL_LOGO = "http://localhost:1011/images/cm.png";

    const CM_URL = "https://cm.imapp.ng/";

    const CM_PRODUCT_NAME = "IMAPP CM";
    
    const CM_BILLING_EMAIL = "info@imapp.ng";

    const COMPANY_NAME = "I-MANAGER SOLUTIONS";

    const COMPANY_ADDRESS = "BLK C5 SUITE 6 OLUGBEDE MARKET LAGOS";

    /**
     *
     * @param object $coverNoteEntity
     * @return array|string
     */
    public function getServiceTypeId($coverNoteEntity)
    {
        if ($coverNoteEntity != NULL) {
            if ($coverNoteEntity->getFinalService() != NULL) {
                return $coverNoteEntity->getFinalService()->getId();
            } else {
                if ($coverNoteEntity->getCoverCategory()->getId() == CoverNoteService::COVERNOTE_CATEGORY_PROPOSAL) {
                    $proposalEntity = $coverNoteEntity->getProposal();
                    return $proposalEntity->getServiceType()->getId();
                } elseif ($coverNoteEntity->getCoverCategory()->getId() == CoverNoteService::COVERNOTE_CATEGORY_OFFER) {
                    $offerEntity = $coverNoteEntity->getOffer();
                    return $offerEntity->getOfferServiceType()->getId();
                } elseif ($coverNoteEntity->getCoverCategory()->getId() == CoverNoteService::COVERNOTE_CATEGORY_FLOAT_POLICY) {
                    $floatPolicyEntity = $coverNoteEntity->getPolicyFloat();
                    return $floatPolicyEntity->getServiceType()->getId();
                }
            }
        } else {
            throw new \Exception("Missing covernote entity");
        }
    }

    public function getSpecificServiceTypeId($coverNoteEntity)
    {
        if ($coverNoteEntity != NULL) {
            if ($coverNoteEntity->getFinalSpecificService() != NULL) {
                $coverNoteEntity->getFinalSpecificService()->getId();
            } else {
                if ($coverNoteEntity->getCoverCategory()->getId() == CoverNoteService::COVERNOTE_CATEGORY_PROPOSAL) {
                    $proposalEntity = $coverNoteEntity->getProposal();
                    return $proposalEntity->getSpecificService()->getId();
                } elseif ($coverNoteEntity->getCoverCategory()->getId() == CoverNoteService::COVERNOTE_CATEGORY_OFFER) {
                    $offerEntity = $coverNoteEntity->getOffer();
                    return $offerEntity->getOfferSpecificService()->getId();
                } elseif ($coverNoteEntity->getCoverCategory()->getId() == CoverNoteService::COVERNOTE_CATEGORY_FLOAT_POLICY) {
                    $floatPolicyEntity = $coverNoteEntity->getPolicyFloat();
                    return $floatPolicyEntity->getSpecificService()->getId();
                }
            }
        } else {
            throw new \Exception("Missing covernote Entity");
        }
    }

    /**
     * This function sends a mail
     * Old version
     *
     * @param string $toEmail
     * @param string $sender
     * @param string $subject
     * @param array $templateInfo
     */
    public function sendEmail($toEmail, $sender = "IMAPP CM", $subject = "", $templateInfo = array())
    {
        $mailService = $this->mailService;
        $message = $mailService->getMessage();
        $message->addTo($toEmail)
            ->setFrom("info@imapp.ng", $sender)
            ->setSubject($subject);
        $mailService->setTemplate($templateInfo['template'], $templateInfo['var']);
        $mailService->send();
    }

    /**
     * This function is used to send mails form any controller or service
     * If there is going to be a complex AddCC or addBcc Request,It should be done in the controller
     *
     * @param array $messagePointers
     * @param array $template
     */
    public function sendMails($messagePointers = array(), $template = array(), $replyTo = "", $addCc = "", $addBcc = "")
    {
        $mailService = $this->mailService;
        // $der = new Message();
        $message = $mailService->getMessage();
        $message->addTo($messagePointers['to'])
            ->setFrom("info@imapp.ng", ($messagePointers['fromName'] == NULL ? GeneralService::CM_PRODUCT_NAME : $messagePointers["fromName"]))
            ->setSubject($messagePointers['subject']);

        if ($replyTo != "") {
            $message->setReplyTo($replyTo);
        }

        if ($addCc != "") {
            $message->addCc($addCc);
        }

        if ($addBcc != "") {
            $message->addBcc($addBcc);
        }

        $mailService->setTemplate($template['template'], $template['var']);
        // $mailService->send();
    }

//     public static function sendmailsStatic(){
        
//     }
    

    /**
     *
     * @return string This returns the url string of the imapp png logo
     */
    public function getImappLogo()
    {
        $urlviewHelper = $this->urlViewHelper;
        return $urlviewHelper("welcome", array(), array(
            'force_canonical' => true
        )) . "images/logow.png";
    }

    public static function getClientIp()
    {
        $remoteAdd = new RemoteAddress();
        return $remoteAdd->getIpAddress();
    }

    /**
     * generates UID for insurer portal entity
     *
     * @return string
     */
    public static function portalUid()
    {
        $const = "port";
        // $id = $this->userId;
        $code = \uniqid($const);
        return $code;
    }

    public function getCmLogo()
    {
        return GeneralService::CM_LOGO;
    }

    public function imprintLogo()
    {
        $basePath = $this->basePath;
        if ($this->getCentralBroker() == NULL) {
            // / return Imapp logo
            $logo = $basePath('images/img.jpg'); // $this->basePath('images/img.jpg');
        } else {
            return $this->getBrokerLogo();
        }
    }
    
    /**
     * 
     * @param InsuranceBrokerRegistered $brokerEntity
     * @return string
     */
    public static function getBrokerogoStatic($brokerEntity){
        if ($brokerEntity->getCompanyLogo() != NULL) {
            return $brokerEntity->getCompanyLogo()->getDocUrl();
        } else {
            return ($_SERVER["APPLICATION_ENV"] == "development" ? GeneralService::CM_LOCAL_LOGO : GeneralService::CM_LOGO);
        }
    }

    public function getBrokerLogo()
    {
        $em = $this->entityManager;
        $centralBrokerId = $this->getCentralBroker();
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $centralBrokerId);
        if ($brokerEntity->getCompanyLogo() != NULL) {
            return $brokerEntity->getCompanyLogo()->getDocUrl();
        } else {
            $basePath = $this->basePath;
            return $basePath('images/logow.png'); // change this
        }
    }

    /**
     * references the absolute logo 
     * Should be used when sending mails ie when action takes place outside the app
     * 
     * @return mixed|string
     */
    public function getBrokerAbsoluteLogo()
    {
        $em = $this->entityManager;
        $urlViewHelper = $this->urlViewHelper;
        $centralBrokerId = $this->getCentralBroker();
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $centralBrokerId);
        if ($brokerEntity->getCompanyLogo() != NULL) {
            return $brokerEntity->getCompanyLogo()->getDocUrl();
        } else {

            return $urlViewHelper('welcome', array(), array(
                'force_canonical' => true
            )) . "images/logow.png";
        }
    }

    public function getBroker()
    {
        $em = $this->entityManager;

        if ($this->brokerId != NULL) {
            $broker = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->brokerId);
            return $broker;
        }
    }

    public function getSubscription()
    {
        $userRole = $this->userRole;
        switch ($userRole) {
            case UserService::USER_ROLE_BROKER:
            case UserService::USER_ROLE_SETUP_BROKER:
                return $this->getBrokerSubscription();
                break;

            case UserService::USER_ROLE_BROKER_CHILD:
                return $this->getMotherBrokerSubscription();
                break;
        }
    }

    public function UseCaseConditionFunction($brokerFunction, $brokerChildFunction)
    {
        $userRole = $this->userRole;
        switch ($userRole) {
            case UserService::USER_ROLE_BROKER:
                return $brokerFunction;
                break;
            case UserService::USER_ROLE_BROKER_CHILD:
                return $brokerChildFunction;
                break;
        }
    }

    public function getBrokerSubscription()
    {
        $em = $this->entityManager;
        $brokerId = $this->brokerId;
        $criteria = array(
            'broker' => $brokerId
        );
        if ($this->brokerId != NULL) {
            $info = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->brokerId);
            //
            return $info->getSubscription();
        }
    }

    public function getCentralUid()
    {
        // var_dump($this->getMotherBrokerCentralUid());
        if ($this->userRole == UserService::USER_ROLE_BROKER) {
            return $this->getBrokerCentralUid();
        } else {
            $this->getMotherBrokerCentralUid();
        }
    }

    /**
     * This returns the id of the mother broker
     * Iresspective of the user role Broker or Child Broker
     *
     * @return string
     */
    public function getCentralBroker()
    {
        return $this->UseCaseConditionFunction($this->getBrokerId(), $this->getMotherBrokerId());
    }

    public function getBrokerChildId()
    {
        $em = $this->entityManager;
        if ($this->userRole == UserService::USER_ROLE_BROKER_CHILD) {
            $userEntity = $em->find("CsnUser\Entity\User", $this->userId);
            return $userEntity->getBrokerChild()->getId();
        }
    }

    public function getUrlPlugin()
    {
        return $this->url;
    }

    public function getUrlViewHelper()
    {
        return $this->urlViewHelper;
    }

    private function getMotherBrokerSubscription()
    {
        $em = $this->entityManager;
        $brokerId = $this->motherBrokerId;
        $criteria = array(
            'broker' => $brokerId
        );
        $data = $em->getRepository('GeneralServicer\Entity\BrokerSubscription')->findOneBy($criteria);
        return $data;
    }

    private function getBrokerCentralUid()
    {
        if ($this->userRole == UserService::USER_ROLE_BROKER) {
            $em = $this->entityManager;
            $data = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->brokerId);
            return $data->getBrokerUid();
        }
    }

    private function getMotherBrokerCentralUid()
    {
        if ($this->userRole == UserService::USER_ROLE_BROKER_CHILD) {
            $em = $this->entityManager;
            $data = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->motherBrokerId);
            return $data->getBrokerUid();
        }
    }

    public function getBrokerId()
    {
        return $this->brokerId;
    }

    public function getChildBrokerId()
    {
        return $this->childBrokerId;
    }

    public function getChildBroker()
    {
        return $this->childBroker;
    }

    public function getMotherBrokerId()
    {
        return $this->motherBrokerId;
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * This gets the id of the user logged in 
     * @return unknown
     */
    public function getUserId()
    {
        return $this->userId;
    }

    public function getAuth()
    {
        return $this->auth;
    }

    public function getMailService()
    {
        return $this->mailService;
    }

    public function getViewRender()
    {
        return $this->viewRender;
    }

    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * returns the role of a logged in User
     */
    public function getUserRoleId()
    {
        return $this->userRole;
    }

    public function getFlashMessenger()
    {
        return $this->flashMessenger;
    }

    public function getRedirect()
    {
        return $this->redirect;
    }

    public function getGeneralSession()
    {
        return $this->generalSession;
    }

    public function getUploadForm()
    {
        return $this->uploadForm;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getPdfModelService()
    {
        return $this->pdfModelService;
    }
    
    
    public function getAuthorization(){
        return $this->authorization;
    }
    

    // End Getters
    public function setEntityManager($entity)
    {
        $this->entityManager = $entity;
        return $this;
    }

    public function setBrokerId($id)
    {
        $this->brokerId = $id;
        return $this;
    }

    public function setChildBrokerId($id)
    {
        $this->childBrokerId = $id;
        return $this;
    }

    public function setChildBroker($xser)
    {
        $this->childBroker = $xser;
        return $this;
    }

    public function setUserId($id)
    {
        $this->userId = $id;
        return $this;
    }

    public function setAuth($auth)
    {
        $this->auth = $auth;
        return $this;
    }

    public function setMotherBroker($id)
    {
        $this->motherBrokerId = $id;
        return $this;
    }

    public function setUserRoleId($id)
    {
        $this->userRole = $id;
        return $this;
    }

    public function setMailService($mailService)
    {
        $this->mailService = $mailService;
        return $this;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function setFlashMessenger($xserv)
    {
        $this->flashMessenger = $xserv;
        return $this;
    }

    public function setRedirtect($red)
    {
        $this->redirect = $red;
        return $this;
    }

    public function setViewRender($xserv)
    {
        $this->viewRender = $xserv;

        return $this;
    }

    public function setRequest($rq)
    {
        $this->request = $rq;
        return $this;
    }

    public function setUrlViewHelper($xserv)
    {
        $this->urlViewHelper = $xserv;
        return $this;
    }

    public function setGeneralSession($sess)
    {
        $this->generalSession = $sess;
        return $this;
    }

    public function setUploadForm($form)
    {
        $this->uploadForm = $form;
        return $this;
    }

    public function setBasePath($path)
    {
        $this->basePath = $path;
        return $this;
    }

    public function setPdfModelService($xserv)
    {
        $this->pdfModelService = $xserv;
        return $this;
    }
    
    
    public function setAuthorization($auth){
        $this->authorization = $auth;
        
        return $this;
        
    }
    // End Setters
}

