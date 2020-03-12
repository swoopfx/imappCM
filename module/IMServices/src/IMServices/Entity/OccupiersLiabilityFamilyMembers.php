<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\Sex;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="occupiers_liability_family_members")
 * 
 * @author otaba
 *        
 */
class OccupiersLiabilityFamilyMembers
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="fullname", type="string", nullable=true)
     * 
     * @var string
     */
    private $fullNamef;

    /**
     * @ORM\Column(name="relationship", type="string", nullable=true)
     * 
     * @var string
     */
    private $relationship;

    /**
     * @ORM\Column(name="dob", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $dob;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Sex")
     * 
     * @var Sex
     */
    private $sex;

    /**
     * @ORM\ManyToOne(targetEntity="OccupiersLiability", inversedBy="familyMembers")
     * 
     * @var OccupiersLiability
     */
    private $occupiersLiability;

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

    public function getFullName()
    {
        return $this->fullName;
    }

    public function setFullName($set)
    {
        $this->fullName = $set;
        return $this;
    }

    public function getRelationship()
    {
        return $this->relationship;
    }

    public function setRelationship($set)
    {
        $this->relationship = $set;
        return $this;
    }

    /**
     *
     * @return the $dob
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     *
     * @return the $sex
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     *
     * @return the $occupiersLiability
     */
    public function getOccupiersLiability()
    {
        return $this->occupiersLiability;
    }

    /**
     *
     * @param DateTime $dob            
     */
    public function setDob($dob)
    {
        $this->dob = $dob;
        return $this;
    }

    /**
     *
     * @param \Settings\Entity\Sex $sex            
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
        return $this;
    }

    /**
     *
     * @param \IMServices\Entity\OccupiersLiability $occupiersLiability            
     */
    public function setOccupiersLiability($occupiersLiability)
    {
        $this->occupiersLiability = $occupiersLiability;
        return $this;
    }
    /**
     * @return the $fullNamef
     */
    public function getFullNamef()
    {
        return $this->fullNamef;
    }

    /**
     * @param string $fullNamef
     */
    public function setFullNamef($fullNamef)
    {
        $this->fullNamef = $fullNamef;
        return $this;
    }

}

