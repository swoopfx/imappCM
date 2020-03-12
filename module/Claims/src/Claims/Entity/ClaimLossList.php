<?php
namespace Claims\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\Currency;

/**
 * @ORM\Entity
 * @ORM\Table(name="claims_loss_list")
 *
 * @author otaba
 *        
 */
class ClaimLossList
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="loss_name", type="string", nullable=true)
     *
     * @var string
     */
    private $lossName;

    /**
     * @ORM\Column(name="description", type="text", nullable=true)
     * 
     * @var string
     */
    private $description;

    /**
     * @ORM\Column(name="loss_value", type="string", nullable=true)
     *
     * @var string
     */
    private $lossValue;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
     * 
     * @var Currency
     */
    private $currency;

    /**
     * Salvage
     * @ORM\Column(name="salvage", type="string", nullable=true)
     * 
     * @var string
     */
    private $salvage;

    /**
     * @ORM\Column(name="amount_claimed", type="string", nullable=true)
     * 
     * @var string
     */
    private $amountClaimed;

    /**
     * @ORM\ManyToOne(targetEntity="Claims\Entity\ClaimsCashInTransit", inversedBy="listLoss")
     *
     * @var ClaimsCashInTransit
     */
    private $claimsCashInTransit;

    /**
     * @ORM\ManyToOne(targetEntity="Claims\Entity\ClaimsBuglary", inversedBy="listLoss")
     *
     * @var ClaimsBuglary
     */
    private $claimsBuglary;

    /**
     * @ORM\ManyToOne(targetEntity="CLaimsFireLoss", inversedBy="listLoss")
     * 
     * @var CLaimsFireLoss
     */
    private $claimsFireLoss;

    /**
     * @ORM\ManyToOne(targetEntity="ClaimsHouseHolder", inversedBy="listLoss")
     * 
     * @var ClaimsHouseHolder
     */
    private $claimsHouseHolder;

    /**
     * @ORM\ManyToOne(targetEntity="ClaimsHouseHolder", inversedBy="listLoss")
     * 
     * @var ClaimsGit
     */
    private $claimsGit;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getLossName()
    {
        return $this->lossName;
    }

    public function setLossName($loss)
    {
        $this->lossName = $loss;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($desc)
    {
        $this->description = $desc;
        return $this;
    }

    public function getLossValue()
    {
        return $this->lossValue;
    }

    public function setLossValue($value)
    {
        $this->lossValue = $value;
        return $this;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency($cur)
    {
        $this->currency = $cur;
        return $this;
    }

    public function getClaimsCashInTransit()
    {
        return $this->claimsCashInTransit;
    }

    public function setClaimsCashInTransit($claim)
    {
        $this->claimsCashInTransit = $claim;
        return $this;
    }

    public function getSalvage()
    {
        return $this->salvage;
    }

    public function setSalvage($ser)
    {
        $this->salvage = $ser;
        return $this;
    }

    public function getAmountClaimed()
    {
        return $this->amountClaimed;
    }

    public function setAmountClaimed($claim)
    {
        $this->amountClaimed = $claim;
        return $this;
    }

    public function getClaimsHouseHolder()
    {
        return $this->claimsHouseHolder;
    }

    public function setClaimsHouseHolder($claims)
    {
        $this->claimsHouseHolder = $claims;
        return $this;
    }
    /**
     * @return object $claimsBuglary
     */
    public function getClaimsBuglary()
    {
        return $this->claimsBuglary;
    }

    /**
     * @return object $claimsFireLoss
     */
    public function getClaimsFireLoss()
    {
        return $this->claimsFireLoss;
    }

    /**
     * @return object $claimsGit
     */
    public function getClaimsGit()
    {
        return $this->claimsGit;
    }

    /**
     * @param \Claims\Entity\ClaimsBuglary $claimsBuglary
     */
    public function setClaimsBuglary($claimsBuglary)
    {
        $this->claimsBuglary = $claimsBuglary;
        return $this;
    }

    /**
     * @param \Claims\Entity\CLaimsFireLoss $claimsFireLoss
     */
    public function setClaimsFireLoss($claimsFireLoss)
    {
        $this->claimsFireLoss = $claimsFireLoss;
        return $this;
    }

    /**
     * @param \Claims\Entity\ClaimsGit $claimsGit
     */
    public function setClaimsGit($claimsGit)
    {
        $this->claimsGit = $claimsGit;
        return $this;
    }

}

