<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="house_valuables")
 * 
 * @author otaba
 *        
 */
class HouseValuables
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", nullable=true)
     * 
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(name="cost", type="string", nullable=true)
     * 
     * @var string
     */
    private $cost;
    
    /**
     * @ORM\ManyToOne(targetEntity="IMServices\Entity\HomeInsurance", inversedBy="houseValueables")
     * @var HomeInsurance
     */
    private $homeInsurance;

    // private
    
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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function setCost($cost)
    {
        $this->cost = $cost;
        return $this;
    }
    /**
     * @return the $homeInsurance
     */
    public function getHomeInsurance()
    {
        return $this->homeInsurance;
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

