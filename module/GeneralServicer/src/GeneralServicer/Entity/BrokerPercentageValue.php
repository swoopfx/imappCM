<?php
namespace GeneralServicer\Entity;

use Doctrine\ORM\Mapping as ORM;
use Users\Entity\InsuranceBrokerRegistered;

/**
 * @ORM\Table(name="broker_pecentage_value")
 * @ORM\Entity
 *
 * @author swoopfx
 *         This handles all percentage value related to broking firm
 */
class BrokerPercentageValue
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered")
     * @ORM\JoinColumn(name="broker_id", referencedColumnName="id")
     * 
     * @var InsuranceBrokerRegistered
     */
    private $broker;

    /**
     * @ORM\Column(name="percentage_value", type="string", nullable=false, unique=true)
     * 
     * @var string At the front end the actual format would be invoked
     */
    private $percenageValue;

    public function __construct()
    {}

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

    public function getPercentageValue()
    {
        return $this->percenageValue;
    }

    public function setPercentageValue($value)
    {
        $this->percenageValue = $value;
        
        return $this;
    }
}

