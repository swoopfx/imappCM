<?php
namespace Customer\Entity;

use Doctrine\ORM\Mapping as ORM;
use CsnUser\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="customer_package_initiator")
 *
 * @author otaba
 *        
 */
class CustomerPackageInitiator
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Customer\Entity\CustomerPackage", inversedBy="initiator")
     * @ORM\JoinColumn(name="customer_package", referencedColumnName="id")
     *
     * @var CustomerPackage
     */
    private $customerPackges;

    /**
     * @ORM\ManyToOne(targetEntity="CsnUser\Entity\User")
     * @ORM\JoinColumn(name="package_processor", referencedColumnName="id")
     *
     * @var User
     */
    private $packageProcessor;

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
    private $updatedOn;
    
    /**
     * 
     * @var unknown
     */
    private $coverNote;
    

    public function getId()
    {
        return $this->id;
    }

    public function setPackageProcessor($pros)
    {
        $this->packageProcessor = $pros;
        return $this;
    }

    public function getPackageProcessor()
    {
        return $this->packageProcessor;
    }

    public function getCustomerPackages()
    {
        return $this->customerPackges;
    }

    public function setCustomerPackages($pack)
    {
        $this->customerPackges = $pack;
        return $this;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function setCreatedOn($date)
    {
        $this->createdOn = $date;
        $this->updatedOn = $date;
        
        return $this;
    }

    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    public function setUpdateOn($date)
    {
        $this->updatedOn = $date;
        return $this;
    }
    
    
}

