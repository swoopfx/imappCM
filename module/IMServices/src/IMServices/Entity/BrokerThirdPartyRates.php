<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BrokerThirdPartyRates
 *
 * @ORM\Table(name="broker_third_party_rates", indexes={@ORM\Index(name="FK_broker_thrid_party_rates_idx", columns={"id_broker"}), @ORM\Index(name="FK_motor_broker_rates_idx", columns={"motor_cat"})})
 * @ORM\Entity
 */
class BrokerThirdPartyRates
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
     * @var string @ORM\Column(name="value", type="string", length=45, nullable=true)
     */
    private $value;

    /**
     *
     * @var \Users\Entity\InsuranceBrokerRegistered @ORM\ManyToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="id_broker", referencedColumnName="id")
     *      })
     */
    private $idBroker;

    /**
     *
     * @var \Settings\Entity\MotorType @ORM\ManyToOne(targetEntity="Settings\Entity\MotorType")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="motor_cat", referencedColumnName="id")
     *      })
     */
    private $motorCat;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set value
     *
     * @param string $value            
     *
     * @return BrokerThirdPartyRates
     */
    public function setValue($value)
    {
        $this->value = $value;
        
        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set idBroker
     *
     * @param \All\Entity\InsuranceBrokerRegistered $idBroker            
     *
     * @return BrokerThirdPartyRates
     */
    public function setIdBroker(\All\Entity\InsuranceBrokerRegistered $idBroker = null)
    {
        $this->idBroker = $idBroker;
        
        return $this;
    }

    /**
     * Get idBroker
     *
     * @return \All\Entity\InsuranceBrokerRegistered
     */
    public function getIdBroker()
    {
        return $this->idBroker;
    }

    /**
     * Set motorCat
     *
     * @param \All\Entity\MotorType $motorCat            
     *
     * @return BrokerThirdPartyRates
     */
    public function setMotorCat(\All\Entity\MotorType $motorCat = null)
    {
        $this->motorCat = $motorCat;
        
        return $this;
    }

    /**
     * Get motorCat
     *
     * @return \All\Entity\MotorType
     */
    public function getMotorCat()
    {
        return $this->motorCat;
    }
}
