<?php
namespace Offer\Service;

use Settings\Entity\Insurer;

/**
 *
 * @author swoopfx
 *        
 */
class OfferService
{

    private $entityManager;

    private $userId;

    private $centralBroker;
    
    private $offerSession;
    
    private $mailService;

    const OFFER_STATUS_PROCESSING = 3;

    const OFFER_STATUS_CANCELLED = 4;

    const OFFER_STATUS_SUBMITTED = 5;
    
    const OFFER_STATUS_PAID = 7;

    const OFFER_STATUS_SAVED = 2;

    const OFFER_STATUS_UNSAVED = 1; // equivalent to unsubmiited
    
    const OFFER_STATUS_PAID_PROCESSING = 8;
    
   /**
    * 
    * @param array $messagePointers
    * @param array $var
    * @param string $template
    */
    public function offerMail($messagePointers, $var, $template ){
        $mailService = $this->mailService;
        $message = $mailService->getMessage();
        $message->addTo($messagePointers['to'])
        ->setFrom("info@imapp.ng", $messagePointers['fromName'])
        ->setSubject($messagePointers['subject']);
        $mailService->setTemplate($template, $var);
        $mailService->send();
    }
    
    /**
     * This returns the entity of the insurer assigned to the offer 
     * @param object $offerEntity
     * @return Insurer
     */
    private function getInsurer($offerEntity){
        if($offerEntity->getIsRecommendedInsurer() == TRUE){
            return $offerEntity->getRecommendedInsurer();
        }else{
            return $offerEntity->getIdPreferdInsurer();
        }
    }
    
    /**
     * This returns the name of the insurer assisneg to the offer
     * @param object $offerEntity
     * @return string
     */
    public static function getInsurerByName($offerEntity){
        $insurerEntity = $this->getInsurer($offerEntity);
        return $insurerEntity->getnsuranceName();
    }
    
    

    public function getActiveOffer()
    {
      
        
        return $this->entityManager->getRepository('Offer\Entity\Offer')->findActiveOffers($this->centralBroker);
    }

    public function getActvieOfferJSON()
    {
        // this returns a JSON object
    }
    
    public function getOfferSession(){
        return $this->offerSession;
    }

    public function generateOfferCode()
    {
        $const = "offr";
        $code = \uniqid($const);
        return $code . $this->userId;
    }

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

    public function setCentralBroker($broker)
    {
        $this->centralBroker = $broker;
        return $this;
    }
    
    public function setOfferSession($sess){
        $this->offerSession = $sess;
        return $this;
    }
    
    public function setMailService($mail){
        $this->mailService = $mail;
        return $this;
    }
}

?>