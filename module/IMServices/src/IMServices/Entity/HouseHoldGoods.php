<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="house_hold_goods")
 * 
 * @author otaba
 *        
 */
class HouseHoldGoods
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="goods_name", type="string", nullable=true)
     * 
     * @var string
     */
    private $goodsName;

    /**
     * @ORM\Column(name="value", type="string", nullable=true)
     * 
     * @var string
     */
    private $value;

    /**
     * @ORM\Column(name="serial_number", type="string", nullable=true)
     * 
     * @var string
     */
    private $serialNumber;
    
    /**
     * @ORM\ManyToOne(targetEntity="IMServices\Entity\HomeInsurance", inversedBy="houseHoldGoods")
     * @var HomeInsurance
     */
    private $homeInsurance;

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

    public function getGoodsName()
    {
        return $this->goodsName;
    }

    public function setGoodsName($name)
    {
        $this->goodsName = $name;
        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($val)
    {
        $this->value = $val;
        return $this;
    }

   

   
    /**
     * @return the $serialNumber
     */
    public function getSerialNumber()
    {
        return $this->serialNumber;
    }

    /**
     * @return the $homeInsurance
     */
    public function getHomeInsurance()
    {
        return $this->homeInsurance;
        
    }

    /**
     * @param string $serialNumber
     */
    public function setSerialNumber($serialNumber)
    {
        $this->serialNumber = $serialNumber;
        return $this;
    }

    /**
     * @param \IMServices\Entity\HomeInsurance $homeInsurance
     */
    public function setHomeInsurance($homeInsurance)
    {
        $this->homeInsurance = $homeInsurance;
        return $this;
    }

}



