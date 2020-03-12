<?php
namespace Object\Entity;

use Doctrine\ORM\Mapping as ORM;
use Users\Entity\InsuranceBrokerRegistered;

/**
 * @ORM\Entity
 * @ORM\Table(name="object_broker")
 * 
 * @author swoopfx
 *        
 */
class ObjectBroker
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
     * @ORM\JoinColumn(name="broker", referencedColumnName="id")
     * 
     * @var InsuranceBrokerRegistered
     */
    private $broker;

    /**
     * @ORM\OneToOne(targetEntity="Object\Entity\Object", inversedBy="objectBroker")
     * @ORM\JoinColumn(name="object", referencedColumnName="id")
     * 
     * @var Object
     */
    private $object;

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

    public function getObject()
    {
        return $this->object;
    }

    public function setObject($object)
    {
        $this->object = $object;
        return $this;
    }
}

