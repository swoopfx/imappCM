<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\GroupLifeMemberClass;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="group_life")
 *
 * @author otaba
 *        
 */
class GroupLife
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="is_custom_package", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isCustomPackage;

    /**
     * This is a specific package based on insurance company
     * @ORM\Column(name="package_type", type="string", nullable=true)
     *
     * @var string
     */
    private $packagetType;

    /**
     * @ORM\OneToMany(targetEntity="GroupLifeEmployeeList", mappedBy="groupLife" )
     * 
     * @var Collection
     */
    private $groupLifeEmployeeList;

    /**
     * Member Class of the group
     * @ORM\ManyToOne(targetEntity="Settings\Entity\GroupLifeMemberClass")
     *
     * @var GroupLifeMemberClass
     */
    private $memberClass;

    /**
     * @ORM\Column(name="other_class", type="string", nullable=true)
     * 
     * @var string
     */
    private $otherClass;

    /**
     * @ORM\Column(name="start_date", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $startDate;

    /**
     * @ORM\Column(name="retirement_age", type="string", nullable=true)
     *
     * @var string
     */
    private $retirementAge;

    /**
     * @ORM\Column(name="is_previous_insurer", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPreviousinsurer;

    /**
     * @ORM\Column(name="is_previous_claims", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPreviousClaims;

    /**
     * Details about the claims
     * @ORM\Column(name="previous_claims", type="string", nullable=true)
     * 
     * @var text
     */
    private $previousClaims;

    // private
    
    /**
     */
    public function __construct()
    {
        $this->groupLifeEmployeeList = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMemberClass()
    {
        return $this->memberClass;
    }

    public function getOtherClass()
    {
        return $this->otherClass;
    }

    public function setOtherClass($class)
    {
        $this->otherClass = $class;
        return $this;
    }

    public function setMemberClass($class)
    {
        $this->memberClass = $class;
        return $this;
    }

//     public function getAnnualEmolument()
//     {
//         return $this->annualEmolument;
//     }

//     public function setAnnualEmolument($net)
//     {
//         $this->annualEmolument = $net;
//         return $this;
//     }

//     public function getLifeAssuranceBenefit()
//     {
//         return $this->lifeAssuranceBenefit;
//     }

//     public function setLifeAssuranceBenefit($life)
//     {
//         $this->lifeAssuranceBenefit = $life;
//         return $this;
//     }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate($date)
    {
        $this->startDate = $date;
        return $this;
    }

    // public function getEndDate()
    // {
    // return $this->endDate;
    // }
    
    // public function setEndDate($date)
    // {
    // $this->endDate = $date;
    // return $this;
    // }
    public function getRetirementAge()
    {
        return $this->retirementAge;
    }

    public function setRetirementAge($age)
    {
        $this->retirementAge = $age;
        return $this;
    }

//     public function getBeneficiary()
//     {
//         return $this->beneficiary;
//     }

    public function getPreviousClaims()
    {
        return $this->previousClaims;
    }

    // public function addPreviousClaims($claims)
    // {
    // if (! $this->previousClaims->contains($claims)) {
    // $this->previousClaims->add($claims);
    // }
    // return $this;
    // }
    
    // public function removePreviousClaims($claims)
    // {
    // if ($this->previousClaims->contains($claims)) {
    // $this->previousClaims->removeElement($claims);
    // }
    // return $this;
    // }
    
    // public function addBeneficiary($ben)
    // {
    // if (! $this->beneficiary->contains($ben)) {
    // $this->beneficiary->add($ben);
    // }
    // return $this;
    // }
    
    // public function removeBeneficiary($ben)
    // {
    // if ($this->beneficiary->contains($ben)) {
    // $this->beneficiary->removeElement($ben);
    // }
    // return $this;
    // }
    
    /**
     *
     * @return the $packagetType
     */
    public function getPackagetType()
    {
        return $this->packagetType;
    }

    /**
     *
     * @param string $packagetType            
     */
    public function setPackagetType($packagetType)
    {
        $this->packagetType = $packagetType;
        return $this;
    }

    /**
     *
     * @return the $isPreviousinsurer
     */
    public function getIsPreviousinsurer()
    {
        return $this->isPreviousinsurer;
    }

    /**
     *
     * @param boolean $isPreviousinsurer            
     */
    public function setIsPreviousinsurer($isPreviousinsurer)
    {
        $this->isPreviousinsurer = $isPreviousinsurer;
        return $this;
    }

    /**
     *
     * @return the $isPreviousClaims
     */
    public function getIsPreviousClaims()
    {
        return $this->isPreviousClaims;
    }

    /**
     *
     * @param boolean $isPreviousClaims            
     */
    public function setIsPreviousClaims($isPreviousClaims)
    {
        $this->isPreviousClaims = $isPreviousClaims;
        return $this;
    }

    /**
     *
     * @return the $isCustomPackage
     */
    public function getIsCustomPackage()
    {
        return $this->isCustomPackage;
    }

    /**
     *
     * @param boolean $isCustomPackage            
     */
    public function setIsCustomPackage($isCustomPackage)
    {
        $this->isCustomPackage = $isCustomPackage;
        return $this;
    }

    /**
     *
     * @return the $groupLifeEmployeeList
     */
    public function getGroupLifeEmployeeList()
    {
        return $this->groupLifeEmployeeList;
    }

    /**
     *
     * @param \Doctrine\Common\Collections\Collection $groupLifeEmployeeList            
     */
    public function setGroupLifeEmployeeList($groupLifeEmployeeList)
    {
        $this->groupLifeEmployeeList = $groupLifeEmployeeList;
        return $this;
    }

    public function addGroupLifeEmployeeList($groupLifeEmployeeList)
    {
        if (! $this->groupLifeEmployeeList->contains($groupLifeEmployeeList)) {
            $this->groupLifeEmployeeList[] = $groupLifeEmployeeList;
        }
        return $this;
    }

    public function removeGroupLifeEmployeeList($groupLifeEmployeeList)
    {
        if ($this->groupLifeEmployeeList->contains($groupLifeEmployeeList)) {
            $this->groupLifeEmployeeList->removeElement($groupLifeEmployeeList);
        }
        return $this;
    }
    /**
     * @param \IMServices\Entity\text $previousClaims
     */
    public function setPreviousClaims($previousClaims)
    {
        $this->previousClaims = $previousClaims;
        return $this;
    }

}

