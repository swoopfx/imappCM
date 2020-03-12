<?php
namespace SMS\Entity;

use Doctrine\ORM\Mapping as ORM;
use Users\Entity\InsuranceBrokerRegistered;

/**
 * @ORM\Entity
 * @ORM\Table(name="sms_account")
 *
 * @author otaba
 *        
 */
class SMSAccount
{

    /**
     *
     * @var integer This is only genertated upon successful transaction
     *      @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="credits", type="string", nullable=false)
     * 
     * @var string
     */
    private $availableCredit;

    /**
     * @ORM\OneToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered", inversedBy="smsBroker")
     * @ORM\JoinColumn(name="broker", referencedColumnName="id")
     *
     * @var InsuranceBrokerRegistered
     */
    private $broker;

    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     * 
     * @var unknown
     */
    private $createdOn;

    /**
     * @ORM\Column(name="alias", type="string", nullable=true)
     * 
     * @var unknown
     */
    private $alias;

    /**
     * @ORM\Column(name="updated_on", type="datetime", nullable=true)
     * 
     * @var unknown
     */
    private $updatedOn;

    /**
     */
    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getAvailableCredit()
    {
        return $this->availableCredit;
    }

    public function setAvailableCredit($avail)
    {
        $this->availableCredit = $avail;
        return $this;
    }

    public function getBroker()
    {
        return $this->broker;
    }

    public function setBroker($broker)
    {
        $this->broker = $broker;
        return $this;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function setCreatedOn($date)
    {
        $this->createdOn = $date;
        $this->updatedOn = $date;
        return $this;
    }

    public function getAlias()
    {
        return $this->alias;
    }

    public function setAlias($al)
    {
        $this->alias = $al;
        return $this;
    }

    public function setUpdatedOn($date)
    {
        $this->updatedOn = $date;
        return $this;
    }

    public function getUpdatedOn($date)
    {
        return $this->updatedOn;
    }
}

