<?php
namespace IMServices\Entity;


use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="consequential_loss")
 * @author otaba
 *        
 */
class ConsequentialLoss
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    // Begin Amount to be insured
    
    /**
     * 
     * @var string
     */
    private $turnOver;
    
    /**
     * 
     * @var string
     */
    private $closingStock;
    
    /**
     * 
     * @var string
     */
    private $openingStock;
    
    /**
     * 
     * @var string
     */
    private $annualGrossProfit;
    
    private $maximumIndemnityPeriod;
    
    private $sumCoveredOnGrossProfit;
    
    private $coverPeriod;
    
    private $annualWage;
    
    private $sumCoveredOnWages;
    
    private $businessDecription;
    
    private $proposalLocation;
    
    private $proposalNature;
    
    
    // begin on Gross Profit 
    
    
    
//     private 
    
    
    
    
    
    /**
     */
    public function __construct()
    {
        
       
    }
    
    public function getId(){
        return $this->id;
    }
}

