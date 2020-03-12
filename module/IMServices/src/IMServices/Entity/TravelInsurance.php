<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\Currency;

/**
 * TravelInsurance
 *
 * @ORM\Table(name="travel_insurance")
 * @ORM\Entity
 */
// , indexes={@ORM\Index(name="FK_travel_coverage_teritory_idx", columns={"coverage_teritory_id"}), @ORM\Index(name="FK_travel_offer_id_idx", columns={"offer_id"})}
class TravelInsurance
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Proposed Cove start date , usually departure date 
     * @ORM\Column(name="cover_start_date", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $coverStartDate;

    /**
     * Proposed Cover End date usually return date 
     * @ORM\Column(name="cover_end_date", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $coverEndDate;

    /**
     * Sum to be covered 
     * @var string @ORM\Column(name="coverage_sum", type="string", nullable=true)
     */
    private $coverageSum;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
     * 
     * @var Currency
     */
    private $currency;
    
    /**
     * Provide cover for lost baggage 
     * @ORM\Column(name="is_lost_baggage", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $isLostBaggage;

    /**
     * Condition for lost baaggage, if left blank it is assumed to be for the duration of the cover and full 
     * @var string @ORM\Column(name="lost_baggage_coverage", type="string", nullable=true)
     */
    private $lostBaggageCoverage;

   

    /**
     * Value sum to cover on lost baggage 
     * @var string @ORM\Column(name="lost_baggage_sum", type="string", nullable=true)
     */
    private $lostBaggageSum;
    
    
    /**
     * Provide cover for interupted travel 
     * @ORM\Column(name="is_travel_interuption_cover", type="boolean", nullable=true)
     * @var boolean
     */
    private $isTravelInteruptionCover;

    /**
     * Interupted travel condition 
     * @var integer @ORM\Column(name="travel_interuption_coverage", type="string", nullable=true)
     */
    private $travelInteruptionCoverage;

    // type="decimal", precision=15, scale=4, nullable=true)
    /**
     * Sum to cover for interupted travel 
     * @var string @ORM\Column(name="travel_interuption_sum", type="string", nullable=true)
     */
    private $travelInteruptionSum;

    /**
     * Terrirtory of cover
     * @var \Settings\Entity\CoverageTeritory @ORM\ManyToOne(targetEntity="Settings\Entity\CoverageTeritory")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="coverage_teritory_id", referencedColumnName="id")
     *      })
     */
    private $coverageTeritory;
    
    /**
     * DEfines if the service provided hasa special name given by the insurer 
     * @ORM\Column(name="is_package", type="boolean", nullable=true)
     * @var boolean
     */
    private $isPackage;

    /**
     * This is name of the prepackaged service
     * @ORM\Column(name="package_name", type="string", nullable=true)
     * 
     * @var string
     */
    private $packageName;

    /**
     * Destination of travel 
     * @ORM\Column(name="destination", type="string", nullable=true)
     * 
     * @var string
     */
    private $destination;
    
    /**
     * Destination of travel
     * @ORM\Column(name="departure", type="string", nullable=true)
     *
     * @var string
     */
    private $departure;
    
    
    
    

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getCoverStartDate()
    {
        return $this->coverStartDate;
    }

    public function setCoverStartDate($date)
    {
        $this->coverStartDate = $date;
        return $this;
    }

    public function getCoverEndDate()
    {
        return $this->coverEndDate;
    }

    public function setCoverEndDate($date)
    {
        $this->coverEndDate = $date;
        return $this;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency($cur)
    {
        $this->currency = $cur;
        return $this;
    }
    
    
    public function getIsTravelInteruptionCover(){
        return $this->isTravelInteruptionCover;
    }
    
    public function setIsTravelInteruptionCover($ret){
        $this->isTravelInteruptionCover = $ret;
        return $this;
    }

    /**
     * Set coverageSum
     *
     * @param string $coverageSum            
     *
     * @return TravelInsurance
     */
    public function setCoverageSum($coverageSum)
    {
        $this->coverageSum = $coverageSum;
        
        return $this;
    }

    /**
     * Get coverageSum
     *
     * @return string
     */
    public function getCoverageSum()
    {
        return $this->coverageSum;
    }

    /**
     * Set lostBaggageCoverage
     *
     * @param integer $lostBaggageCoverage            
     *
     * @return TravelInsurance
     */
    public function setLostBaggageCoverage($lostBaggageCoverage)
    {
        $this->lostBaggageCoverage = $lostBaggageCoverage;
        
        return $this;
    }

    /**
     * Get lostBaggageCoverage
     *
     * @return integer
     */
    public function getLostBaggageCoverage()
    {
        return $this->lostBaggageCoverage;
    }

    /**
     * Set lostBaggageSum
     *
     * @param string $lostBaggageSum            
     *
     * @return TravelInsurance
     */
    public function setLostBaggageSum($lostBaggageSum)
    {
        $this->lostBaggageSum = $lostBaggageSum;
        
        return $this;
    }

    /**
     * Get lostBaggageSum
     *
     * @return string
     */
    public function getLostBaggageSum()
    {
        return $this->lostBaggageSum;
    }
    
   
    /**
     * Set travelInteruptionCoverage
     *
     * @param integer $travelInteruptionCoverage            
     *
     * @return TravelInsurance
     */
    public function setTravelInteruptionCoverage($travelInteruptionCoverage)
    {
        $this->travelInteruptionCoverage = $travelInteruptionCoverage;
        
        return $this;
    }

    /**
     * Get travelInteruptionCoverage
     *
     * @return integer
     */
    public function getTravelInteruptionCoverage()
    {
        return $this->travelInteruptionCoverage;
    }

    /**
     * Set travelInteruptionSum
     *
     * @param string $travelInteruptionSum            
     *
     * @return TravelInsurance
     */
    public function setTravelInteruptionSum($travelInteruptionSum)
    {
        $this->travelInteruptionSum = $travelInteruptionSum;
        
        return $this;
    }

    /**
     * Get travelInteruptionSum
     *
     * @return string
     */
    public function getTravelInteruptionSum()
    {
        return $this->travelInteruptionSum;
    }
    

    // /**
    // * Set offer
    // *
    // * @param \All\Entity\Offer $offer
    // *
    // * @return TravelInsurance
    // */
    // public function setOffer(\All\Entity\Offer $offer = null)
    // {
    // $this->offer = $offer;
    
    // return $this;
    // }
    
    // /**
    // * Get offer
    // *
    // * @return \All\Entity\Offer
    // */
    // public function getOffer()
    // {
    // return $this->offer;
    // }
    
    /**
     * Set coverageTeritory
     *
     * @param \Settings\Entity\CoverageTeritory $coverageTeritory            
     *
     * @return TravelInsurance
     */
    public function setCoverageTeritory(\Settings\Entity\CoverageTeritory $coverageTeritory = null)
    {
        $this->coverageTeritory = $coverageTeritory;
        
        return $this;
    }

    /**
     * Get coverageTeritory
     *
     * @return \Settings\Entity\CoverageTeritory
     */
    public function getCoverageTeritory()
    {
        return $this->coverageTeritory;
    }
    
    public function getIsPackage(){
        return $this->isPackage;
    }
    
    public function setIsPackage($pack){
        $this->isPackage = $pack;
        return $this;
    }

    public function getPackageName()
    {
        return $this->packageName;
    }

    public function setPackageName($name)
    {
        $this->packageName = $name;
        return $this;
    }

    public function getDestination()
    {
        return $this->destination;
    }

    public function setDestination($des)
    {
        $this->destination = $des;
        return $this;
    }

    public function getIsLostBaggage()
    {
        return $this->isLostBaggage;
    }

    public function setIsLostBaggage($gage)
    {
        $this->isLostBaggage = $gage;
        return $this;
    }
    /**
     * @return the $departure
     */
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * @param string $departure
     */
    public function setDeparture($departure)
    {
        $this->departure = $departure;
        return $this;
    }

}
