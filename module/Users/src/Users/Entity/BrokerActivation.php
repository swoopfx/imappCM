<?php
namespace Users\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\ActivationType;

/**
 * @ORM\Entity
 * @ORM\Table(name="broker_activation")
 * 
 * @author otaba
 *        
 */
class BrokerActivation
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    
    /**
     * @ORM\OneToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered", inversedBy="brokerActivation")
     * @var InsuranceBrokerRegistered
     */
    private $broker;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\ActivationType")
     * @var ActivationType
     */
    private $activation;

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

    public function getBroker()
    {
        return $this->broker;
    }

    public function getActivation()
    {
        return $this->activation;
    }

    public function setBroker($broker)
    {
        $this->broker = $broker;
        return $this;
    }

    public function setActivation($act)
    {
        $this->activation = $act;
        return $this;
    }
}

