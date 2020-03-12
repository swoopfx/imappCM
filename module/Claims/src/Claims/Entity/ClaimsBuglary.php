<?php
namespace Claims\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="claims_buglary")
 *
 * @author otaba
 *        
 */
class ClaimsBuglary
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Possible date Theft occured
     *
     * @ORM\Column(name="theft_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $theftDate;

    /**
     * Description of the theft and entry point, including method
     *
     * @ORM\Column(name="theft_entry_desc", type="text", nullable=true)
     *
     * @var string
     */
    private $theftEntryDesc;

    /**
     * Any theft suspect , name
     *
     * @ORM\Column(name="theft_suspect", type="string", nullable=true)
     *
     * @var string
     */
    private $theftSuspect;

    /**
     * Date and time theft/buglary was discovered
     *
     * @ORM\Column(name="date_theft_discovered", type="datetime", nullable=true)
     *
     * @var string
     */
    private $dateTheftDiscovered;

    /**
     * Date police was nitified
     *
     * @ORM\Column(name="date_police_notify", type="datetime", nullable=true)
     *
     * @var string
     */
    private $datePoliceNotify;

    /**
     * Station notificatrion occuired
     *
     * @ORM\Column(name="station_police_notify", type="string", nullable=true)
     *
     * @var string
     */
    private $stationPoliceNotify;

    /**
     * Identify if the apartment is occupied during buglary
     *
     * @ORM\Column(name="is_occupied_at_buglary", type="boolean", nullable=true)
     * @var boolean
     */
    private $isOccupiedAtBurglary;

    /**
     * Number of days it does not get uccupied in a year
     *
     * @ORM\Column(name="un_occupied_duration", type="string", nullable=true)
     * @var string
     */
    private $unOccupiedDuration;

    /**
     *
     *@ORM\Column(name="is_available_security", type="boolean", nullable=true)
     * @var boolean
     */
    private $isAvailableSecurity;

    /**
     *
     * @ORM\Column(name="security_type", type="string", nullable=true)
     *
     * @var string
     */
    private $securityType;

    /**
     *
     * @ORM\OneToMany(targetEntity="Claims\Entity\ClaimLossList", mappedBy="claimsBuglary")
     *
     * @var Collection
     */
    private $listLoss;

    /**
     *
     * @ORM\OneToOne(targetEntity="Claims\Entity\CLaims", inversedBy="claimsBuglary",  cascade={"persist", "remove"})
     *
     * @var Claims;
     */
    private $claims;
    
    /**
     * @ORM\Column(name="is_previous_loss", type="boolean", nullable=true)
     * @var boolean
     */
    private $isPreviousLoss;

    /**
     * This privides a list of previous loss
     *
     * @ORM\Column(name="previous_loss", type="text", nullable=true)
     *
     * @var string
     */
    private $previousLoss;

    /**
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $createdOn;

    /**
     */
    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getTheftDate()
    {
        return $this->theftDate;
    }

    public function setTheftDate($date)
    {
        $this->theftDate = $date;
        return $this;
    }

    public function getTheftEntryDesc()
    {
        return $this->theftEntryDesc;
    }

    public function setTheftEntryDesc($desc)
    {
        $this->theftEntryDesc = $desc;
        return $this;
    }

    public function getTheftSuspect()
    {
        return $this->theftSuspect;
    }

    public function setTheftSuspect($pect)
    {
        $this->theftSuspect = $pect;
        return $this;
    }

    public function getDateTheftDiscovered()
    {
        return $this->dateTheftDiscovered;
    }

    public function setDateTheftDiscovered($date)
    {
        $this->dateTheftDiscovered = $date;
        return $this;
    }

    public function getStationPoliceNotify()
    {
        return $this->stationPoliceNotify;
    }

    public function setStationPoliceNotify($set)
    {
        $this->stationPoliceNotify = $set;
        return $this;
    }

    public function getSecurityType()
    {
        return $this->securityType;
    }

    public function setSecurityType($type)
    {
        $this->securityType = $type;
        return $this;
    }

    public function getDatePoliceNotify()
    {
        return $this->datePoliceNotify;
    }

    public function setDatePoliceNotify($sert)
    {
        $this->datePoliceNotify = $sert;
        return $this;
    }

    public function getListLoss()
    {
        return $this->listLoss;
    }

    public function addListLoss($list)
    {
        if (! $this->listLoss->contains($list)) {
            $this->listLoss->add($list);
        }
        return $this;
    }

    public function removeListLoss($list)
    {
        if ($this->listLoss->contains($list)) {
            $this->listLoss->remove($list);
        }

        return $this;
    }

    public function getClaims()
    {
        return $this->claims;
    }

    public function setClaims($claim)
    {
        $this->claims = $claim;
        return $this;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function getPreviousLoss()
    {
        return $this->previousLoss;
    }

    public function setPreviousLoss($los)
    {
        $this->previousLoss = $los;
        return $this;
    }

    public function setCreatedOn($date)
    {
        $this->createdOn = $date;
        return $this;
    }
    /**
     * @return boolean
     */
    public function getIsOccupiedAtBurglary()
    {
        return $this->isOccupiedAtBurglary;
    }

    /**
     * @return string
     */
    public function getUnOccupiedDuration()
    {
        return $this->unOccupiedDuration;
    }

    /**
     * @return boolean
     */
    public function getIsAvailableSecurity()
    {
        return $this->isAvailableSecurity;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param boolean $isOccupiedAtBurglary
     */
    public function setIsOccupiedAtBurglary($isOccupiedAtBurglary)
    {
        $this->isOccupiedAtBurglary = $isOccupiedAtBurglary;
        return $this;
    }

    /**
     * @param string $unOccupiedDuration
     */
    public function setUnOccupiedDuration($unOccupiedDuration)
    {
        $this->unOccupiedDuration = $unOccupiedDuration;
        return $this;
    }

    /**
     * @param boolean $isAvailableSecurity
     */
    public function setIsAvailableSecurity($isAvailableSecurity)
    {
        $this->isAvailableSecurity = $isAvailableSecurity;
        return $this;
    }
    /**
     * @return boolean
     */
    public function getIsPreviousLoss()
    {
        return $this->isPreviousLoss;
    }

    /**
     * @param boolean $isPreviousLoss
     */
    public function setIsPreviousLoss($isPreviousLoss)
    {
        $this->isPreviousLoss = $isPreviousLoss;
        return $this;
        
    }


}

