<?php
namespace Customer\Entity;

use Doctrine\ORM\Mapping as ORM;
use Packages\Entity\Packages;
use Doctrine\Common\Collections\ArrayCollection;
use Transactions\Entity\Invoice;
use Packages\Entity\PackageStatus;
use Policy\Entity\CoverNote;

/**
 * @ORM\Entity(repositoryClass="Customer\Entity\Repository\CustomerPackageRepository")
 * @ORM\Table("customer_package")
 *
 * @author otaba
 * @copyright Ajayi Oluwaseun Ezekiel 2017
 *           
 */
class CustomerPackage
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Packages\Entity\Packages")
     * @ORM\JoinColumn(name="package", referencedColumnName="id")
     *
     * @var Packages
     */
    private $packages;

    /**
     * @ORM\ManyToOne(targetEntity="Customer\Entity\Customer")
     * @ORM\JoinColumn(name="customer", referencedColumnName="id")
     *
     * @var Customer
     */
    private $customer;

    // /**
    // * @ORM\OneToOne(targetEntity="Transactions\Entity\Invoice")
    // * @ORM\JoinColumn(name="invoice", referencedColumnName="id")
    // *
    // * @var Invoice
    // */
    // private $invoice;
    
    /**
     * @ORM\OneToOne(targetEntity="Transactions\Entity\Invoice", mappedBy="packages", cascade={"persist", "remove"})
     * 
     * @var Invoice
     */
    private $invoice;

    /**
     * This is positive/true if the customer has not paid for the package
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     *
     * @var boolean
     */
    private $isActive;

    /**
     * @ORM\ManyToOne(targetEntity="Packages\Entity\PackageStatus")
     * @ORM\JoinColumn(name="package_status", referencedColumnName="id")
     *
     * @var PackageStatus
     */
    private $acquiredPackageStatus;

    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=false)
     *
     * @var datetime
     */
    private $createdOn;

    /**
     * @ORM\Column(name="is_policized", type="boolean", nullable=true, options={"default":"0"})
     *
     * @var boolean
     */
    private $isPolicized;

    /**
     * @ORM\Column(name="updated_on", type="datetime", nullable=false)
     *
     * @var datetime
     */
    private $updatedOn;

    /**
     * @ORM\OneToMany(targetEntity="Object\Entity\Object", mappedBy="customerPackage")
     *
     * @var
     *
     */
    /**
     *
     * @var \Doctrine\Common\Collections\Collection @ORM\ManyToMany(targetEntity="Object\Entity\Object")
     *      @ORM\JoinTable(name="object_custpmer_packages",
     *      joinColumns={
     *      @ORM\JoinColumn(name="customer_package_id", referencedColumnName="id")
     *      },
     *      inverseJoinColumns={
     *      @ORM\JoinColumn(name="object_id", referencedColumnName="id")
     *      }
     *      )
     */
    private $object;

    /**
     * @ORM\Column(name="is_hidden", type="boolean", nullable=true, options={"default":"0"})
     * 
     * @var boolean
     */
    private $isHidden;

    /**
     * @ORM\OneToOne(targetEntity="Policy\Entity\CoverNote", mappedBy="package")
     *
     * @var CoverNote
     */
    private $coverNote;

    /**
     * @ORM\Column(name="customer_package_uid", type="string", nullable=false)
     * 
     * @var string
     */
    private $customerPackageUid;

    /**
     * @ORM\OneToOne(targetEntity="Messages\Entity\Messages", mappedBy="packages")
     *
     * @var Messages
     */
    private $messages;
    
    /**
     * @ORM\OneToOne(targetEntity="CustomerPackageInitiator", mappedBy="customerPackges")
     * @var CustomerPackageInitiator
     */
    private $initiator;

    public function __construct()
    {
        $this->object = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return \Packages\Entity\Packages
     */
    public function getPackages()
    {
        return $this->packages;
    }

    public function setPackages($pack)
    {
        $this->packages = $pack;
        return $this;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setIsActive($act)
    {
        $this->isActive = $act;
        return $this;
    }

    public function getAcquiredPackageStatus()
    {
        return $this->acquiredPackageStatus;
    }

    public function setAcquiredPackageStatus($stat)
    {
        $this->acquiredPackageStatus = $stat;
        return $this;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function setCustomer($cust)
    {
        $this->customer = $cust;
        return $this;
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

    public function setCreatedOn($date)
    {
        $this->createdOn = $date;
        $this->updatedOn = $date;
        return $this;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function setUpdatedOn($date)
    {
        $this->updatedOn = $date;
        return $this;
    }

    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    public function getObject()
    {
        return $this->object;
    }

    public function addObject($object)
    {
        if (!$this->object->contains($object)) {
            $this->object->add($object);
        }
       
        
        return $this;
    }

    public function removeObject($object)
    {
        if($this->object->contains($object)){
            $this->object->removeElement($object);
        }
        return $this;
    }

    public function getIsPolicized()
    {
        return $this->isPolicized;
    }

    public function setIsPolicized($bool)
    {
        $this->isPolicized = $bool;
        return $this;
    }

    public function setIsHidden($bool)
    {
        $this->isHidden = $bool;
        return $this;
    }
    
    public function getIsHidden(){
        return $this->isHidden;
    }

    public function getCoverNote()
    {
        return $this->coverNote;
    }

    public function setCoverNote($note)
    {
        $this->coverNote = $note;
        return $this;
    }

    public function getCustomerPackageUid()
    {
        return $this->customerPackageUid;
    }

    public function setCustomerPackageUid($uid)
    {
        $this->customerPackageUid = $uid;
        return $this;
    }

    public function getMessages()
    {
        return $this->messages;
    }
    
    public function getInitiator(){
        return $this->initiator;
    }
}