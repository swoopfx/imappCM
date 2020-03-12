<?php
namespace SMS\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="sms_broker")
 * 
 * @author swoopfx
 *        
 */
class SMSBroker
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
     * @ORM\OneToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered", inversedBy="smsBroker")
     * @ORM\JoinColumn(name="broker", referencedColumnName="id")
     * 
     * @var InsuranceBrokerRegistered
     */
    private $broker;

    /**
     * @ORM\OneToOne(targetEntity="SMS\Entity\SMSAccount", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="sms", referencedColumnName="id")
     * 
     * @var SMSAccount
     */
    private $sms;

    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    public function getId()
    {
        return $this->id;
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

    public function getSms()
    {
        return $this->sms;
    }

    public function setSms($sms)
    {
        $this->sms = $sms;
        return $this;
    }
}

