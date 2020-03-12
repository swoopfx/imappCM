<?php
namespace Claims\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\ClaimsEmployeeLiabilityWagesDuration;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="claims_employers_liability_wages_settlement")
 * @author otaba
 *        
 */
class ClaimsEmployersLiabilityWagesSettlement
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="ClaimsEmployersLiability", inversedBy="wageSettlement")
     * @var ClaimsEmployersLiability
     */
    private $claimsEmployerLiability;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Settings\Entity\ClaimsEmployeeLiabilityWagesDuration")
     * @var ClaimsEmployeeLiabilityWagesDuration
     */
    private $wagesDuration;

    /**
     *
     * @ORM\Column(name="cash_wages", nullable=true)
     * @var string
     */
    private $cashWages;

    /**
     *
     * @ORM\Column(name="food_and_other_values", type="text",  nullable=true)
     * @var string
     */
    private $foodAndOthersValue;

    /**
     *
     * @ORM\Column(name="absence_date", type="datetime",  nullable=true)
     * @var \DateTime
     */
    private $absenceDate;

    /**
     *
     * @ORM\Column(name="abscence_reason", type="text", nullable=true)
     * @var string
     */
    private $absensceReason;

    public function __construct()
    {

        // TODO - Insert your code here
    }
    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \Claims\Entity\ClaimsEmployersLiability
     */
    public function getClaimsEmployerLiability()
    {
        return $this->claimsEmployerLiability;
    }

    /**
     * @return \Settings\Entity\ClaimsEmployeeLiabilityWagesDuration
     */
    public function getWagesDuration()
    {
        return $this->wagesDuration;
    }

    /**
     * @return string
     */
    public function getCashWages()
    {
        return $this->cashWages;
    }

    /**
     * @return string
     */
    public function getFoodAndOthersValue()
    {
        return $this->foodAndOthersValue;
    }

    /**
     * @return \DateTime
     */
    public function getAbsenceDate()
    {
        return $this->absenceDate;
    }

    /**
     * @return string
     */
    public function getAbsensceReason()
    {
        return $this->absensceReason;
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
     * @param \Claims\Entity\ClaimsEmployersLiability $claimsEmployerLiability
     */
    public function setClaimsEmployerLiability($claimsEmployerLiability)
    {
        $this->claimsEmployerLiability = $claimsEmployerLiability;
        return $this;
    }

    /**
     * @param \Settings\Entity\ClaimsEmployeeLiabilityWagesDuration $wagesDuration
     */
    public function setWagesDuration($wagesDuration)
    {
        $this->wagesDuration = $wagesDuration;
        return $this;
    }

    /**
     * @param string $cashWages
     */
    public function setCashWages($cashWages)
    {
        $this->cashWages = $cashWages;
        return $this;
    }

    /**
     * @param string $foodAndOthersValue
     */
    public function setFoodAndOthersValue($foodAndOthersValue)
    {
        $this->foodAndOthersValue = $foodAndOthersValue;
        return $this;
    }

    /**
     * @param \DateTime $absenceDate
     */
    public function setAbsenceDate($absenceDate)
    {
        $this->absenceDate = $absenceDate;
        return $this;
    }

    /**
     * @param string $absensceReason
     */
    public function setAbsensceReason($absensceReason)
    {
        $this->absensceReason = $absensceReason;
        return $this;
    }

}

