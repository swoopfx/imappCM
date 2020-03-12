<?php
namespace Proposal\Service;

use Proposal\Entity\Proposal;
use CsnUser\Service\UserService;
use GeneralServicer\Service\GeneralService;
use Zend\Session\Container;

/**
 *
 * @author swoopfx
 *        
 */
class ProposalService
{

    private $entityManager;

    private $proposalSession;

    private $customer;

    private $broker;

    private $brokerId;

    private $motherBrokerId;

    private $childBrokerId;

    private $proposalEntity;

    private $brokerChildProposalEntity;

    private $brokerProposalEntity;

    private $generalService;

    private $userRoleId;

    private $userId;

    private $commisionType;

    private $proposalSessionId;
    
    private $premiumService;

    private $centralBrokerId;
    
    private $redirect;
    
    private $flashMessage;

    const PROPOSAL_STATUS_WAITING_CUSTOMER_RESPONSE = 1;

    const PROPOSAL_STATUS_PROCESSING = 2;

    const PROPOSAL_STATUS_PROCESSED = 3;
    
    const PROPOSAL_STATUS_PAID = 4;
    
    const PROPOSAL_STATUS_PROCESSING_POLICY = 5;
    
    const PROPOSAL_STATUS_ACCEPTED_BY_CUSTOMER = 6;
    
    const PROPOSAL_STATUS_CUSTOMER_VIEWED = 8;
    
    public function proposalMail($messagePointers, $var, $template ){
        $mailService = $this->mailService;
        $message = $mailService->getMessage();
        $message->addTo($messagePointers['to'])
        ->setFrom("info@imapp.ng", $messagePointers['fromName'])
        ->setSubject($messagePointers['subject']);
        $mailService->setTemplate($template, $var);
        $mailService->send();
    }
    
//     /**
//      * 
//      * @param object $proposalEntity
//      */
//     public function getCoverDetails($proposalEntity){
        
//         return $hey;
//     }
    
   
    /**
     * This generates a premium, and sets the value in a session for the app to access
     * 
     * @param unknown $proposalEntity
     */
    public function proposalPremiumGenerator($proposalEntity){
        $premiumService = $this->premiumService;
        $premiumSession = new Container("proposal_premium");
        $premiumSession->isAuto = FALSE;
        $premiumService->setValueType($proposalEntity->getValueType()
            ->getId())
            ->setObjectsArray($proposalEntity->getObject())
            ->setPremiumRate($proposalEntity->getValue());
            
            $objectArray = $proposalEntity->getObject();
            $premium = "";
           
            if($proposalEntity->getIsManualPremium() == TRUE){
//                 $premiumSession->previousPremium = $premium;
                $manualPremium = $proposalEntity->getManualPremium();
                $premiumSession->isAuto = FALSE;
                $premiumSession->premiumCurrency = $manualPremium->getCurrency()->getCode();
                $premiumSession->premium = $manualPremium->getPremium();
//                 return $this->premiumCondition($proposalEntity, $premiumSession, $premiumSession->premiumCurrency);
            }else if($proposalEntity->getIsManualPremium() == FALSE){
//                 $premiumSession->previousPremium = $premium;
               
                $premium = $premiumService->premiumCalculator();
                $currency = NULL;
                if(count($objectArray)>0){
                $currency = $objectArray[count($objectArray) - 1]->getCurrency()->getCode();
                $premiumSession->premiumCurrencyId = $objectArray[count($objectArray) - 1]->getCurrency()->getId();
                }else{
                    $currency = "NGN";
                }
                $premiumSession->isAuto = TRUE;
                $premiumSession->premiumCurrency = $currency;
                
                $premiumSession->premium = $premium;
//                 return $this->premiumCondition($proposalEntity, $premiumSession, $currency);
            }else{
                $currency = "NGN";
                $premium = "";
                $premiumSession->isAuto = FALSE;
                $premiumSession->premiumCurrency = $currency;
                
                $premiumSession->premium = $premium;
            }
    }
    
    public function getProposalBrokerId($id){
        $em = $this->entityManager;
        $proposal = $em->find("Proposal\Entity\Proposal", $id);
        $customerBrokerId = $proposal->getCustomer()->getCustomerBroker()->getBroker()->getId();
        return $customerBrokerId;
    }

    public function hydrateProposal($entity)
    {
        $em = $this->entityManager;
        $brokerProposalEntity = $this->brokerProposalEntity;
        // $brokerChildProposalEntity = $this->brokerChildProposalEntity;
        $res = NULL;
        $userRole = $this->userRoleId;
        switch ($userRole) {
            case UserService::USER_ROLE_BROKER:
            case UserService::USER_ROLE_BROKER_CHILD:
                $entity->setProposalAdminstrator($em->find("Settings\Entity\Administrator", GeneralService::ADMINSTRATOR_BROKER));
                $brokerProposalEntity->setProposal($entity);
                if ($this->userRoleId == UserService::USER_ROLE_BROKER) {
                    $brokerProposalEntity->setBroker($em->find("Users\Entity\InsuranceBrokerRegistered", $this->brokerId));
                }
                
                $em->persist($brokerProposalEntity);
                break;
        }
        $entity->setCreatedOn(new \DateTime('NOW'));
        $entity->setProposalCode($this->generateProposalCode());
        $entity->setProposalStatus($em->find("Proposal\Entity\ProposalStatus", ProposalService::PROPOSAL_STATUS_WAITING_CUSTOMER_RESPONSE));
        $entity->setIsActive(true);
        try {
            // dont Send Mail Yet
            // var_dump($brokerProposalEntity);
            $em->persist($entity);
            $em->flush();
            return $entity->getId();
        } catch (\Exception $e) {
            echo "Something went wrong";
        }
    }
    
    

