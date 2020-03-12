<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This defines the payment structure for the customer
 * 
 * @ORM\Table(name="payment_stucture")
 * @ORM\Entity
 */
class PaymentStructure
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
     * @var string @ORM\Column(name="duration_text", type="string", length=100, nullable=true)
     */
    private $durationText;
    
    /**
     *
     * @var float @ORM\Column(name="duration_value", type="float", precision=10, scale=0, nullable=true)
     */
    private $durationValue;
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        
    }
    
    /**
     * Get idpaymentDuration
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set durationText
     *
     * @param string $durationText
     *
     * @return Duration
     */
    public function setDurationText($durationText)
    {
        $this->durationText = $durationText;
        
        return $this;
    }
    
    /**
     * Get durationText
     *
     * @return string
     */
    public function getDurationText()
    {
        return $this->durationText;
    }
    
    /**
     * Set durationValue
     *
     * @param float $durationValue
     *
     * @return Duration
     */
    public function setDurationValue($durationValue)
    {
        $this->durationValue = $durationValue;
        
        return $this;
    }
    
    /**
     * Get durationValue
     *
     * @return float
     */
    public function getDurationValue()
    {
        return $this->durationValue;
    }
}

