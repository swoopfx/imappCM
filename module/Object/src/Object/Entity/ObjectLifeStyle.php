<?php
namespace Object\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\LifeStyleCategory;

/**
 * @ORM\Entity
 * @ORM\Table(name="object_life_style")
 * 
 * @author otaba
 *        
 */
class ObjectLifeStyle
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\OneToOne(targetEntity="Object", inversedBy="objectLifeStyle")
     * @var Object
     */
    private $object;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\LifeStyleCategory")
     * 
     * @var LifeStyleCategory
     */
    private $lifeStyleCategory;

    private $categoryEducation;

    private $categoryInvestment;

    private $categoryHealth;

    private $categoryFashion;

    private $categoryRetirement;

    private $categoryMortgage;

    private $categoryCredit;

    private $categoryDeath;

    private $categoryOthers;

    public function __construct()
    
    {}

    public function getId()
    {
        return $this->id;
    }
    
    public function getObject(){
        return $this->object;
    }
    
    public function setObject($obj){
        $this->object = $obj;
        return $this;
    }

    public function getLifeStyleCategory()
    {
        return $this->lifeStyleCategory;
    }

    public function setLifeStyleCategory($life)
    {
        $this->lifeStyleCategory = $life;
        return $this;
    }
}

