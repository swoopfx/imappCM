<?php
namespace Customer\Service;

/**
 *
 * @author swoopfx
 *        
 */
class ClientGeneralService
{

    // TODO - Insert your code here
    private $entityManager;

    private $clientAuth;

    private $brokerId;

    // this is gotten from the session id
    private $clientSession;

    private $generalService;

    private $redirect;

    private $request;

    private $hiddenSession;

    private $userId;

    private $customerId;

    private $customerProposalSession;
    
    private $mailService ;

    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    
    /**
     * This function is used to send mails form any controller or service
     *
     * @param array $messagePointers
     * @param array $template
     */
    public function sendMails($messagePointers = array(), $template = array())
    {
        $mailService = $this->mailService;
        $message = $mailService->getMessage();
        $message->addTo($messagePointers['to'])
        ->setFrom("info@imapp.ng", $messagePointers['fromName'])
        ->setSubject($messagePointers['subject']);
        
        if($messagePointers["replyTo"] != NULL){
            $message->setReplyTo($messagePointers["replyTo"]);
        }
        
        if(count($messagePointers['addReplyTo']) != 0){
            $message->addReplyTo($messagePointers['addReplyTo']);
        }
        
        if(count($messagePointers['addCc']) != 0){
            $message->addCc($messagePointers['addCc']);
        }
        $mailService->setTemplate($template['template'], $template['var']);
        $mailService->send();
    }
    

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function getGeneralSession()
    {
        return $this->generalService->getGeneralSession();
    }

    public function getBrokerId()
    {
        if ($this->clientSession->brokerId != NULL) {
            return $this->clientSession->brokerId;
        }
    }
    
    public function getBrokerUid(){
        if($this->clientSession->brokerId != NULL){
            $em = $this->entityManager;
            $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->clientSession->brokerId);
            return $brokerEntity->getBrokerUid();
        }
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getBrokerName()
    {
        $em = $this->entityManager;
        
        // if($this->clientAuth->hasIdentity()){
        if ($this->clientSession->brokerId != NULL) {
            $data = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->clientSession->brokerId);
            
            return $data->getBrokerName();
            // }
        }
    }

    public function getBrokerLogo()
    {
        $em = $this->entityManager;
        if ($this->clientAuth->hasIdentity()) {
            if ($this->clientSession->brokerId != NULL) {
                $data = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->clientSession->brokerId);
                if ($data->getCompanyLogo() != NULL) {
                    return $data->getCompanyLogo()->getDocUrl();
                } else {
                    return $this->generalService->getUrl()->fromRoute("welcome", array(), array(
                        'force_canonical' => true
                    )) . "images/logow.png";
                }
            }
        }
    }
    
    public function getBrokerHeadrLogo(){
        $em = $this->entityManager;
        if ($this->clientAuth->hasIdentity()) {
            if ($this->clientSession->brokerId != NULL) {
                $data = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->clientSession->brokerId);
                if ($data->getCompanyLogo() != NULL) {
                    return $data->getCompanyLogo()->getDocUrl();
                } else {
                    $base =  $this->generalService->getBasePath();
                    return $base("images/logow.png");
                }
            }
        }
    }

    public function loginPageLogo($id)
    {
        $em = $this->entityManager;
        $data = $em->find("Users\Entity\InsuranceBrokerRegistered", $id);
        if ($data->getCompanyLogo() != NULL) {
            return $data->getCompanyLogo()->getDocUrl();
        } else {
            return $this->generalService->getUrl()->fromRoute("welcome", array(), array(
                'force_canonical' => true
            )) . "images/logow.png";
        }
    }

    public function getCustomerId()
    {
        $em = $this->entityManager;
        if ($this->clientAuth->hasIdentity()) {
            $data = $em->getRepository("Customer\Entity\Customer")->findOneBy(array(
                'user' => $this->userId
            ));
            return $data->getId();
        }
    }

    public function getClientAuth()
    {
        return $this->clientAuth;
    }

    public function getGeneralService()
    {
        return $this->generalService;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getReferer()
    {
        return $this->request->getHeader("referer");
    }

    public function getRedirect()
    {
        return $this->redirect;
    }

    public function getHiddenSession()
    {
        return $this->hiddenSession;
    }

    public function selectCustomer($phoneOrEmail)
    {
        $dql = "SELECT u FROM Customer\Entity\Customer u WHERE u.phone = '$phoneOrEmail' OR u.email = '$phoneOrEmail'";
        $query = $this->entityManager->createQuery($dql)->getResult(\Doctrine\ORM\Query::HYDRATE_OBJECT);
        return $query;
    }

    public function getClientSession()
    {
        return $this->clientSession;
    }

    public function getCustomerProposalSession()
    {
        return $this->customerProposalSession;
    }

    public function setClientSession($ses)
    {
        $this->clientSession = $ses;
        
        return $this;
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setBrokerId($id)
    {
        $this->brokerId = $id;
        return $this;
    }

    public function setClientAuth($auth)
    {
        $this->clientAuth = $auth;
        return $this;
    }

    public function setGeneralService($xserv)
    {
        $this->generalService = $xserv;
        return $this;
    }

    public function setRedirect($red)
    {
        $this->redirect = $red;
        return $this;
    }

    public function setRequest($req)
    {
        $this->request = $req;
        return $this;
    }

    public function setHiddenSession($set)
    {
        $this->hiddenSession = $set;
        return $this;
    }

    public function setCustomerId($id)
    {
        $this->customerId = $id;
        return $this;
    }

    public function setUserId($id)
    {
        $this->userId = $id;
        return $this;
    }

    public function setCustomerProposalSession($sess)
    {
        $this->customerProposalSession = $sess;
        return $this;
    }
    /**
     * @return object $mailService
     */
    public function getMailService()
    {
        return $this->mailService;
    }

    /**
     * @param object $mailService
     */
    public function setMailService($mailService)
    {
        $this->mailService = $mailService;
        return $this;
    }

}

