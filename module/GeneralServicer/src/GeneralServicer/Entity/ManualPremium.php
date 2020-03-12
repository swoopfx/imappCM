<?php
namespace GeneralServicer\Entity;

use Doctrine\ORM\Mapping as ORM;
use Offer\Entity\Offer;
use Settings\Entity\Currency;
use Proposal\Entity\Proposal;

/**
 * @ORM\Entity
 * @ORM\Table(name="manual_premium")
 * 
 * @author otaba
 *        
 */
class ManualPremium
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="premium", type="string", nullable=false)
     * 
     * @var string
     */
    private $premium;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
     * 
     * @var Currency
     */
    private $currency;

    /**
     * @ORM\Column(name="description", type="text", nullable=false)
     * 
     * @var string
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity="Offer\Entity\Offer", inversedBy="manualPremium")
     * 
     * @var Offer
     */
    private $offer;

    /**
     * @ORM\OneToOne(targetEntity="Proposal\Entity\Proposal", inversedBy="manualPremium")
     * 
     * @var Proposal
     */
    private $proposal;

    // /**
    // * @ORM\OneToOne(targetEntity="Offer\Entity\Offer", inversedBy="manualPremium")
    // * @var Define
    // */
    // private $packages;
    
    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     * 
     * @var datetime
     */
    private $createdOn;

    /**
     * @ORM\Column(name="updated_on", type="datetime", nullable=true)
     * 
     * @var datetime
     */
    private $updatedOn;

    // TODO - Insert your code here
    
    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPremium()
    {
        return $this->premium;
    }

    public function setPremium($premium)
    {
        $this->premium = $premium;
        return $this;
    }

    public function setCurrency($cur)
    {
        $this->currency = $cur;
        return $this;
    }

    public function getCurrency()
    {
        return $this->currency;
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

    public function setOffer($offer)
    {
        $this->offer = $offer;
        return $this;
    }

    public function getOffer()
    {
        return $this->offer;
    }

    public function getProposal()
    {
        return $this->proposal;
    }

    public function setProposal($prop)
    {
        $this->proposal = $prop;
        return $this;
    }

    public function getPackages()
    {
        return $this->packages;
    }

    public function setPackages($pack)
    {
        $this->packages = $pack;
        return $this;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function setCreated($date)
    {
        $this->createdOn = $date;
        $this->updatedOn = $date;
        return $this;
    }

    public function setUpdatedOn($date)
    {
        $this->updatedOn = $date;
        return $this;
    }

    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }
}

