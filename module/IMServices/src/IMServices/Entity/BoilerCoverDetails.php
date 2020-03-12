<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="boiler_cover_details")
 * 
 * @author otaba
 *        
 */
class BoilerCoverDetails
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="item_description", type="string", nullable=true)
     * 
     * @var string
     */
    private $itemDescription;

    /**
     * @ORM\Column(name="manufacture_year", type="string", nullable=true)
     * 
     * @var string
     */
    private $manuYear;

    /**
     * @ORM\Column(name="replacement_value", type="string", nullable=true)
     * 
     * @var string
     */
    private $replacementValue;

    /**
     * @ORM\ManyToOne(targetEntity="BoilersInsurance", inversedBy="coverList")
     * 
     * @var BoilersInsurance
     */
    private $boiler;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return the $itemDescription
     */
    public function getItemDescription()
    {
        return $this->itemDescription;
    }

    /**
     * @param string $itemDescription
     */
    public function setItemDescription($itemDescription)
    {
        $this->itemDescription = $itemDescription;
        return $this;
    }

    /**
     * @return the $manuYear
     */
    public function getManuYear()
    {
        return $this->manuYear;
    }

    /**
     * @param string $manuYear
     */
    public function setManuYear($manuYear)
    {
        $this->manuYear = $manuYear;
        return $this;
    }

    /**
     * @return the $replacementValue
     */
    public function getReplacementValue()
    {
        return $this->replacementValue;
    }

    /**
     * @param string $replacementValue
     */
    public function setReplacementValue($replacementValue)
    {
        $this->replacementValue = $replacementValue;
        return $this;
    }

    /**
     * @return the $boiler
     */
    public function getBoiler()
    {
        return $this->boiler;
    }

    /**
     * @param \IMServices\Entity\BoilersInsurance $boiler
     */
    public function setBoiler($boiler)
    {
        $this->boiler = $boiler;
        return $this;
    }

}

