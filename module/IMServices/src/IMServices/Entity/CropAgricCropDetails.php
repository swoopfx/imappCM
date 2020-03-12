<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\Currency;

/**
 * @ORM\Entity
 * @ORM\Table(name="crop_agric_crop_details")
 *
 * @author otaba
 *        
 */
class CropAgricCropDetails
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Name of Crop
     * @ORM\Column(name="crop_name", type="string", nullable=true)
     *
     * @var string
     */
    private $cropTypeInsured;

    /**
     * @ORM\Column(name="cropsBiggestThreat", type="string", nullable=true)
     *
     * @var string
     */
    private $cropsBiggestThreat;

    /**
     * Variety of crop
     * @ORM\Column(name="variety", type="string", nullable=true)
     *
     * @var string
     */
    private $cropSeedVariety;

    /**
     * September to August (8 moinths)
     * @ORM\Column(name="vegetation_period", type="string", nullable=true)
     *
     * @var string
     */
    private $vegetationPeriod;

    /**
     * @ORM\Column(name="hectares", type="string", nullable=true)
     *
     * @var string
     */
    private $hectares;

    /**
     * @ORM\Column(name="no_of_plants_per_hectare", type="string", nullable=true)
     *
     * @var string
     */
    private $noOfPlantsPerHectare;

    /**
     * In metric tonnes
     * @ORM\Column(name="annual_production", type="string", nullable=true)
     *
     * @var string
     */
    private $annualProduction;

    /**
     * Value per metric tonne
     * @ORM\Column(name="crop_sales_value", type="string", nullable=true)
     *
     * @var string
     */
    private $cropSalesValue;

    /**
     * Required
     * @ORM\Column(name="sum_insured", type="string", nullable=true)
     *
     * @var string
     */
    private $sumInsured;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
     *
     * @var Currency
     */
    private $currency;

    /**
     * @ORM\ManyToOne(targetEntity="CropAgricInsurance")
     *
     * @var CropAgricInsurance
     */
    private $cropAgricInsurance;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    /**
     *
     * @return the $cropTypeInsured
     */
    public function getCropTypeInsured()
    {
        return $this->cropTypeInsured;
    }

    /**
     *
     * @param string $cropTypeInsured            
     */
    public function setCropTypeInsured($cropTypeInsured)
    {
        $this->cropTypeInsured = $cropTypeInsured;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $cropsBiggestThreat
     */
    public function getCropsBiggestThreat()
    {
        return $this->cropsBiggestThreat;
    }

    /**
     * @return the $cropSeedVariety
     */
    public function getCropSeedVariety()
    {
        return $this->cropSeedVariety;
    }

    /**
     * @param string $cropsBiggestThreat
     */
    public function setCropsBiggestThreat($cropsBiggestThreat)
    {
        $this->cropsBiggestThreat = $cropsBiggestThreat;
        return $this;
    }

    /**
     * @param string $cropSeedVariety
     */
    public function setCropSeedVariety($cropSeedVariety)
    {
        $this->cropSeedVariety = $cropSeedVariety;
        return $this;
    }

    // public function getCropName()
    // {
    // return $this->cropName;
    // }
    
    // public function setCropName($name)
    // {
    // $this->cropName = $name;
    // return $this;
    // }
//     public function getVariety()
//     {
//         return $this->variety;
//     }

//     public function setVariety($var)
//     {
//         $this->variety = $var;
//         return $this;
//     }

    public function getVegetationPeriod()
    {
        return $this->vegetationPeriod;
    }

    public function setVegetationPeriod($veg)
    {
        $this->vegetationPeriod = $veg;
        return $this;
    }

    public function getHectares()
    {
        return $this->hectares;
    }

    public function setHectares($hec)
    {
        $this->hectares = $hec;
        return $this;
    }

    public function getNoOfPlantsPerHectare()
    {
        return $this->noOfPlantsPerHectare;
    }

    public function setNoOfPlantsPerHectare($set)
    {
        $this->noOfPlantsPerHectare;
        return $this;
    }

    public function getAnnualProduction()
    {
        return $this->annualProduction;
    }

    public function setAnnualProduction($ann)
    {
        $this->annualProduction = $ann;
        return $this;
    }

    public function getCropSalesValue()
    {
        return $this->cropSalesValue;
    }

    public function setCropSalesValue($crop)
    {
        $this->cropSalesValue = $crop;
        return $this;
    }

    public function getSumInsured()
    {
        return $this->sumInsured;
    }

    public function setSumInsured($ins)
    {
        $this->sumInsured = $ins;
        return $this;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency($cur)
    {
        $this->currency = $cur;
        return $this;
    }

    public function getCropAgricInsurance()
    {
        return $this->cropAgricInsurance;
    }

    public function setCropAgricInsurance($crop)
    {
        $this->cropAgricInsurance = $crop;
        return $this;
    }
}

