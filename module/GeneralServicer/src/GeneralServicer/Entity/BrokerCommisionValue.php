<?php
namespace GeneralServicer\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BrokerCommisionValue
 *
 * @ORM\Table(name="broker_commision_value")
 * @ORM\Entity
 */
class BrokerCommisionValue
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
     * @var float @ORM\Column(name="value", type="float", precision=10, scale=0, nullable=false)
     */
    private $value;

    /**
     *
     * @var integer @ORM\Column(name="broker_id", type="integer", nullable=false)
     */
    private $brokerId;

    /**
     *
     * @var integer @ORM\Column(name="service_id", type="integer", nullable=false)
     */
    private $serviceId;

    /**
     *
     * @var \Doctrine\Common\Collections\Collection @ORM\ManyToMany(targetEntity="Settings\Entity\Insurer", inversedBy="commisionValue")
     *      @ORM\JoinTable(name="insurer_service_commision",
     *      joinColumns={
     *      @ORM\JoinColumn(name="commision_value_id", referencedColumnName="id")
     *      },
     *      inverseJoinColumns={
     *      @ORM\JoinColumn(name="insurer_id", referencedColumnName="id")
     *      }
     *      )
     */
    private $insurer;

    /**
     *
     * @var \DateTime @ORM\Column(name="created_on", type="datetime", nullable=true)
     */
    private $createdOn;

    /**
     *
     * @var \DateTime @ORM\Column(name="updated_on", type="datetime", nullable=true)
     */
    private $updatedOn;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->insurer = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @param float $value            
     *
     * @return BrokerCommisionValue
     */
    public function setValue($value)
    {
        $this->value = $value;
        
        return $this;
    }

    /**
     * Get value
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set brokerId
     *
     * @param integer $brokerId            
     *
     * @return BrokerCommisionValue
     */
    public function setBrokerId($brokerId)
    {
        $this->brokerId = $brokerId;
        
        return $this;
    }

    /**
     * Get brokerId
     *
     * @return integer
     */
    public function getBrokerId()
    {
        return $this->brokerId;
    }

    /**
     * Set serviceId
     *
     * @param integer $serviceId            
     *
     * @return BrokerCommisionValue
     */
    public function setServiceId($serviceId)
    {
        $this->serviceId = $serviceId;
        
        return $this;
    }

    /**
     * Get serviceId
     *
     * @return integer
     */
    public function getServiceId()
    {
        return $this->serviceId;
    }

    /**
     * Set type
     *
     * @param \Settings\Entity\CommisionType $type            
     *
     * @return BrokerCommisionValue
     */
    public function setType(\Settings\Entity\CommisionType $type = null)
    {
        $this->type = $type;
        
        return $this;
    }

    /**
     * Get type
     *
     * @return \Settings\Entity\CommisionType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add insurer
     *
     * @param \Settings\Entity\Insurer $insurer            
     *
     * @return BrokerCommisionValue
     */
    public function addInsurer(\Settings\Entity\Insurer $insurer)
    {
        $this->insurer[] = $insurer;
        
        return $this;
    }

    /**
     * Remove insurer
     *
     * @param \Settings\Entity\Insurer $insurer            
     */
    public function removeInsurer(\Settings\Entity\Insurer $insurer)
    {
        $this->insurer->removeElement($insurer);
    }

    /**
     * Get insurer
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInsurer()
    {
        return $this->insurer;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn            
     *
     * @return Offer
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
        
        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set updatedOn
     *
     * @param \DateTime $updatedOn            
     *
     * @return Offer
     */
    public function setUpdatedOn($updatedOn)
    {
        $this->updatedOn = $updatedOn;
        
        return $this;
    }

    /**
     * Get updatedOn
     *
     * @return \DateTime
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }
}
