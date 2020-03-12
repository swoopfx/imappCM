<?php
namespace Object\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\OccupationalCategory;
/**
 * @ORM\Entity
 * @ORM\Table(name="object_life_profession")
 * @author otaba
 *
 */

class ObjectLifeProfession
{
    
    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="ObjectLife")
     * 
     * @var ObjectLife
     */
    private $objectLife;
    
    /**
     *
     * @ORM\Column(name="is_self_employed", type="boolean", nullable=true)
     * @var boolean
     */
    private $isSelfEmployed;
    
    /**
     *
     * @ORM\Column(name="job_title", type="string", nullable=true)
     * @var string
     */
    private $jobTitle;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Settings\Entity\OccupationalCategory")
     * @var OccupationalCategory
     *
     */
    private $occupationCategory;
    
    /**
     *
     * @ORM\Column(name="occupation", type="string", nullable=true)
     * @var string
     */
    private $occupation;
    
    /**
     * This os the total annual income of the person
     * His total yearly renumeration
     *
     * @ORM\Column(name="annual_income", type="string", nullable=true)
     * @var string
     */
    private $annualIncome;
    
    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $createdOn;
    
    /**
     * @ORM\Column(name="updated_on", type="datetime", nullable=true)
     * 
     * 
     * @var \DateTime
     */
    private $updateOn;
    

    // TODO - Insert your code here
    public function __construct()
    {

        // TODO - Insert your code here
    }
    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \Object\Entity\ObjectLife
     */
    public function getObjectLife()
    {
        return $this->objectLife;
    }

    /**
     * @return boolean
     */
    public function getIsSelfEmployed()
    {
        return $this->isSelfEmployed;
    }

    /**
     * @return \Settings\Entity\OccupationalCategory
     */
    public function getOccupationCategory()
    {
        return $this->occupationCategory;
    }

    /**
     * @return string
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * @return string
     */
    public function getAnnualIncome()
    {
        return $this->annualIncome;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * @return \DateTime
     */
    public function getUpdateOn()
    {
        return $this->updateOn;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param \Object\Entity\ObjectLife $objectLife
     */
    public function setObjectLife($objectLife)
    {
        $this->objectLife = $objectLife;
        return $this;
    }

    /**
     * @param boolean $isSelfEmployed
     */
    public function setIsSelfEmployed($isSelfEmployed)
    {
        $this->isSelfEmployed = $isSelfEmployed;
        return $this;
    }

    /**
     * @param \Settings\Entity\OccupationalCategory $occupationCategory
     */
    public function setOccupationCategory($occupationCategory)
    {
        $this->occupationCategory = $occupationCategory;
        return $this;
    }

    /**
     * @param string $occupation
     */
    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;
        return $this;
    }

    /**
     * @param string $annualIncome
     */
    public function setAnnualIncome($annualIncome)
    {
        $this->annualIncome = $annualIncome;
        return $this;
    }

    /**
     * @param \DateTime $createdOn
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
        return $this;
    }

    /**
     * @param \DateTime $updateOn
     */
    public function setUpdateOn($updateOn)
    {
        $this->updateOn = $updateOn;
        return $this;
    }
    /**
     * @return string
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * @param string $jobTitle
     */
    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;
        return $this;
    }


}

