<?php
namespace Claims\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="claims_git")
 * @author otaba
 *        
 */
class ClaimsGit
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Or specifically date of loss
     *
     * @ORM\Column(name="damage_date", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $damageDate;

    // /**
    // *
    // * @ORM\Column(name="loss_notification_date", type="datetime", nullable=true)
    // * @var Datetime
    // */
    // private $lossNotificationDate;

//     /**
//      * Proposed Goods Collection date
//      *
//      * @ORM\Column(name="collection_date", type="datetime", nullable=true)
//      * @var \DateTime
//      */
//     private $collectionDate;

    /**
     * proposed Goods Devlivery date
     *
     * @ORM\Column(name="delivery_date", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $deliveryDate;

    /**
     * Goods where coming from
     *
     * @ORM\Column(name="goods_from", type="string", nullable=true)
     * @var string
     */
    private $goodsFrom;

    /**
     * Goods Where going to
     *
     * @ORM\Column(name="goods_to", type="string", nullable=true)
     * @var string
     */
    private $goodsTo;

    // /**
    // * Name
    // * @ORM\Column(name="carrier_name", type="string", nullable=true)
    // * @var string
    // */
    // private $carrierName;

    // /**
    // * @ORM\Column(name="carrier_address", type="string", nullable=true)
    // * @var string
    // */
    // private $carrierAddress;

    // goods information
    /**
     *
     * @ORM\Column(name="driver_name", type="string", nullable=true)
     * @var string
     */
    private $driverName;

    /**
     * Details of driver including pgon e and or address
     *
     * @ORM\Column(name="driver_contact_details", type="text", nullable=true)
     * @var string
     */
    private $driverContactDetails;

    // /**
    // *
    // * @var unknown
    // */
    // private $driverLiscenceCat;

    /**
     * Proposed Value of goods carried in Naira
     *
     * @ORM\Column(name="goods_total_value", nullable=true, type="string")
     * @var string
     */
    private $goodsTotalValue;

    /**
     * A distict feature or mark on the vehichle
     *
     * @ORM\Column(name="vehicle_reg_mark", nullable=true, type="text")
     * @var string
     */
    private $vehicleRegMark;

    /**
     * Define if a receipt was issued for the goods carried
     *
     * @ORM\Column(name="is_receipt_issued", nullable=true, type="boolean")
     * @var boolean
     */
    private $isReceiptIssued;

    /**
     * Location of last inspection of goods
     *
     * @ORM\Column(name="goods_inspection_location", nullable=true, type="string")
     * @var string
     */
    private $goodsInspectionLocation;

    /**
     * Defines if the vehicle was accompanied in transit, possibly by security os motor boy
     *
     * @ORM\Column(name="is_receipt_accompanied_transit", nullable=true, type="boolean")
     * @var boolean
     */
    private $isAccompaniedInTransit;

    /**
     * Defineing who accompanied the vehichle
     *
     * @ORM\Column(name="is_accopanied_by_whom", nullable=true, type="string")
     * @var string
     */
    private $accompaniedByWhom;

    // private $acompanyList;

    /**
     * Defines if there is a suspect on the
     *
     * @ORM\Column(name="is_theft_suspected", nullable=true, type="boolean")
     * @var boolean
     */
    private $isTheftSuspection;

    /**
     *
     * @ORM\Column(name="suspected_details", nullable=true, type="text")
     * @var boolean
     */
    private $suspectDetails;

    /**
     *
     * @ORM\Column(name="is_previous_claims", nullable=true, type="boolean")
     * @var boolean
     */
    private $isPreviousClaims;

    /**
     *
     * @ORM\Column(name="is_policy_notified", nullable=true, type="boolean")
     * @var boolean
     */
    private $isPoliceNotified;

    /**
     * Date police was notified
     *
     * @ORM\Column(name="date_police_notified", type="datetime", nullable=true)
     * @var \Datetime
     */
    private $datePoliceNotified;

    /**
     * DEfine the name of the alternatkive policy on
     *
     * @ORM\Column(name="is_alternative_policy", type="boolean", nullable=true)
     * @var boolean
     */
    private $isAlternativePolicy;

    /**
     *
     * @ORM\Column(name="alternative_policy", type="string", nullable=true)
     * @var string
     */
    private $alternativePolicy;

    /**
     *
     * @ORM\OneToMany(targetEntity="Claims\Entity\ClaimLossList", mappedBy="claimsGit")
     * @var Collection
     */
    private $lossList;

    /**
     *
     * @ORM\OneToOne(targetEntity="Claims\Entity\CLaims",  cascade={"persist", "remove"})
     *
     * @var CLaims
     */
    private $claims;

    /**
     */
    public function __construct()
    {
        $this->lossList = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDamageDate()
    {
        return $this->damageDate;
    }

    public function setDamageDate($date)
    {
        $this->damageDate = $date;
        return $this;
    }

    public function getCollectionDate()
    {
        return $this->collectionDate;
    }

    public function setCollectionDate($date)
    {
        $this->collectionDate = $date;
        return $this;
    }

    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate($date)
    {
        $this->deliveryDate = $date;
        return $this;
    }

    public function getGoodsFrom()
    {
        return $this->goodsFrom;
    }

    public function setGoodsFrom($from)
    {
        $this->goodsFrom = $from;
        return $this;
    }

    public function getGoodsTo()
    {
        return $this->goodsTo;
    }

    public function setGoodsTo($to)
    {
        $this->goodsTo = $to;
        return $this;
    }

    public function getCarrierName()
    {
        return $this->carrierName;
    }

    public function setCarrierName($car)
    {
        $this->carrierName = $car;
        return $this;
    }

    public function getCarrierAddress()
    {
        return $this->carrierAddress;
    }

    public function setCarrierAddress($add)
    {
        $this->carrierAddress = $add;
        return $this;
    }

    public function getDriverName()
    {
        return $this->driverName;
    }

    public function setDriverName($name)
    {
        $this->driverName = $name;
        return $this;
    }

    public function getDriverLiscenceCat()
    {
        return $this->driverLiscenceCat;
    }

    public function setDriverLiscenceCat($cat)
    {
        $this->driverLiscenceCat = $cat;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getDriverContactDetails()
    {
        return $this->driverContactDetails;
    }

    /**
     *
     * @return string
     */
    public function getGoodsTotalValue()
    {
        return $this->goodsTotalValue;
    }

    /**
     *
     * @return string
     */
    public function getVehicleRegMark()
    {
        return $this->vehicleRegMark;
    }

    /**
     *
     * @return boolean
     */
    public function getIsReceiptIssued()
    {
        return $this->isReceiptIssued;
    }

    /**
     *
     * @return string
     */
    public function getGoodsInspectionLocation()
    {
        return $this->goodsInspectionLocation;
    }

    /**
     *
     * @return boolean
     */
    public function getIsAccompaniedInTransit()
    {
        return $this->isAccompaniedInTransit;
    }

    /**
     *
     * @return string
     */
    public function getAccompaniedByWhom()
    {
        return $this->accompaniedByWhom;
    }

    /**
     *
     * @return boolean
     */
    public function getIsTheftSuspection()
    {
        return $this->isTheftSuspection;
    }

    /**
     *
     * @return boolean
     */
    public function getSuspectDetails()
    {
        return $this->suspectDetails;
    }

    /**
     *
     * @return boolean
     */
    public function getIsPreviousClaims()
    {
        return $this->isPreviousClaims;
    }

    /**
     *
     * @return boolean
     */
    public function getIsPoliceNotified()
    {
        return $this->isPoliceNotified;
    }

    /**
     *
     * @return boolean
     */
    public function getDatePoliceNotified()
    {
        return $this->datePoliceNotified;
    }

    /**
     *
     * @return boolean
     */
    public function getIsAlternativePolicy()
    {
        return $this->isAlternativePolicy;
    }

    /**
     *
     * @return string
     */
    public function getAlternativePolicy()
    {
        return $this->alternativePolicy;
    }

    /**
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLossList()
    {
        return $this->lossList;
    }

    /**
     *
     * @return mixed
     */
    public function getClaims()
    {
        return $this->claims;
    }

    /**
     *
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @param string $driverContactDetails
     */
    public function setDriverContactDetails($driverContactDetails)
    {
        $this->driverContactDetails = $driverContactDetails;
        return $this;
    }

    /**
     *
     * @param string $goodsTotalValue
     */
    public function setGoodsTotalValue($goodsTotalValue)
    {
        $this->goodsTotalValue = $goodsTotalValue;
        return $this;
    }

    /**
     *
     * @param string $vehicleRegMark
     */
    public function setVehicleRegMark($vehicleRegMark)
    {
        $this->vehicleRegMark = $vehicleRegMark;
        return $this;
    }

    /**
     *
     * @param boolean $isReceiptIssued
     */
    public function setIsReceiptIssued($isReceiptIssued)
    {
        $this->isReceiptIssued = $isReceiptIssued;
        return $this;
    }

    /**
     *
     * @param string $goodsInspectionLocation
     */
    public function setGoodsInspectionLocation($goodsInspectionLocation)
    {
        $this->goodsInspectionLocation = $goodsInspectionLocation;
        return $this;
    }

    /**
     *
     * @param boolean $isAccompaniedInTransit
     */
    public function setIsAccompaniedInTransit($isAccompaniedInTransit)
    {
        $this->isAccompaniedInTransit = $isAccompaniedInTransit;
        return $this;
    }

    /**
     *
     * @param string $accompaniedByWhom
     */
    public function setAccompaniedByWhom($accompaniedByWhom)
    {
        $this->accompaniedByWhom = $accompaniedByWhom;
        return $this;
    }

    /**
     *
     * @param boolean $isTheftSuspection
     */
    public function setIsTheftSuspection($isTheftSuspection)
    {
        $this->isTheftSuspection = $isTheftSuspection;
        return $this;
    }

    /**
     *
     * @param boolean $suspectDetails
     */
    public function setSuspectDetails($suspectDetails)
    {
        $this->suspectDetails = $suspectDetails;
        return $this;
    }

    /**
     *
     * @param boolean $isPreviousClaims
     */
    public function setIsPreviousClaims($isPreviousClaims)
    {
        $this->isPreviousClaims = $isPreviousClaims;
        return $this;
    }

    /**
     *
     * @param boolean $isPoliceNotified
     */
    public function setIsPoliceNotified($isPoliceNotified)
    {
        $this->isPoliceNotified = $isPoliceNotified;
        return $this;
    }

    /**
     *
     * @param \Datetime $datePoliceNotified
     */
    public function setDatePoliceNotified($datePoliceNotified)
    {
        $this->datePoliceNotified = $datePoliceNotified;
        return $this;
    }

    /**
     *
     * @param boolean $isAlternativePolicy
     */
    public function setIsAlternativePolicy($isAlternativePolicy)
    {
        $this->isAlternativePolicy = $isAlternativePolicy;
        return $this;
    }

    /**
     *
     * @param string $alternativePolicy
     */
    public function setAlternativePolicy($alternativePolicy)
    {
        $this->alternativePolicy = $alternativePolicy;
        return $this;
    }

    /**
     *
     * @param \Doctrine\Common\Collections\Collection $lossList
     */
    public function setLossList($lossList)
    {
        $this->lossList = $lossList;
        return $this;
    }

    /**
     *
     * @param mixed $claims
     */
    public function setClaims($claims)
    {
        $this->claims = $claims;
        return $this;
    }
}



