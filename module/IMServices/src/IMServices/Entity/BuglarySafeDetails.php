<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="buglary_details")
 * 
 * @author otaba
 *        
 */
class BuglarySafeDetails
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="product_name", type="string", nullable=true)
     * 
     * @var string
     */
    private $productName;

    /**
     * @ORM\Column(name="maker", type="string", nullable=true)
     * 
     * @var string
     */
    private $maker;

    /**
     * @ORM\Column(name="model", type="string", nullable=true)
     * 
     * @var string
     *
     */
    private $model;

    /**
     * @ORM\Column(name="cost", type="string", nullable=true)
     * 
     * @var string
     */
    private $cost;

    /**
     * @ORM\Column(name="size", type="string", nullable=true)
     * 
     * @var string
     */
    private $size;

    // private
    
    /**
     * @ORM\ManyToOne(targetEntity="BuglaryHouseBreaking", inversedBy="safeDetails")
     * 
     * @var BuglaryHouseBreaking
     */
    private $buglary;

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
    }

    /**
     * @return the $productName
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;
        return $this;
    }

    /**
     * @return the $maker
     */
    public function getMaker()
    {
        return $this->maker;
    }

    /**
     * @param string $maker
     */
    public function setMaker($maker)
    {
        $this->maker = $maker;
        return $this;
    }

    /**
     * @return the $model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return the $cost
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param string $cost
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
        return $this;
    }

    /**
     * @return the $size
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param string $size
     */
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return the $buglary
     */
    public function getBuglary()
    {
        return $this->buglary;
    }

    /**
     * @param \IMServices\Entity\BuglaryHouseBreaking $buglary
     */
    public function setBuglary($buglary)
    {
        $this->buglary = $buglary;
        return $this;
    }

}

