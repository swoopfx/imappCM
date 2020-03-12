<?php
namespace IMServices\Entity;


use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="occupiers_liability_domestic_staff")
 * @author otaba
 *        
 */
class OccupiersLiabilityDomesticStaff
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="full_name", type="string", nullable=true)
     * @var string
     */
    private $fullName;
    
    /**
     * @ORM\Column(name="wages", type="string", nullable=true)
     * @var string
     */
    private $wages;
    
    /**
     * @ORM\Column(name="nature_of_work", type="string", nullable=true)
     * @var string
     */
    private $natureOfWork;
    
    /**
     * @ORM\Column(name="employment_duration", type="string", nullable=true)
     * @var string
     */
    private $employmentDuration;
    
    /**
     * @ORM\ManyToOne(targetEntity="OccupiersLiability", inversedBy="domesticStaff")
     * @var string
     */
    private $occupiersLiability;
    
    
    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function getId(){
        return $this->id;
    }
    /**
     * @return the $fullName
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @return the $wages
     */
    public function getWages()
    {
        return $this->wages;
    }

    /**
     * @return the $natureOfWork
     */
    public function getNatureOfWork()
    {
        return $this->natureOfWork;
    }

    /**
     * @return the $employmentDuration
     */
    public function getEmploymentDuration()
    {
        return $this->employmentDuration;
    }

    /**
     * @return the $occupiersLiability
     */
    public function getOccupiersLiability()
    {
        return $this->occupiersLiability;
    }

    /**
     * @param string $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
        return $this;
    }

    /**
     * @param string $wages
     */
    public function setWages($wages)
    {
        $this->wages = $wages;
        return $this;
    }

    /**
     * @param string $natureOfWork
     */
    public function setNatureOfWork($natureOfWork)
    {
        $this->natureOfWork = $natureOfWork;
        return $this;
    }

    /**
     * @param string $employmentDuration
     */
    public function setEmploymentDuration($employmentDuration)
    {
        $this->employmentDuration = $employmentDuration;
        return $this;
    }

    /**
     * @param string $occupiersLiability
     */
    public function setOccupiersLiability($occupiersLiability)
    {
        $this->occupiersLiability = $occupiersLiability;
        return $this;
    }

    
    
}

