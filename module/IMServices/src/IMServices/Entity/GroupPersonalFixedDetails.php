<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="group_personal_fixed_details")
 * 
 * @author otaba
 *        
 */
class GroupPersonalFixedDetails
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="person_name", type="string", nullable=true)
     * 
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(name="dobsssss", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $dob;

    /**
     * @ORM\Column(name="occupation", type="string", nullable=true)
     * 
     * @var string
     */
    private $occupation;

    // Cover Details
    // Amount to be covered
    /**
     * This is amount to be covered for Total temporary disablement
     * @ORM\Column(name="temporary_disable_total", type="string", nullable=true)
     * 
     * @var string
     */
    private $temporaryDisablementTotal;

    /**
     * This is the amount to be covered for permanent disablement
     * @ORM\Column(name="permanent_disablement", type="string", nullable=true)
     * 
     * @var string
     */
    private $permanentDisablement;

    /**
     * @ORM\ManyToOne(targetEntity="GroupPeronalAccident", inversedBy="fixedDetails")
     * 
     * @var GroupPeronalAccident
     */
    private $groupPersonalAccident;

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

    public function getDob()
    {
        return $this->dob;
    }

    public function setDob($dob)
    {
        $this->dob = $dob;
        return $this;
    }

    public function setOccupation($occu)
    {
        $this->occupation = $occu;
        return $this;
    }

    public function getOccupation()
    {
        return $this->occupation;
    }

    public function getTemporaryDisablementTotal()
    {
        return $this->temporaryDisablementTotal;
    }

    public function setTemporaryDisablementTotal($temp)
    {
        $this->temporaryDisablementTotal = $temp;
        return $this;
    }

    // public function getTemporaryDisablementpartial(){
    // return $this->temporaryDisablementpartial;
    // }
    
    // public function setTemporaryDisablementpartial($part){
    // $this->temporaryDisablementpartial = $part;
    // return $this;
    // }
    public function getPermanentDisablement()
    {
        return $this->permanentDisablement;
    }

    public function setPermanentDisablement($part)
    {
        $this->permanentDisablement = $part;
        return $this;
    }

    /**
     *
     * @return the $groupPersonalAccident
     */
    public function getGroupPersonalAccident()
    {
        return $this->groupPersonalAccident;
    }

    /**
     *
     * @param \IMServices\Entity\GroupPeronalAccident $groupPersonalAccident            
     */
    public function setGroupPersonalAccident($groupPersonalAccident)
    {
        $this->groupPersonalAccident = $groupPersonalAccident;
        return $this;
    }
}

