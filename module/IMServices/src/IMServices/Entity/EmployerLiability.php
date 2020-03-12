<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Settings\Entity\EmploerLiabilitySpecialWOrk;
use Settings\Entity\Insurer;

/**
 * @ORM\Entity
 * @ORM\Table(name="employer_liability")
 *
 * @author otaba
 *        
 */
class EmployerLiability
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    

//     /**
//      * This is the occupationdefineed
//      * @ORM\Column(name="profession", type="string", nullable=true)
//      * 
//      * @var string
//      */
//     private $profession;
    
    /**
     * This decribes the profession 
     * @ORM\Column(name="descsss", type="text", nullable=true)
     * @var text
     */
    private $desc;

    /**
     * @ORM\Column(name="is_taken_in_other_countries", type="boolean", nullable=true)
     * @var boolean
     */
    private $isTakenInOtherCountries;
    
    /**
     * Details of work done in other country 
     * @ORM\Column(name="other_country_details", type="text", nullable=true)
     * @var text
     */
    private $otherCountryDetails;

    /**
     * Signifies if the premises abides with the statute of a safety work place
     * @ORM\Column(name="is_premise_lawful", type="boolean", nullable=true)
     * @var boolean
     */
    private $isPremiseLawful;

    /**
     * 
     * @ORM\Column(name="cover_from_date", type="datetime", nullable=true)
     *
     * @var datetime
     */
    private $coverFromDate;

    /**
     * @ORM\Column(name="cover_to_date", type="datetime", nullable=true)
     *
     * @var datetime
     */
    private $coverToDate;

    /**
     * @ORM\OneToMany(targetEntity="IMServices\Entity\EmployerLiabilityDetails", mappedBy="employerLiability")
     * 
     * @var Collection
     */
    private $employeeDetails;

    /**
     * @ORM\Column(name="is_Laws_n_regulation", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isLawsNRegulation;

    /**
     * @ORM\Column(name="laws_n_regulation", type="text", nullable=true)
     *
     * @var text
     */
    private $lawsNRegulation;

    /**
     * Have you any circular saws or other machinery driven by steam, gas, water, electricity or other mechanical power?
     * @ORM\Column(name="is_saw_n_machine", type="boolean", nullable=true)
     *
     * @var boolean
     *
     */
    private $isSawNMachine;

    /**
     * Give details of the saw and machine
     * @ORM\Column(name="saw_n_machine", type="text", nullable=true)
     *
     * @var text
     */
    private $sawNMachine;

    /**
     * @ORM\Column(name="is_boilers_n_pressure_lift", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isBoilersNpressureLifts;

    /**
     * This defines if work is radioactive, acids gasess and chemicals
     * @ORM\ManyToOne(targetEntity="Settings\Entity\EmploerLiabilitySpecialWOrk")
     *
     * @var EmploerLiabilitySpecialWOrk
     */
    private $specialWork;

    /**
     * @ORM\Column(name="is_law_abiding", type="boolean", nullable=true)
     *
     * @var boolean
     *
     */
    private $isLawAbiding;

    /**
     * @ORM\Column(name="is_fence_properly", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isFencedProperly;

    /**
     *
     * Have you any boilers or other pressurevessels/lifts/hoists/cranes?
     * @ORM\Column(name="is_boilers", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isBoilers;

    /**
     * DEfines if copany produces radioactive products or work with them
     * 
     * @var boolean
     */
    private $isRadioActiveProducts;

    /**
     * identifies if company produces and or uses acidic gases
     * 
     * @var boolean
     */
    private $isAcidAndGasses;

    /**
     * This company produces asbestoes or silca based materials
     * 
     * @var boolean
     */
    private $isAbestos;

    /**
     * @ORM\Column(name="is_previous_insure", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isPreviousInsure;

    /**
     * This provides information about previous insurere and state of policy if declined
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Insurer")
     *
     * @var Insurer
     */
    private $previousInsure;

   /**
    * These are measure taken to avert the successive loss
    * @ORM\Column(name="previous_claims", type="text", nullable=true)
    * @var text
    */
    private $previousClaims;
    
