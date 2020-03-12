<?php
namespace Offer\Service;

/**
 *
 * @author swoopfx
 *        
 */
class OfferIndexControllerService
{

    protected $entityManager;

    protected $session;

    protected $offerInfoEntity;

    protected $otherEntity;

    protected $validData;

    protected $offercode;

    protected $userId;

    public function __construct()
    {
        // $this->session->offerInfo = FALSE;
    }

   

    public function motorPolicySubmitted($offerData, $motorData, $data)
    {
        try {
            $em = $this->entityManager;
            $offerData->setOfferCode($this->offercode);
            $offerData->setCreatedOn(new \DateTime());
            $offerData->setOfferStatuses($em->find('Offer\Entity\OfferStatus', 2));
            //$offerData->setRequireAdvice(); // get from the data
            $offerData->setUser($em->find('CsnUser\Entity\User', $this->userId));
            $offerData->setIsRenewable(False);
            $offerData->setIsHidden(False);
            $offerData->setIsPolicized(false);
            //$motorData->setVehicleValueType($em->find('', $data['offerFieldset']['motor_offer']['typeOfVehicle']));
            $motorData->setTypeOfVehicle($em->find('Settings\Entity\MotorType', $data['offerFieldset']['motor_offer']['typeOfVehicle']));
            $motorData->setOffer($offerData);

            
            $em->persist($offerData);
            $em->persist($motorData);
            $em->flush();
            $data= array();
            $data[0] = $offerData->getId();
            $data[1] = $offerData->getOfferCode();
            return $data;
        } catch (\Exception $e) {
            echo "Something went wrong";
        }
    }

    public function hydrateObjectForm($offerEntity, $otherData, $data)
    {}

    public function hydratePremiumForm()
    {}

    public function hydrateSummary()
    {}

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setOfferInfoEntity($offer)
    {
        $this->offerInfoEntity = $offer;
    }

    public function setOtherEntity($other)
    {
        $this->otherEntity = $other;
    }

    public function setValidData($data)
    {
        $this->validData = $data;
    }

    public function setSession($ses)
    {
        $this->session = $ses;
        
        return $this;
    }

    public function setUserId($auth)
    {
        $this->auth = $auth;
        if ($this->auth->hasIdentity()) {
            $this->userId = $this->auth->getIdentity()->getId();
        }
    }

    public function setOfferCode($code)
    {
        $this->offercode = $code;
        return $this;
    }

    private function setOfferInfoIsDone()
    {
        $this->session->offerInfo = TRUE;
    }

    private function stepOfferObjectIsDOne()
    {
        $this->session->stepObject = TRUE;
    }

    private function stepOfferPremuinIsDone()
    {
        $this->session->offerPremium = TRUE;
    }
}

