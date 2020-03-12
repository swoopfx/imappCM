<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use IMServices\Entity\LiveStockFarmInsurance;
use Settings\Entity\Sex;

/** 
 * @ORM\Entity
 * @ORM\Table(name="live_stock_insured_list")
 * @author otaba
 * 
 */
class LivestockInsuredList
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="animalId", type="string", nullable=true)
     * @var string
     */
    private $animalId;
    
    /**
     * @ORM\Column(name="breed", type="string", nullable=true)
     * @var string
     */
    private $breed;
    
    /**
     * @ORM\Column(name="age", type="string", nullable=true)
     * @var string
     */
    private $age;
   
    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Sex")
     * @var Sex
     */
    private $sex;
    
    /**
     * The estimated market value of the ivestock
     * @ORM\Column(name="market_value", type="string", nullable=true)
     * @var string
     */
    private $marketValue;
    
    /**
     * @ORM\ManyToOne(targetEntity="LiveStockFarmInsurance", inversedBy="livestockInsuredList")
     * @var LiveStockFarmInsurance;
     */
    private $liveStockInsurance;
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
     * @return the $animalId
     */
    public function getAnimalId()
    {
        return $this->animalId;
    }

    /**
     * @return the $breed
     */
    public function getBreed()
    {
        return $this->breed;
    }

    /**
     * @return the $age
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @return the $sex
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @return the $marketValue
     */
    public function getMarketValue()
    {
        return $this->marketValue;
    }

    /**
     * @return the $liveStockInsurance
     */
    public function getLiveStockInsurance()
    {
        return $this->liveStockInsurance;
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
     * @param string $animalId
     */
    public function setAnimalId($animalId)
    {
        $this->animalId = $animalId;
        return $this;
    }

    /**
     * @param string $breed
     */
    public function setBreed($breed)
    {
        $this->breed = $breed;
        return $this;
    }

    /**
     * @param string $age
     */
    public function setAge($age)
    {
        $this->age = $age;
        return $this;
    }

    /**
     * @param Sex $sex
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
        return $this;
    }

    /**
     * @param string $marketValue
     */
    public function setMarketValue($marketValue)
    {
        $this->marketValue = $marketValue;
        return $this;
    }

    /**
     * @param LiveStockFarmInsurance; $liveStockInsurance
     */
    public function setLiveStockInsurance($liveStockInsurance)
    {
        $this->liveStockInsurance = $liveStockInsurance;
        return $this;
    }

}

