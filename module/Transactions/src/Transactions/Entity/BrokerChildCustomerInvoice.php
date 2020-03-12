<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;
use GeneralServicer\Entity\BrokerChild;
/**
 * @ORM\Entity
 * @ORM\Table(name="broker_child_customer_invoice")
 * @author swoopfx
 *        
 */
class BrokerChildCustomerInvoice
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Transactions\Entity\BrokerCustomerInvoice", inversedBy="brokerChildCustomerInvoice")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="broker_child_custmer_invoice", referencedColumnName="id")
     * })
     * 
     * @var BrokerCustomerInvoice
     */
    private $brokerCustomerInvoice;

    /**
     * @ORM\ManyToOne(targetEntity="GeneralServicer\Entity\BrokerChild")
     * @ORM\JoinColumn(name="broker_child", referencedColumnName="id")
     * @var BrokerChild
     */
    private $brokerChild;

    public function __construct()
    {
        
        
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getBrokerCustomerInvoice(){
        return $this->brokerCustomerInvoice;
    }
    
    public function setBrokerCustomerInvoice($set){
        $this->brokerCustomerInvoice = $set;
        return $this;
    }
    
    public function getBrokerChild(){
        return $this->brokerChild;
    }
    
    public function setBrokerChild($set){
        $this->brokerChild = $set;
        return $this;
    }
}

