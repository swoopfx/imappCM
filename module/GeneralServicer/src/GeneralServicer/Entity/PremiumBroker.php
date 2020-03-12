<?php
namespace GeneralServicer\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PremiumBroker
 *
 * @ORM\Table(name="premium_broker")
 * @ORM\Entity
 */
class PremiumBroker
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
     * @var \DateTime @ORM\Column(name="begin_date", type="datetime", nullable=true)
     */
    private $beginDate;

    /**
     *
     * @var \DateTime @ORM\Column(name="end_date", type="datetime", nullable=true)
     */
    private $endDate;

    /**
     *
     * @var \Users\Entity\InsuranceBrokerRegistered @ORM\ManyToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="broker_id", referencedColumnName="id")
     *      })
     */
    private $broker;
    
    // /**
    // * @var \All\Entity\AdvertPosition
    // *
    // * @ORM\ManyToOne(targetEntity="All\Entity\AdvertPosition")
    // * @ORM\JoinColumns({
    // * @ORM\JoinColumn(name="ad_position", referencedColumnName="id")
    // * })
    // */
    // private $adPosition;
    
    /**
     * Get idpremiumBroker
     *
     * @return integer
     */
    public function getIdpremiumBroker()
    {
        return $this->idpremiumBroker;
    }

    /**
     * Set beginDate
     *
     * @param \DateTime $beginDate            
     *
     * @return PremiumBroker
     */
    public function setBeginDate($beginDate)
    {
        $this->beginDate = $beginDate;
        
        return $this;
    }

    /**
     * Get beginDate
     *
     * @return \DateTime
     */
    public function getBeginDate()
    {
        return $this->beginDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate            
     *
     * @return PremiumBroker
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
        
        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set broker
     *
     * @param \All\Entity\InsuranceBrokerRegistered $broker            
     *
     * @return PremiumBroker
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

    /**
     * Set adPosition
     *
     * @param \All\Entity\AdvertPosition $adPosition            
     *
     * @return PremiumBroker
     */
    public function setAdPosition(\All\Entity\AdvertPosition $adPosition = null)
    {
        $this->adPosition = $adPosition;
        
        return $this;
    }

    /**
     * Get adPosition
     *
     * @return \All\Entity\AdvertPosition
     */
    public function getAdPosition()
    {
        return $this->adPosition;
    }
}
