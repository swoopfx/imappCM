<?php
namespace Comments\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\CommentCategory;
use Users\Entity\InsuranceBrokerRegistered;
use Customer\Entity\Customer;
use Settings\Entity\Commentor;
use Claims\Entity\CLaims;
use CsnUser\Entity\User;

// use Settings\Entity\CoverCategory;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="comments")
 *
 * @author swoopfx
 *        
 */
class Comments
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="CsnUser\Entity\User")
     * @var User
     */
    private $commentor;

    /**
     *
     * @ORM\Column(name="topic", type="string", nullable=true)
     * @var string
     */
    private $topic;

    /**
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     *
     * @var string
     */
    private $comment;

    /**
     * This defines if the comment is for a claims, offer , proposal, policy, portal
     *
     * @ORM\ManyToOne(targetEntity="Settings\Entity\CommentCategory")
     * @ORM\JoinColumn(name="comment_category", referencedColumnName="id")
     *
     * @var CommentCategory
     */
    private $commentCategory;

    /**
     *
     * @ORM\Column(name="comment_uid", type="string", nullable=true)
     * @var string
     */
    private $commmentUid;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered")
     * @ORM\JoinColumn(name="broker", referencedColumnName="id")
     *
     * @var InsuranceBrokerRegistered
     */
    private $broker;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Customer\Entity\Customer")
     * @ORM\JoinColumn(name="customer", referencedColumnName="id")
     *
     * @var Customer
     */
    private $customer;

    /**
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $createdOn;

    /**
     *
     * @ORM\Column(name="updated_on", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedOn;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Claims\Entity\CLaims", inversedBy="comments")
     * @var CLaims
     */
    private $claims;
    
    /**
     * @ORM\Column(name="is_read", type="boolean", nullable=false, options={"default" : 0})
     * @var boolean
     */
    private $isRead;

    public function __construct()
    {
        // $this->commentProposal = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($com)
    {
        $this->comment = $com;
        return $this;
    }

    public function getCommentCategory()
    {
        return $this->comment;
    }

    public function setCommentCategory($cat)
    {
        $this->commentCategory = $cat;
        return $this;
    }

    public function getBroker()
    {
        return $this->broker;
    }

    public function setBroker($br)
    {
        $this->broker = $br;
        return $this;
    }

    public function getCustomer()
    {
        return $this->broker;
    }

    public function setCustomer($cus)
    {
        $this->customer = $cus;
        return $this;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function setCreatedOn($date)
    {
        $this->createdOn = $date;
        $this->modifiedOn = $date;
        return $this;
    }

    public function getModifiedOn()
    {
        return $this->modifiedOn;
    }

    public function setModifiedOn($date)
    {
        $this->modifiedOn = $date;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getCommmentUid()
    {
        return $this->commmentUid;
    }

    /**
     *
     * @return \DateTime
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    /**
     *
     * @return \Claims\Entity\CLaims
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
     * @param string $commmentUid
     */
    public function setCommmentUid($commmentUid)
    {
        $this->commmentUid = $commmentUid;
        return $this;
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
     *
     * @param \Claims\Entity\CLaims $claims
     */
    public function setClaims($claims)
    {
        $this->claims = $claims;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     *
     * @param string $topic
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;
        return $this;
    }
    /**
     * @return \CsnUser\Entity\User
     */
    public function getCommentor()
    {
        return $this->commentor;
    }

    /**
     * @param \CsnUser\Entity\User $commentor
     */
    public function setCommentor($commentor)
    {
        $this->commentor = $commentor;
        return $this;
    }
    /**
     * @return boolean
     */
    public function getIsRead()
    {
        return $this->isRead;
    }

    /**
     * @param boolean $isRead
     */
    public function setIsRead($isRead)
    {
        $this->isRead = $isRead;
        return $this;
    }


}

