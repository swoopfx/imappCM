<?php
namespace SMS\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="sms_notification_settings")
 * 
 * @author swoopfx
 *        
 */
class SMSNotificationSettings
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     *  This notifys the customer if the  aninvoice is expired
     *  @ORM\Column(name="is_expired_invoice", type="boolean", nullable=true) 
     * @var boolean
     */
    private $isExpiredInvoice;
    
    /**
     * 
     * This notifies the customer when his policy has been renewed 
     * @ORM\Column(name="is_policy_renewal", type="boolean", nullable=true)
     * @var boolean
     */
    private $isPolicyRenewal;
    
    /**
     * 
     * @ORM\Column(name="is_policy_creation", type="boolean", nullable=true)
     * @var boolean
     * This notify the customer when a policacy is created 
     * 
     */
    private $isPolicyCreation;
    
    
    /**
     * This notifies the broker if an offer has not bben attended to with 15 days 
     * @var unknown
     */
    private $unAttendedOffer;
    
    /**
     * This notification notifies the broker if a 
     * @var unknown
     */
    private $unAttendedClaims;
    

    public  function getId(){
        return $this->id;
    }
    
    public function getIsExpiredInvoice(){
        return $this->isExpiredInvoice;
    }
    
    public function setIsExpiredInvoice($inv){
        $this->isExpiredInvoice = $inv ;
        return $this;
    }
}

