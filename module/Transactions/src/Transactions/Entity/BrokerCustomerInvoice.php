<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;
use Users\Entity\InsuranceBrokerRegistered;
use Customer\Entity\Customer;

/**
 * @ORM\Entity
 * @ORM\Table(name="broker_customer_invoice")
 *
 * @author swoopfx
 *        
 */
class BrokerCustomerInvoice
{

    /**
     *
     * @var integer This is only genertated upon successful transaction
     *      @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Customer\Entity\Customer")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     *
     * @var Customer
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered")
     * @ORM\JoinColumn(name="broker", referencedColumnName="id")
     *
     * @var InsuranceBrokerRegistered
     */
    private $broker;

    /**
     * @ORM\OneToOne(targetEntity="Transactions\Entity\Invoice", inversedBy="brokerCustomerInvoice")
     * 
     * @ORM\JoinColumn(name="invoice", referencedColumnName="id")
     *
     * @var Invoice
     */
    private $invoice;

    /**
     * @ORM\OneToOne(targetEntity="Transactions\Entity\BrokerChildCustomerInvoice", mappedBy="brokerCustomerInvoice", cascade={"persist", "remove"})
     * 
     * @var unknown
     */
    private $brokerChildCustomerInvoice;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function setCustomer($customer)
    {
        $this->customer = $customer;
        
        return $this;
    }

    public function getBroker()
    {
        return $this->broker;
    }

    public function setBroker($broker)
    {
        $this->broker = $broker;
        
        return $this;
    }

    public function getBrokerChildCustomerInvoice()
    {
        return $this->brokerChildCustomerInvoice;
    }

    public function getInvoice()
    {
        return $this->invoice;
    }

    public function setInvoice($inv)
    {
        $this->invoice = $inv;
        return $this;
    }
}

