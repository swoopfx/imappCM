<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="life_policy_medical_list")
 * @author otaba
 *        
 */
class LifePolicyMedicalList
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     *  @ORM\Column(name="physician_name", type="string", nullable=true)
     * @var string
     */
    private $physicianName;
    
    /**
     * Consultation Reason
     * @ORM\Column(name="reason", type="text", nullable=true)
     * @var text
     */
    private $reason;
    
    /**
     * Date of treatment
     * @var \DateTime
     */
    private $treatmentDate;
    
    /**
     * @ORM\ManyToOne(targetEntity="LifePolicy", inversedBy="medicalConsultaionList")
     * @var LifePolicy
     */
    private $lifePolicy;
    
    
    /**
     */
    public function __construct()
    {
        
        
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
     * @return the $physicianName
     */
    public function getPhysicianName()
    {
        return $this->physicianName;
    }

    /**
     * @param string $physicianName
     */
    public function setPhysicianName($physicianName)
    {
        $this->physicianName = $physicianName;
        return $this;
    }

    /**
     * @return the $reason
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @param \IMServices\Entity\text $reason
     */
    public function setReason($reason)
    {
        $this->reason = $reason;
        return $this;
    }

    /**
     * @return the $treatmentDate
     */
    public function getTreatmentDate()
    {
        return $this->treatmentDate;
    }

    /**
     * @param DateTime $treatmentDate
     */
    public function setTreatmentDate($treatmentDate)
    {
        $this->treatmentDate = $treatmentDate;
        return $this;
    }

    /**
     * @return the $lifePolicy
     */
    public function getLifePolicy()
    {
        return $this->lifePolicy;
    }

    /**
     * @param \IMServices\Entity\LifePolicy $lifePolicy
     */
    public function setLifePolicy($lifePolicy)
    {
        $this->lifePolicy = $lifePolicy;
        return $this;
    }

}

