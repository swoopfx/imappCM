<?php
namespace All\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InsuranceRate
 *
 * @ORM\Table(name="insurance_rate", indexes={@ORM\Index(name="FK_insurance_rate_type_id_idx", columns={"type_id"})})
 * @ORM\Entity
 */
class InsuranceRate
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
     * @var integer @ORM\Column(name="service_id", type="integer", nullable=true)
     */
    private $serviceId;

    /**
     *
     * @var string @ORM\Column(name="rate_value", type="decimal", precision=15, scale=4, nullable=true)
     */
    private $rateValue;

    /**
     *
     * @var \All\Entity\CommisionType @ORM\ManyToOne(targetEntity="All\Entity\CommisionType")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     *      })
     */
    private $type;

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
     * Set serviceId
     *
     * @param integer $serviceId            
     *
     * @return InsuranceRate
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
     * Set rateValue
     *
     * @param string $rateValue            
     *
     * @return InsuranceRate
     */
    public function setRateValue($rateValue)
    {
        $this->rateValue = $rateValue;
        
        return $this;
    }

    /**
     * Get rateValue
     *
     * @return string
     */
    public function getRateValue()
    {
        return $this->rateValue;
    }

    /**
     * Set type
     *
     * @param \All\Entity\CommisionType $type            
     *
     * @return InsuranceRate
     */
    public function setType( $type = null)
    {
        $this->type = $type;
        
        return $this;
    }

    /**
     * Get type
     *
     * @return \All\Entity\CommisionType
     */
    public function getType()
    {
        return $this->type;
    }
}
