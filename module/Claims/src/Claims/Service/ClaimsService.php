<?php
namespace Claims\Service;

use GeneralServicer\Service\GeneralService;
use Policy\Service\CoverNoteService;
use Policy\Entity\CoverNote;

/**
 *
 * @author swoopfx
 *        
 */
class ClaimsService
{

    private $generalService;

    private $entityManager;

    private $userId;

    private $centralBrokerId;

    private $brokerClaimsSession;

    private $customerClaimsSession;

    const CLAIMS_STATUS_INITIATED = 1;

    const CLAIMS_STATUS_COMPLETED = 2;

    const CLAIMS_STATUS_PROCESSING = 3;

    const CLAIMS_STATUS_SETTLED_AND_PAID = 4;
    
    const CLAIMS_STATUS_APPROVED_PROCESSING_PAYMENT = 5;

    const CLAIMS_STATUS_SETTLED_AND_UNPAID = 5;
    
    const CLAIMS_STATUS_APPROVED_CUSTOMER_PAID = 4;

    const CLAIMS_STATUS_DECLINED = 6;

    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    public function getUnsettledClaims()
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Claims\Entity\CLaims")->findUnsettledClaims($this->centralBrokerId);
        // var_dump($this->centralBrokerId);
        return $data;
    }

    public function hydrateClaims($data)
    {
        $em = $this->generalService->getEntityManager();
        
        try {} catch (\Exception $e) {}
    }

    public function myUnsettledClaims()
    {
        
        $em = $this->entityManager;
        
        $data = $em->getRepository("Claims\Entity\CLaims")->findUnsettledClaims($this->centralBrokerId);
        
        return $data;
    }

    /**
     * This gets the customer Specific unsettled Claims
     *
     * @param int $customerId            
     * @return object
     */
    public function getCustomerUnsettleClaims($customerId)
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Claims\Entity\CLaims")->findCustomerUnsettledClaims($customerId);
        return $data;
    }

    public function claimsFormCondition($claimsEntity)
    {
        $coverCategoryId = $claimsEntity->getPolicy()
            ->getCoverNote()
            ->getCoverCategory()
            ->getId();
        $switchData = "";
        if ($coverCategoryId == CoverNoteService::COVERNOTE_CATEGORY_OFFER) {
            $claimsEntity->getPolicy()
                ->getCoverNote()
                ->getOffer(); // get The Insuracne service Type
        }
        switch ($switchData) {
            case GeneralService::INSURANCE_SERVICE_MOTOR:
                // setValidation for motor claims form
                // return motor claims Form fieldset
                break;
            
            default:
                // return otthers form fiedlset
                break;
        }
    }

    
    /**
     * This function return the service type based on the service associated to the policy
     * @param CoverNote $coverNoteEntity
     * @return mixed
     */
    public function claimsFormServiceType($coverNoteEntity)
    {
        $coverCategory = $coverNoteEntity->getCoverCategory()->getId();
        switch ($coverCategory) {
            case CoverNoteService::COVERNOTE_CATEGORY_OFFER:
                return $this->offerSeviceType($coverNoteEntity->getOffer());
                break;
            case CoverNoteService::COVERNOTE_CATEGORY_PACKAGES:
                return $this->packageServiceType($coverNoteEntity->getPackage());
                break;
            
            case CoverNoteService::COVERNOTE_CATEGORY_PROPOSAL:
                return $this->proposalServiceType($coverNoteEntity->getProposal());
                break;
        }
    }

    public function claimsFormSpecificService($coverNoteEntity)
    {
        $coverCategory = $coverNoteEntity->getCoverCategory()->getId();
    }

    private function offerSpecificService($offerEntity)
    {
        return $offerEntity->getOfferSpecificService()->getId();
    }

    private function packageSpecificService($packageEntity)
    {
        return $packageEntity->getSpecificService()->getId();
    }

    private function proposalSpecificService($proposalEntity)
    {
        return $proposalEntity->getSpecificService()->getId();
    }

    private function offerSeviceType($offerEntity)
    {
        return $offerEntity->getOfferServiceType()->getId();
    }

    private function proposalServiceType($proposalEntity)
    {
        return $proposalEntity->getServiceType()->getId();
    }

    private function packageServiceType($packageEntity)
    {
        return $packageEntity->getServiceType()->getId();
    }

    public function createUniqueId()
    {
        $generalServie = $this->generalService;
        $const = "claims";
        $code = \uniqid($const);
        return $code;
    }

    // Begin Gtters
    public function getCustomerClaimsSession()
    {
        return $this->customerClaimsSession;
    }

    public function getBrokerClaimsSession()
    {
        return $this->brokerClaimsSession;
    }

    // End Getters
    
    // Begin Setters
    public function setGeneralService($xserv)
    {
        $this->generalService = $xserv;
        return $this;
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setCentralBrokerId($id)
    {
        $this->centralBrokerId = $id;
        return $this;
    }

    public function setCustomerClaimsSession($sess)
    {
        $this->customerClaimsSession = $sess;
        return $this;
    }

    public function setBrokerClaimsSession($sess)
    {
        $this->brokerClaimsSession = $sess;
        return $this;
    }
    
    // End Setters
}

