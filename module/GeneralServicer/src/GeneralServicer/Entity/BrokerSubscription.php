<?php
namespace GeneralServicer\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\Packages;
use Users\Entity\InsuranceBrokerRegistered;
use Transactions\Entity\Invoice;
// use Doctrine\Common\Collections\ArrayCollection;
// use Doctrine\Common\Collections\Collection;

/**
 *
 * @author swoopfx
 *         @ORM\Table(name="broker_subscription")
 *         @ORM\Entity
 */
class BrokerSubscription
{

    /**
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered", inversedBy="subscription")
     * @ORM\JoinColumn(name="broker_id", referencedColumnName="id")
     *
     * @var InsuranceBrokerRegistered
     */
    private $broker;

    /**
     * @ORM\Column(name="start_date", type="date")
     *
     * @var \Date
     */
    private $startDate;

    /**
     * @ORM\Column(name="end_date", type="date")
     *
     * @var \Date
     */
    private $endDate;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Packages")
     * @ORM\JoinColumn(name="package", referencedColumnName="id")
     *
     * @var Packages
     */
    private $package;

    /**
     * @ORM\Column(name="months", type="integer", nullable=false)
     * 
     * @var integer
     */
    private $months;

    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=false)
     *
     * @var datetime
     */
    private $createdOn;

    /**
     * @ORM\Column(name="updated_on", type="datetime", nullable=false)
     *
     * @var datetime
     */
    private $updateOn;

    /**
     * @ORM\Column(name="is_valid", type="boolean", nullable=false)
     *
     * @var boolean
     */
    private $isValid = 0;
    
    // /**
    // *
    // * @var Invoice @ORM\ManyToMany(targetEntity="Transactions\Entity\Invoice")
    // * @ORM\JoinTable(name="broker_sub_invoice",
    // * joinColumns={@ORM\JoinColumn(name="sub_id", referencedColumnName="id")},
    // * inverseJoinColumns={@ORM\JoinColumn(name="invoice_id", referencedColumnName="id")}
    // * )
    // */
    
    /**
     *
     * @var Invoice @ORM\OneToOne(targetEntity="Transactions\Entity\Invoice")
     *      @ORM\JoinColumn(name="invoice_id", referencedColumnName="id")
     */
    private $invoice;

    public function __construct()
    {
        // $this->invoice = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return \Users\Entity\InsuranceBrokerRegistered
     */
    public function getBroker()
    {
        return $this->broker;
    }

    /**
     *
     * @param InsuranceBrokerRegistered $id            
     */
    public function setBroker(InsuranceBrokerRegistered $broker)
    {
        $this->broker = $broker;
        
        return $this;
    }

    /**
     *
     * @return Date
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     *
     * @param \Date $date            
     */
    public function setStartDate($date)
    {
        $this->startDate = $date;
        return $this;
    }

    /**
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     *
     * @param \Date $end            
     */
    public function setEndDate($end)
    {
        $this->endDate = $end;
        
        return $this;
    }

    public function getMonths()
    {
        return $this->months;
    }

    public function setMonths($mths)
    {
        $this->months = $mths;
        return $this;
    }

    public function getPackage()
    {
        return $this->package;
    }

    public function setPackage($pack)
    {
        $this->package = $pack;
        
        return $this;
    }

    public function setCreatedOn($date)
    {
        $this->updateOn = $date;
        $this->createdOn = $date;
        
        return $this;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function setUpdateOn($date)
    {
        $this->updateOn = $date;
        
        return $this;
    }

    public function getUpdateOn()
    {
        return $this->updateOn;
    }

    public function getIsValid()
    {
        return $this->isValid;
    }

    public function setIsValid($valid = 0)
    {
        $this->isValid = $valid;
        
        return $this;
    }

    /**
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     *
     * @param unknown $invoice            
     */
    public function setInvoice($invoice)
    {
        $this->invoice = $invoice;
        
        return $this;
    }
    
    // public function addInvoices(Collection $invoices)
    // {
    // foreach ($invoices as $invoice) {
    // $this->addInvoice($invoice);
    // }
    
    // return $this;
    // }
    
    // public function addInvoice(Invoice $invoice)
    // {
    // $this->invoice[] = $invoice;
    
    // return $this;
    // }
    
    // public function removeInvocie($invoice)
    // {
    // $this->invoice[] = $invoice;
    
    // return $this;
    // }
    
    // public function removeInvoces($invoices)
    // {
    // foreach ($invoices as $invoice) {
    // $this->addInvoice($invoice);
    // }
    
    // return $this;
    // }
}

