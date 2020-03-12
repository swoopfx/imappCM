<?php
namespace Policy\Service;

use Policy\Entity\CoverNote;

/**
 *
 * @author otaba
 *        
 */
class CoverNoteService
{

    private $coverNoteSession;

    private $mailService;

    private $centralBrokerId;

    private $entityManager;

    const COVERNOTE_STATUS_PROCESSING_POLICY = 3;

    const COVERNOTE_STATUS_POLICY_ISSUED_AND_VALID = 4;

    const COVERNOTEE_STATUS_POLICY_ISSUED_BUT_PENDING = 5;

    const COVERNOTE_STATUS_COVER_DECLINED_BY_INSURER = 1;

    const COVERNOTE_STATUS_COVERNOTE_REJECTED = 2;

    const COVERNOTE_STATUS_EXPIRED = 7;

    const COVERNOTE_CATEGORY_OFFER = 1;

    const COVERNOTE_CATEGORY_PROPOSAL = 2;

    const COVERNOTE_CATEGORY_PACKAGES = 3;

    const COVERNOTE_CATEGORY_FLOAT_POLICY = 5;

    const COVERNOTE_CATEGORY_CUSTOMER = 7;

    /**
     */
    public function __construct()
    {}

    public function coverNoteUid()
    {
        $const = "cover";
        $code = \uniqid($const);
        return $code;
    }

    public function coverNoteCreateMailNotification($toEmail, $sender = "IMAPP CM", $subject = "", $templateInfo = array())
    {
        $mailService = $this->mailService;
        $message = $mailService->getMessage();
        $message->addTo($toEmail)
            ->setFrom("info@imapp.ng", $sender)
            ->setSubject($subject);
        $mailService->setTemplate($templateInfo['template'], $templateInfo['var']);
        $mailService->send();
    }
    
    
    public static function getServiceTypeId($covernoteEntity)
    {
        $serviceId = "";
        $categoryId = $covernoteEntity->getCoverCategory()->getId();
        switch ($categoryId) {
            case CoverNoteService::COVERNOTE_CATEGORY_OFFER:
                $service = $covernoteEntity->getOffer()
                ->getOfferServiceType()
                ->getId();
                $serviceId = $service;
                break;
                
            case CoverNoteService::COVERNOTE_CATEGORY_PACKAGES:
                // $link = "Source : <a class='btn btn-default' href='".$url("offer/default", array("action"=>"pre-view", "id"=>$covernoteEntity->getPackages()->getId()))."'> Packages</a>";
                // var_dump($covernoteEntity->getPackage()->getPackages());
                
                if ($covernoteEntity->getPackage()
                ->getPackages()
                ->getServiceType() == NULL) {
                    return "<p style='color: red'>No Service Type</p>";
                } else {
                    $service = $covernoteEntity->getPackage()
                    ->getPackages()
                    ->getServiceType()
                    ->getId();
                    $serviceId = $service;
                }
                
                break;
                
            case CoverNoteService::COVERNOTE_CATEGORY_PROPOSAL:
                $service = $covernoteEntity->getProposal()
                ->getServiceType()
                ->getId();
                $serviceId = $service;
                break;
                
            case CoverNoteService::COVERNOTE_CATEGORY_FLOAT_POLICY:
                if ($covernoteEntity->getPolicyFloat()->getServiceType() == NULL) {
                    return "<p style='color: red'>No Service Type</p>";
                } else {
                    $service = $covernoteEntity->getPolicyFloat()
                    ->getServiceType()
                    ->getId();
                    $serviceId = $service;
                }
                break;
        }
        return $serviceId;
    }

    /**
     *This function returns the namce of the insurance service 
     * @param CoverNote $covernoteEntity
     * @return string
     */
    public static function getServiceTypeName($covernoteEntity)
    {
        $serviceName = "";
        $categoryId = $covernoteEntity->getCoverCategory()->getId();
        switch ($categoryId) {
            case CoverNoteService::COVERNOTE_CATEGORY_OFFER:
                $service = $covernoteEntity->getOffer()
                    ->getOfferServiceType()
                    ->getInsuranceService();
                $serviceName = $service;
                break;

            case CoverNoteService::COVERNOTE_CATEGORY_PACKAGES:
                // $link = "Source : <a class='btn btn-default' href='".$url("offer/default", array("action"=>"pre-view", "id"=>$covernoteEntity->getPackages()->getId()))."'> Packages</a>";
                // var_dump($covernoteEntity->getPackage()->getPackages());

                if ($covernoteEntity->getPackage()
                    ->getPackages()
                    ->getServiceType() == NULL) {
                    return "<p style='color: red'>No Service Type</p>";
                } else {
                    $service = $covernoteEntity->getPackage()
                        ->getPackages()
                        ->getServiceType()
                        ->getInsuranceService();
                    $serviceName = $service;
                }

                break;

            case CoverNoteService::COVERNOTE_CATEGORY_PROPOSAL:
                $service = $covernoteEntity->getProposal()
                    ->getServiceType()
                    ->getInsuranceService();
                $serviceName = $service;
                break;

            case CoverNoteService::COVERNOTE_CATEGORY_FLOAT_POLICY:
                if ($covernoteEntity->getPolicyFloat()->getServiceType() == NULL) {
                    return "<p style='color: red'>No Service Type</p>";
                } else {
                    $service = $covernoteEntity->getPolicyFloat()
                        ->getServiceType()
                        ->getInsuranceService();
                    $serviceName = $service;
                }
                break;
        }
        return $serviceName;
    }
    
