<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BrokerThirdPartyValue
 *
 * @ORM\Table(name="broker_third_party_value")
 * @ORM\Entity
 */
class BrokerThirdPartyValue
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
     * @var string @ORM\Column(name="value", type="string", length=100, nullable=true)
     */
    private $value;

    /**
     *
     * @var \Users\Entity\InsuranceBrokerRegistered @ORM\ManyToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="broker_id", referencedColumnName="id")
     *      })
     */
    private $broker;

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
     * @return BrokerThirdPartyValue
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
     * Set broker
     *
     * @param \All\Entity\InsuranceBrokerRegistered $broker            
     *
     * @return BrokerThirdPartyValue
     */
    public function setBroker(\All\Entity\InsuranceBrokerRegistered $broker = null)
    {
        $this->broker = $broker;
        
        return $this;
    }

    /**
     * Get broker
     *
     * @return \All\Entity\InsuranceBrokerRegistered
     */
    public function getBroker()
    {
        return $this->broker;
    }
}
