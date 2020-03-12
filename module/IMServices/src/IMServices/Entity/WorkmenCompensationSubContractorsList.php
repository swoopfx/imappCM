<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="workmen_compensation_sub_contractors_list")
 * 
 * @author otaba
 *        
 */
class WorkmenCompensationSubContractorsList
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="contractor_name", type="string", nullable=true)
     * 
     * @var string
     */
    private $contractorName;

    /**
     * @ORM\Column(name="nature_of_work", type="string", nullable=true)
     * 
     * @var string
     */
    private $natureOfWork;

    /**
     * @ORM\Column(name="is_labour_only", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isLabourOnly;

    /**
     * @ORM\Column(name="contract_amount", type="string", nullable=true)
     * 
     * @var string
     */
    private $contractAmount;

    /**
     * @ORM\ManyToOne(targetEntity="IMServices\Entity\WorkmenCompensation", inversedBy="subContractorsList")
     * 
     * @var WorkmenCompensation
     */
    private $workmenCopensation;

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
     * @return the $contractorName
     */
    public function getContractorName()
    {
        return $this->contractorName;
    }

    /**
     * @return the $natureOfWork
     */
    public function getNatureOfWork()
    {
        return $this->natureOfWork;
    }

    /**
     * @return the $isLabourOnly
     */
    public function getIsLabourOnly()
    {
        return $this->isLabourOnly;
    }

    /**
     * @return the $contractAmount
     */
    public function getContractAmount()
    {
        return $this->contractAmount;
    }

    /**
     * @return the $workmenCopensation
     */
    public function getWorkmenCopensation()
    {
        return $this->workmenCopensation;
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
     * @param string $contractorName
     */
    public function setContractorName($contractorName)
    {
        $this->contractorName = $contractorName;
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
     * @param boolean $isLabourOnly
     */
    public function setIsLabourOnly($isLabourOnly)
    {
        $this->isLabourOnly = $isLabourOnly;
        return $this;
    }

    /**
     * @param string $contractAmount
     */
    public function setContractAmount($contractAmount)
    {
        $this->contractAmount = $contractAmount;
        return $this;
    }

    /**
     * @param \IMServices\Entity\WorkmenCompensation $workmenCopensation
     */
    public function setWorkmenCopensation($workmenCopensation)
    {
        $this->workmenCopensation = $workmenCopensation;
        return $this;
    }

}

