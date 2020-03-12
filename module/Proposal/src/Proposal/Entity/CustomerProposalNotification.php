<?php
namespace Proposal\Entity;


use Doctrine\ORM\Mapping as ORM;
/**
 * This notifes the customer of a proposal
 * @ORM\Entity
 * @ORM\Table(name="customer_proposal_notification")
 * @author swoopfx
 *        
 */
class CustomerProposalNotification
{
    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */

    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Proposal\Entity\Proposal")
     * @ORM\JoinColumn(name="proposal", referencedColumnName="id")
     * @var Proposal
     */
    private $proposal;
    
    /**
     * @ORM\Column(name="notification_date", type="datetime", nullable=false)
     * @var datetime 
     */
    private $notificationDate;
    public function __construct()
    {
        
        
    }
    
    public function getId(){
        return $this->id;
        
    }
    
    public function getProposal(){
        return $this->proposal;
    }
    
    public function setProposal($prop){
        $this->proposal = $prop;
        return  $this;
    }
    
    public function getNotificationDate(){
        return $this->notificationDate;
    }
    
    public function setNotificationDate($date){
        $this->notificationDate = $date;
        return $this;
    }
}