//     /**
//      * @ORM\Column(name="is_declaration", type="boolean", nullable=true)
//      * @var boolean
//      */
//     private $isDeclaration;

    /**
     */
    public function __construct()
    {
        $this->employeeDetails = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function getProfession(){
        return $this->profession;
    }
    
    public function getDesc(){
        return $this->desc;
        
    }
    
    public function setDesc($desc){
        $this->desc = $desc;
        return $this;
    }
    
    public  function  getIsTakenInOtherCountries(){
        return $this->isTakenInOtherCountries;
    }
    
    public function setIsTakenInOtherCountries($set){
        $this->isTakenInOtherCountries = $set;
        return $this;
    }
    
    
    public function setProfession($prof){
        $this->profession = $prof;
        return $this;
    }
    
    public function getOtherCountryDetails(){
        return $this->otherCountryDetails;
    }
    
    public function setOtherCountryDetails($det){
        $this->otherCountryDetails = $det;
        return $this;
    }

    public function getCoverFromDate()
    {
        return $this->coverFromDate;
    }

    public function setCoverFromDate($date)
    {
        $this->coverFromDate = $date;
        return $this;
    }

    public function getCoverToDate()
    {
        return $this->coverToDate;
    }

    public function setCoverToDate($date)
    {
        $this->coverToDate = $date;
        return $this;
    }

    public function getEmployeeDetails()
    {
        return $this->employeeDetails;
    }

    /**
     *
     * @param EmployerLiabilityDetails $emp            
     * @return \IMServices\Entity\EmployerLiability
     */
    public function addEmployeeDetails($emp)
    {
        if (! $this->employeeDetails->contains($emp)) {
            $this->employeeDetails->add($emp);
            $emp->setEmployerLiability($this);
        }
        
        return $this;
    }

    /**
     *
     * @param EmployerLiabilityDetails $emp            
     * @return \IMServices\Entity\EmployerLiability
     */
    public function removeEmployeeDetails($emp)
    {
        if ($this->employeeDetails->contains($emp)) {
            $this->employeeDetails->removeElement($emp);
            $emp->setEmployerLiability(NULL);
        }
        
        return $this;
    }

    public function getIsLawsNRegulation()
    {
        return $this->isLawsNRegulation;
    }

    public function setIsLawsNRegulation($set)
    {
        $this->isLawsNRegulation = $set;
        return $this;
    }

    public function getLawsNRegulation()
    {
        return $this->lawsNRegulation;
    }

    public function setLawsNRegulation($set)
    {
        $this->lawsNRegulation = $set;
        return $this;
    }

    public function getIsSawNMachine()
    {
        return $this->isSawNMachine;
    }

    public function setIsSawNMachine($mach)
    {
        $this->isSawNMachine = $mach;
        return $this;
    }

    public function getSawNMachine()
    {
        return $this->sawNMachine;
    }

    public function setSawNMachine($set)
    {
        $this->sawNMachine = $set;
        return $this;
    }

    public function getIsBoilersNpressureLifts()
    {
        return $this->isBoilersNpressureLifts;
    }

    public function setIsBoilersNpressureLifts($set)
    {
        $this->isBoilersNpressureLifts = $set;
        return $this;
    }

    public function getSpecialWork()
    {
        return $this->specialWork;
    }

    public function setSpecialWork($work)
    {
        $this->specialWork = $work;
        return $this;
    }

    public function getIsLawAbiding()
    {
        return $this->isLawAbiding;
    }

    public function setIsLawAbiding($set)
    {
        $this->isLawAbiding = $set;
        return $this;
    }

    public function getIsFencedProperly()
    {
        return $this->isFencedProperly;
    }

    public function setIsFencedProperly($set)
    {
        $this->isFencedProperly = $set;
        return $this;
    }

    public function getIsPreviousInsurer()
    {
        return $this->isPreviousInsure;
    }

    public function setIsPreviousInsure($set)
    {
        $this->isPreviousInsure = $set;
        return $this;
    }

    public function getPreviousInsurer()
    {
        return $this->previousInsure;
    }

    public function setPreviousInsure($set)
    {
        $this->previousInsure = $set;
        return $this;
    }
    
    public function getPreviousClaims(){
        return $this->previousClaims;
        
    }
    
   
    
    
    public function getIsDeclaration(){
        return $this->isDeclaration;
    }
    
    public function setIsDeclaration($set){
        $this->isDeclaration = $set;
        return $this;
    }
    /**
     * @return the $isPremiseLawful
     */
    public function getIsPremiseLawful()
    {
        return $this->isPremiseLawful;
    }

    /**
     * @param boolean $isPremiseLawful
     */
    public function setIsPremiseLawful($isPremiseLawful)
    {
        $this->isPremiseLawful = $isPremiseLawful;
        return $this;
    }

    /**
     * @return the $isBoilers
     */
    public function getIsBoilers()
    {
        return $this->isBoilers;
    }

    /**
     * @param boolean $isBoilers
     */
    public function setIsBoilers($isBoilers)
    {
        $this->isBoilers = $isBoilers;
        return $this;
    }

    /**
     * @return the $isRadioActiveProducts
     */
    public function getIsRadioActiveProducts()
    {
        return $this->isRadioActiveProducts;
    }

    /**
     * @param boolean $isRadioActiveProducts
     */
    public function setIsRadioActiveProducts($isRadioActiveProducts)
    {
        $this->isRadioActiveProducts = $isRadioActiveProducts;
        return $this;
    }

    /**
     * @return the $isAcidAndGasses
     */
    public function getIsAcidAndGasses()
    {
        return $this->isAcidAndGasses;
    }

    /**
     * @param boolean $isAcidAndGasses
     */
    public function setIsAcidAndGasses($isAcidAndGasses)
    {
        $this->isAcidAndGasses = $isAcidAndGasses;
        return $this;
    }

    /**
     * @return the $isAbestos
     */
    public function getIsAbestos()
    {
        return $this->isAbestos;
    }

    /**
     * @param boolean $isAbestos
     */
    public function setIsAbestos($isAbestos)
    {
        $this->isAbestos = $isAbestos;
        return $this;
    }

    /**
     * @return the $isPreviousInsure
     */
    public function getIsPreviousInsure()
    {
        return $this->isPreviousInsure;
    }

    /**
     * @return the $previousInsure
     */
    public function getPreviousInsure()
    {
        return $this->previousInsure;
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

