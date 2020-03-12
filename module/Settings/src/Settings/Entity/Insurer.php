<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;
use Policy\Entity\CoverNote;
use GeneralServicer\Entity\BrokerCommisionValue;

/**
 * Insurer
 *
 * @ORM\Table(name="insurer")
 * @ORM\Entity(repositoryClass="Settings\Entity\Repository\InsurerRepository")
 */
class Insurer
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     *
     * @var string @ORM\Column(name="rrc_code", type="string",  nullable=true)
     */
    private $rrcCode;

    /**
     *
     * @var string @ORM\Column(name="insurance_name", type="string", length=100, nullable=false)
     */
    private $insuranceName;

//     /**
//      *
//      * @var string @ORM\Column(name="insurance_acronym", type="string", length=6, nullable=true)
//      */
//     private $insuranceAcronym;
    
    
    /**
     *
     * @var string @ORM\Column(name="ceo", type="string",  nullable=true)
     */
    private $ceo ;
    
    
    /**
     *
     * @var string @ORM\Column(name="email", type="string",  nullable=true)
     */
    private $email;
    
    
    /**
     *
     * @var string @ORM\Column(name="address", type="text",  nullable=true)
     */
    private $address;
    
    
    /**
     *
     * @var string @ORM\Column(name="phone", type="string",  nullable=true)
     */
    private $phone;
    
    /**
     * @var InsuranceType
     * @ORM\ManyToOne(targetEntity="Settings\Entity\InsuranceType")
     * @ORM\JoinColumn(name="insurance_type", referencedColumnName="id")
     *
     * @var InsuranceType
     */
    private $insuranceType;
    
    /**
     *
     * @var string @ORM\Column(name="isActive", type="boolean",  nullable=true)
     */
    
    private $isActive;
    
    /**
     * @ORM\Column(name="logo", type="string", nullable=true)
     * @var string
     */
    private $logo;

//     /**
//      *
//      * @var \Doctrine\Common\Collections\Collection @ORM\ManyToMany(targetEntity="GeneralServicer\Entity\BrokerCommisionValue", mappedBy="insurer")
//      */
//     private $commisionValue;

//     /**
//      *
//      * @var \Doctrine\Common\Collections\Collection @ORM\ManyToMany(targetEntity="Policy\Entity\Policy", inversedBy="insurer")
//      *      @ORM\JoinTable(name="policy_insurer",
//      *      joinColumns={
//      *      @ORM\JoinColumn(name="insurer_id", referencedColumnName="id")
//      *      },
//      *      inverseJoinColumns={
//      *      @ORM\JoinColumn(name="policy_id", referencedColumnName="id")
//      *      }
//      *      )
//      */
//     private $policy;

    /**
     * @ORM\ManyToOne(targetEntity="Policy\Entity\CoverNote", inversedBy="insurer")
     * @ORM\JoinColumn(name="cover_note", referencedColumnName="id")
     * @var CoverNote
     */
    private $coverNote;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commisionValue = new \Doctrine\Common\Collections\ArrayCollection();
        $this->policy = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set insuranceName
     *
     * @param string $insuranceName            
     * @return Insurer
     */
    public function setInsuranceName($insuranceName)
    {
        $this->insuranceName = $insuranceName;
        
        return $this;
    }

    /**
     * Get insuranceName
     *
     * @return string
     */
    public function getInsuranceName()
    {
        return $this->insuranceName;
    }

    /**
     * Set insuranceAcronym
     *
     * @param string $insuranceAcronym            
     * @return Insurer
     */
    public function setInsuranceAcronym($insuranceAcronym)
    {
        $this->insuranceAcronym = $insuranceAcronym;
        
        return $this;
    }

    /**
     * Get insuranceAcronym
     *
     * @return string
     */
    public function getInsuranceAcronym()
    {
        return $this->insuranceAcronym;
    }
    
    public function getLogo(){
        return $this->logo;
    }
    
    public function setLogo($logo){
        $this->logo = $logo;
        return $this;
    }

    /**
     * Add commisionValue
     *
     * @param BrokerCommisionValue $commisionValue            
     * @return Insurer
     */
    public function addCommisionValue(\GeneralServicer\Entity\BrokerCommisionValue $commisionValue)
    {
        $this->commisionValue[] = $commisionValue;
        
        return $this;
    }

    /**
     * Remove commisionValue
     *
     * @param BrokerCommisionValue $commisionValue            
     */
    public function removeCommisionValue(\GeneralServicer\Entity\BrokerCommisionValue $commisionValue)
    {
        $this->commisionValue->removeElement($commisionValue);
    }

    /**
     * Get commisionValue
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommisionValue()
    {
        return $this->commisionValue;
    }

    /**
     * Add policy
     *
     * @param \Policy\Entity\Policy $policy            
     * @return Insurer
     */
    public function addPolicy(\Policy\Entity\Policy $policy)
    {
        $this->policy[] = $policy;
        
        return $this;
    }

    /**
     * Remove policy
     *
     * @param \Policy\Entity\Policy $policy            
     */
    public function removePolicy(\Policy\Entity\Policy $policy)
    {
        $this->policy->removeElement($policy);
    }

    /**
     * Get policy
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPolicy()
    {
        return $this->policy;
    }
    public function getCoverNote(){
        return $this->coverNote;
    }
    public function setCoverNote($cover){
        $this->coverNote = $cover;
        return $this;
    }
}