    public function getProposalSession()
    {
        return $this->proposalSession;
    }
    
    
    /**
     * This condition creates a session and redirects to the create 
     */
    public function createProposalCondition($id){
        
        $proposalSession = $this->proposalSession;
        if($id != NULL){
            $proposalSession->proposalId = $id;
           return 0;
           // $this->redirect->toRoute("proposal/default", array("action"=>"create"));
            //var_dump($this->redirect);
        }
        
        
        if($proposalSession->proposalId == NULL){
            $proposalSession->proposalId = $id;
            if($id == NULL){
               // $this->flashMessage->addErrorMessage("A proposal must be assigned to a customer");
               // $this->redirect->toRoute("customer");
               return 1;
            }
        }
        
        
        
    }
    
    /**
     * This condition creates a session and redirects to the process action
     */
    public function proposalSessionCondition($id){
        
        $proposalSession = $this->proposalSession;
        if($id != NULL){
            $proposalSession->proposalId = $id;
            return 0;
            // $this->redirect->toRoute("proposal/default", array("action"=>"create"));
            //var_dump($this->redirect);
        }
        
        
        if($proposalSession->proposalId == NULL){
            $proposalSession->proposalId = $id;
            if($id == NULL){
                // $this->flashMessage->addErrorMessage("A proposal must be assigned to a customer");
                // $this->redirect->toRoute("customer");
                return 1;
            }
        }
        
        
        
    }

    /**
     * Use this to set the id of isurance selected by the broker
     * variable = insuranceTye,
     */
    public function setInsuranceType()
    {
        if ($this->proposalSessionId->insuranceType != NULL) {
            switch ($this->proposalSessionId->insuranceType) {
            }
        }
    }

    public function startProposalSession(array $info)
    {
        $session = $this->proposalSession;
        $proposal = array();
        $id = $info['id'];
        $insCat = $info['insCat'];
        $insServ = $info['insServ'];
        $session->proposalId = $info['id'];
        $proposal[$id]['id'] = $id;
        $proposal[$id]['cat'] = $insCat;
        $proposal[$id]['serv'] = $insServ;
        $session->proposal = $proposal;
        // $this->proposalSessionId = $session->id;
    }

    public function proposalRelatedObject()
    {
        // This gets the related object for the proposal
    }

    public function proposalPremium()
    {}

    public function getMyProposals()
    {
        $userRole = $this->userRoleId;
        $generalService = $this->generalService;
        return $generalService->UseCaseConditionFunction($this->getBrokerProposal(), $this->getChildBrokerProposal());
    }

    public function generateProposalCode()
    {
        $const = "prop";
        $id = $this->userId;
        $code = \uniqid($const) . $id;
        return $code;
    }

    private function getProposals()
    {}

    private function getChildBrokerProposal()
    {
        $em = $this->entityManager;
        $data = $em->getRepository('Proposal\Entity\Proposal')->findChildBrokerProposal($this->centralBrokerId);
        return $data;
       // var_dump($data);
        
    }

    public function getBrokerProposal()
    {
        $em = $this->entityManager;
        $data = $em->getRepository('Proposal\Entity\Proposal')->findAllBrokerProposal($this->brokerId);
        return $data;
        
    }

    // Begin Stters
    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    // public function setCustomer($cus){
    // $this->customer = $cus;
    // return $this;
    // }
    
    // public function setBroker($broker){
    // $this->broker = $broker;
    // return $this;
    
    // }
    
    // public function setChildBroker($broker){
    // $this->childBroker = $broker;
    // return $this;
    // }
    public function setGeneralService($service)
    {
        $this->generalService = $service;
        return $this;
    }

    public function setProposalEntity($entity)
    {
        $this->proposalEntity = $entity;
        return $this;
    }

    public function setChildBrokerProposalEntity($entity)
    {
        $this->brokerChildProposalEntity = $entity;
        return $this;
    }

    public function setBrokerProposalEntity($entity)
    {
        $this->brokerProposalEntity = $entity;
        return $this;
    }

    public function setUserRoleId($id)
    {
        $this->userRoleId = $id;
        return $this;
    }

    public function setBrokerId($id)
    {
        $this->brokerId = $id;
        return $this;
    }

    public function setMotherBrokerId($id)
    {
        $this->motherBrokerId = $id;
        return $this;
    }

    public function setChildBrokerId($id)
    {
        $this->childBrokerId = $id;
        return $this;
    }

    public function setUserId($id)
    {
        $this->userId = $id;
        return $this;
    }

    public function setProposalSession($session)
    {
        $this->proposalSession = $session;
        return $this;
    }

    public function setCentralBrokerId($id)
    {
        $this->centralBrokerId = $id;
        return $this;
    }
    
    public function setRedirect($red){
        $this->redirect = $red;
        return $this;
    }
    
    public function setFlashMessage($flash){
        $this->flashMessage = $flash ;
        return $this;
    }
    
    public function setPremiumService($xserv){
        $this->premiumService = $xserv;
        return $this;
    }
    
    // public function setProposalBrokerEntity($entity){
    // $this->proposalBrokerEntity = $entity;
    // return $this;
    // }
    
    // public function setProposalBrokerChild($entity){
    // $this->proposalBrokerChildEntity = $entity;
    // return $this;
    // }
    
    // End Setters
}

