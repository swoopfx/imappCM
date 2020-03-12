<?php
namespace Transactions\Entity;


use Doctrine\ORM\Mapping as ORM;
use CsnUser\Entity\User;
/**
 * @ORM\Entity
 * @ORM\Table(name="invoice_user")
 * @author swoopfx
 *        
 */
class InvoiceUser
{
    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id ;
    
    /**
     * @ORM\ManyToOne(targetEntity="CsnUser\Entity\User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     * @var User
     */
    private $user;
    
    /**
     * @ORM\OneToOne(targetEntity="Transactions\Entity\Invoice", inversedBy="invoiceUser", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="invoice", referencedColumnName="id")
     * @var Invoice
     */
    private $invoice;
    
    public function __construct()
    {
        
       
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getUser(){
        return $this->user;
    }
    
    public function setUser($user){
        $this->user = $user;
        return $this;
    }
    
    public function getInvoice(){
        return $this->invoice ;
    }
    
    public function setInvoice($inv){
        $this->invoice = $inv;
        
        return $this;
    }
}

