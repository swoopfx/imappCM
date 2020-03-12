<?php
namespace Claims\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="claims_marine_cargo")
 * @author otaba
 *        
 */
class ClaimsMarineCargo
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
     * @ORM\Column(name="damage_extent", type="text", nullable=true)
     * @var string
     */
    private $damageExtent;

    /**
     *
     * @ORM\Column(name="place_of_loss", type="text", nullable=true)
     * @var string
     */
    private $placeOfLoss;

    /**
     *
     * @ORM\Column(name="is_thrid_party_involved", type="boolean", nullable=true)
     * @var boolean
     */
    private $isThirdPartyInvoved;

    /**
     *
     * @ORM\Column(name="third_party_involved", type="text", nullable=true)
     * @var string
     */
    private $thirdPartyinvolved;

    /**
     * Reason/Course for damage
     *
     * @ORM\Column(name="cause_of_damage", type="string", nullable=true)
     * @var string
     */
    private $causeOfDamage;

    /**
     *
     * @ORM\Column(name="date_of_loss", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $dateOfLoss;

    /**
     *
     * @ORM\Column(name="clearing_agent", type="text", nullable=true)
     * @var string
     */
    private $clearingAgent;

    /**
     *
     * @ORM\Column(name="loss_description", type="text", nullable=true)
     * @var string
     */
    private $lossDescription;

    /**
     *
     * @ORM\OneToOne(targetEntity="Claims\Entity\CLaims",  cascade={"persist", "remove"}, inversedBy="claimsMarineCargo")
     *
     * @var Claims;
     */
    private $claims;

    // TODO - Insert your code here
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
     * @return string
     */
    public function getDamageExtent()
    {
        return $this->damageExtent;
    }

    /**
     * @return string
     */
    public function getPlaceOfLoss()
    {
        return $this->placeOfLoss;
    }

    /**
     * @return boolean
     */
    public function getIsThirdPartyInvoved()
    {
        return $this->isThirdPartyInvoved;
    }

    /**
     * @return string
     */
    public function getThirdPartyinvolved()
    {
        return $this->thirdPartyinvolved;
    }

    /**
     * @return string
     */
    public function getCauseOfDamage()
    {
        return $this->causeOfDamage;
    }

    /**
     * @return \DateTime
     */
    public function getDateOfLoss()
    {
        return $this->dateOfLoss;
    }

    /**
     * @return string
     */
    public function getClearingAgent()
    {
        return $this->clearingAgent;
    }

    /**
     * @return string
     */
    public function getLossDescription()
    {
        return $this->lossDescription;
    }

    /**
     * @return \Claims\Entity\Claims;
     */
    public function getClaims()
    {
        return $this->claims;
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
     * @param string $damageExtent
     */
    public function setDamageExtent($damageExtent)
    {
        $this->damageExtent = $damageExtent;
        return $this;
    }

    /**
     * @param string $placeOfLoss
     */
    public function setPlaceOfLoss($placeOfLoss)
    {
        $this->placeOfLoss = $placeOfLoss;
        return $this;
    }

    /**
     * @param boolean $isThirdPartyInvoved
     */
    public function setIsThirdPartyInvoved($isThirdPartyInvoved)
    {
        $this->isThirdPartyInvoved = $isThirdPartyInvoved;
        return $this;
    }

    /**
     * @param string $thirdPartyinvolved
     */
    public function setThirdPartyinvolved($thirdPartyinvolved)
    {
        $this->thirdPartyinvolved = $thirdPartyinvolved;
        return $this;
    }

    /**
     * @param string $causeOfDamage
     */
    public function setCauseOfDamage($causeOfDamage)
    {
        $this->causeOfDamage = $causeOfDamage;
        return $this;
    }

    /**
     * @param \DateTime $dateOfLoss
     */
    public function setDateOfLoss($dateOfLoss)
    {
        $this->dateOfLoss = $dateOfLoss;
        return $this;
    }

    /**
     * @param string $clearingAgent
     */
    public function setClearingAgent($clearingAgent)
    {
        $this->clearingAgent = $clearingAgent;
        return $this;
    }

    /**
     * @param string $lossDescription
     */
    public function setLossDescription($lossDescription)
    {
        $this->lossDescription = $lossDescription;
        return $this;
    }

    /**
     * @param \Claims\Entity\Claims; $claims
     */
    public function setClaims($claims)
    {
        $this->claims = $claims;
        return $this;
    }

}