    public static function getSpecificTypeId($covernoteEntity)
    {
        $serviceId = "";
        $categoryId = $covernoteEntity->getCoverCategory()->getId();
        switch ($categoryId) {
            case CoverNoteService::COVERNOTE_CATEGORY_OFFER:
                $service = $covernoteEntity->getOffer()
                ->getOfferSpecificService()
                ->getId();
                $serviceId = $service;
                break;
                
            case CoverNoteService::COVERNOTE_CATEGORY_PACKAGES:
                if ($covernoteEntity->getPackage()
                ->getPackages()
                ->getSpecificService() == NULL) {
                    return "<p style='color: red'>No Service Type</p>";
                } else {
                    $service = $covernoteEntity->getPackage()
                    ->getPackages()
                    ->getSpecificService()
                    ->getId();
                    $serviceId = $service;
                }
                
                break;
                
            case CoverNoteService::COVERNOTE_CATEGORY_PROPOSAL:
                $service = $covernoteEntity->getProposal()
                ->getSpecificService()
                ->getId();
                $serviceId = $service;
                break;
            case CoverNoteService::COVERNOTE_CATEGORY_FLOAT_POLICY:
                if ($covernoteEntity->getPolicyFloat()->getSpecificService() == NULL) {
                    return "<p style='color: red'>No Service Type</p>";
                } else {
                    $service = $covernoteEntity->getPolicyFloat()
                    ->getSpecificService()
                    ->getId();
                    $serviceId =  $service;
                }
                break;
        }
        return $serviceId;
    }

    /**
     * This function gets the name of the specific insurance service 
     * @param CoverNote $covernoteEntity
     * @return string
     */
    public static function getSpecificTypeName($covernoteEntity)
    {
        $serviceName = "";
        $categoryId = $covernoteEntity->getCoverCategory()->getId();
        switch ($categoryId) {
            case CoverNoteService::COVERNOTE_CATEGORY_OFFER:
                $service = $covernoteEntity->getOffer()
                    ->getOfferSpecificService()
                    ->getSpecificService();
                    $serviceName = $service;
                break;

            case CoverNoteService::COVERNOTE_CATEGORY_PACKAGES:
                if ($covernoteEntity->getPackage()
                    ->getPackages()
                    ->getSpecificService() == NULL) {
                    return "<p style='color: red'>No Service Type</p>";
                } else {
                    $service = $covernoteEntity->getPackage()
                        ->getPackages()
                        ->getSpecificService()
                        ->getSpecificService();
                        $serviceName = $service;
                }

                break;

            case CoverNoteService::COVERNOTE_CATEGORY_PROPOSAL:
                $service = $covernoteEntity->getProposal()
                    ->getSpecificService()
                    ->getSpecificService();
                    $serviceName = $service;
                break;
            case CoverNoteService::COVERNOTE_CATEGORY_FLOAT_POLICY:
                if ($covernoteEntity->getPolicyFloat()->getSpecificService() == NULL) {
                    return "<p style='color: red'>No Service Type</p>";
                } else {
                    $service = $covernoteEntity->getPolicyFloat()
                        ->getSpecificService()
                        ->getSpecificService();
                    return $service;
                }
                break;
        }
        return $serviceName;
    }

    public function getCoverNoteSession()
    {
        return $this->coverNoteSession;
    }

    // Begin Setters
    public function setCoverNoteSession($sess)
    {
        $this->coverNoteSession = $sess;
        return $this;
    }

    public function setMailService($xserv)
    {
        $this->mailService = $xserv;
        return $this;
    }

    public function setCentralBrokerId($id)
    {
        $this->centralBrokerId = $id;
        return $this;
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    // End setters
}

