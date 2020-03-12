<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Proposal\Entity\Proposal;
use Messages\Entity\Messages;
use Comments\Entity\Comments;
use Settings\Entity\CoverCategory;
use Policy\Entity\PolicyFloat;
use Offer\Entity\Offer;

/**
 * @ORM\Entity
 * @ORM\Table(name="insure_portal");
 * 
 * @author otaba
 *        
 */
class InsurePortal
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="portal_uid", type="string", nullable=true)
     *
     * @var string
     */
    private $portalUid;

    /**
     * The is the insurance comany email
     * @ORM\Column(name="email", type="string", nullable=true)
     *
     * @var string
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\CoverCategory")
     *
     *
     * @var CoverCategory
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Proposal\Entity\Proposal", inversedBy="insurerPortal")
     *
     * @var Proposal
     */
    private $proposal;

    /**
     * @ORM\ManyToOne(targetEntity="Policy\Entity\PolicyFloat")
     *
     * @var PolicyFloat
     */
    private $float;

    /**
     * @ORM\ManyToOne(targetEntity="Offer\Entity\Offer")
     *
     * @var Offer
     */
    private $offer;

    /**
     * @ORM\OneToOne(targetEntity="Messages\Entity\Messages", mappedBy="portal")
     *
     * @var Messages
     */
    private $messages;

    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $createdOn;

    /**
     * @ORM\Column(name="updated_on", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedOn;

    /**
     * This inidicates if tte insurerr can stil access the portal
     * Also inidicates a finalization of the communication between insurer and broker
     *
     * @ORM\Column(name="is_final", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isFinal;
    
    /**
     * @ORM\OneToOne(targetEntity="Comments\Entity\Comments")
     * @var Comments
     */
    private $comment;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    /**
     *
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @param number $id            
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     *
     * @return string $portalUid
     */
    public function getPortalUid()
    {
        return $this->portalUid;
    }

    /**
     *
     * @param string $portalUid            
     */
    public function setPortalUid($portalUid)
    {
        $this->portalUid = $portalUid;
        return $this;
    }

    /**
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     *
     * @param string $email            
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     *
     * @return object $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     *
     * @param CoverCategory $type            
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     *
     * @return Proposal $proposal
     */
    public function getProposal()
    {
        return $this->proposal;
    }

    /**
     *
     * @param \Proposal\Entity\Proposal $proposal            
     */
    public function setProposal($proposal)
    {
        $this->proposal = $proposal;
        return $this;
    }

    /**
     *
     * @return PolicyFloat $float
     */
    public function getFloat()
    {
        return $this->float;
    }

    /**
     *
     * @param PolicyFloat $float            
     */
    public function setFloat($float)
    {
        $this->float = $float;
        return $this;
    }

    /**
     *
     * @return Offer $offer
     */
    public function getOffer()
    {
        return $this->offer;
    }

    /**
     *
     * @param Offer $offer            
     */
    public function setOffer($offer)
    {
        $this->offer = $offer;
        return $this;
    }

    /**
     *
     * @return Messages $messages
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     *
     * @param object $messages            
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;
        return $this;
    }

    /**
     *
     * @return \DateTime $createdOn
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     *
     * @param \DateTime $createdOn            
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
        return $this;
    }

    /**
     *
     * @return \DateTime $updatedOn
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    /**
     *
     * @param \DateTime $updatedOn            
     */
    public function setUpdatedOn($updatedOn)
    {
        $this->updatedOn = $updatedOn;
        return $this;
    }
    /**
     * @return boolean $isFinal
     */
    public function getIsFinal()
    {
        return $this->isFinal;
    }

    /**
     * @param boolean $isFinal
     */
    public function setIsFinal($isFinal)
    {
        $this->isFinal = $isFinal;
        return $this;
    }

}

