<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="live_stock_mortality_rate")
 * 
 * @author otaba
 *        
 */
class LiveStockMortaityRate
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="animal_group", type="string", nullable=true)
     * 
     * @var string
     */
    private $animalGroup;

    /**
     * @ORM\Column(name="mortality_rate", type="string", nullable=true)
     * 
     * @var string
     */
    private $mortalityRate;
    
//     /**
//      * @ORM\ManyToOne(targetEntity="LiveStockFarmInsurance", inversedBy="mortalityRate")
//      * @var LiveStockFarmInsurance
//      */
    private $livestockFarmInsurance;

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

    public function getAnimalGroup()
    {
        return $this->animalGroup;
    }

    public function setAnimalGroup($set)
    {
        $this->animalGroup = $set;
        return $this;
    }

    public function getMortalityRate()
    {
        return $this->mortalityRate;
    }

    public function setMortalityRate($set)
    {
        $this->mortalityRate = $set;
        return $this;
    }
    
    public function getLivestockFarmInsurance(){
        return $this->livestockFarmInsurance;
    }
    
    public function setLivestockFarmInsurance($set){
        $this->livestockFarmInsurance = $set;
        return $this;
    }
}

