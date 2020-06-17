<?php
namespace Object\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdditionalValue this defines an objects additional value
 *
 * @ORM\Table(name="additional_value")
 * @ORM\Entity
 */
class AdditionalValue
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
     * @var string @ORM\Column(name="name_val", type="string", length=100, nullable=true)
     */
    private $nameVal;

    /**
     *
     * @var string @ORM\Column(name="actual_value", type="decimal", precision=14, scale=2, nullable=true)
     */
    private $actualValue;

    /**
     *
     * @var \Object\Entity\Object @ORM\ManyToOne(targetEntity="Object\Entity\Object")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="object_id", referencedColumnName="id")
     *      })
     */
    private $object;

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
     * Set nameVal
     *
     * @param string $nameVal            
     *
     * @return AdditionalValue
     */
    public function setNameVal($nameVal)
    {
        $this->nameVal = $nameVal;
        
        return $this;
    }

    /**
     * Get nameVal
     *
     * @return string
     */
    public function getNameVal()
    {
        return $this->nameVal;
    }

    /**
     * Set actualValue
     *
     * @param string $actualValue            
     *
     * @return AdditionalValue
     */
    public function setActualValue($actualValue)
    {
        $this->actualValue = $actualValue;
        
        return $this;
    }

    /**
     * Get actualValue
     *
     * @return string
     */
    public function getActualValue()
    {
        return $this->actualValue;
    }

    /**
     * Set object
     *
     * @param \All\Entity\Object $object            
     *
     * @return AdditionalValue
     */
    public function setObject( $object = null)
    {
        $this->object = $object;
        
        return $this;
    }

    /**
     * Get object
     *
     * @return \All\Entity\Object
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Set offer
     *
     * @param \All\Entity\Offer $offer            
     *
     * @return AdditionalValue
     */
    public function setOffer(\Offer\Entity\Offer $offer = null)
    {
        $this->offer = $offer;
        
        return $this;
    }

    /**
     * Get offer
     *
     * @return \All\Entity\Offer
     */
    public function getOffer()
    {
        return $this->offer;
    }
}
