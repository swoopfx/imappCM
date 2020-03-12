<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\PerformanceBondAssetType;

/**
 * @ORM\Entity
 * @ORM\Table(name="performance_bond_asset")
 * 
 * @author otaba
 *        
 */
class PerformanceBondAsset
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\PerformanceBondAssetType")
     * 
     * @var PerformanceBondAssetType
     */
    private $assetType;

    /**
     * @ORM\Column(name="asset_other_define", type="string", nullable=true)
     * 
     * @var string
     */
    private $assetOtherDefine;

    /**
     * @ORM\Column(name="asset_name", type="string", nullable=true)
     * 
     * @var string
     */
    private $assetName;

    /**
     * @ORM\Column(name="asset_value", type="string", nullable=true)
     * 
     * @var string
     */
    private $assetValue;
    
    /**
     * @ORM\ManyToOne(targetEntity="PerformanceBond", inversedBy="performanceBondAsset")
     * @var PerformanceBond
     */
    private $performancebond;

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
    /**
     * @return the $assetType
     */
    public function getAssetType()
    {
        return $this->assetType;
    }

    /**
     * @return the $assetOtherDefine
     */
    public function getAssetOtherDefine()
    {
        return $this->assetOtherDefine;
    }

    /**
     * @return the $assetName
     */
    public function getAssetName()
    {
        return $this->assetName;
    }

    /**
     * @return the $assetValue
     */
    public function getAssetValue()
    {
        return $this->assetValue;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param \Settings\Entity\PerformanceBondAssetType $assetType
     */
    public function setAssetType($assetType)
    {
        $this->assetType = $assetType;
        return $this;
    }

    /**
     * @param string $assetOtherDefine
     */
    public function setAssetOtherDefine($assetOtherDefine)
    {
        $this->assetOtherDefine = $assetOtherDefine;
        return $this;
    }

    /**
     * @param string $assetName
     */
    public function setAssetName($assetName)
    {
        $this->assetName = $assetName;
        return $this;
    }

    /**
     * @param string $assetValue
     */
    public function setAssetValue($assetValue)
    {
        $this->assetValue = $assetValue;
        return $this;
    }

}

