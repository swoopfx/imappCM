<?php
namespace Customer\Entity;

use Doctrine\ORM\Mapping as ORM;
use Users\Entity\InsuranceBrokerRegistered;


/**
 * @ORM\Entity
 * @ORM\Table(name="customer_broker")
 * 
 * @author swoopfx
 *        
 */
class CustomerBroker
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
     * @ORM\ManyToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered", inversedBy="customers")
     * @ORM\JoinColumn(name="broker", referencedColumnName="id")
     * 
     * @var InsuranceBrokerRegistered
     */
    private $broker;

    /**
     * TODO change to many to one relationship and hence the othe to many to one 
     * @ORM\OneToOne(targetEntity="Customer\Entity\Customer", inversedBy="customerBroker")
     * @ORM\JoinColumn(name="customer", referencedColumnName="id")
     * 
     * @var Customer
     */
    private $customer;
    
    // /**
    // * @ORM\OneToMany(targetEntity="Customer\Entity\CustomerAssignedBrokerChild", mappedBy="customerBroker", cascade={"persist", "remove"})
    // *
    // * @var CustomerAssignedBrokerChild
    // */
    // private $assignedChildBroker;
    
//     /**
//      * @ORM\OneToMany(targetEntity="GeneralServicer\Entity\BrokerChild", mappedBy="customerBroker", cascade={"persist", "remove"})
//      * 
//      */
//     private $brokerChild;
    
    /**
     */
    
//     /**
//      *
//      * @var \Doctrine\Common\Collections\Collection @ORM\ManyToMany(targetEntity="GeneralServicer\Entity\BrokerChild", cascade={"persist", "remove"})
//      *      @ORM\JoinTable(name="customer_assigned_broker_child",
//      *      joinColumns={
//      *      @ORM\JoinColumn(name="customer_broker", referencedColumnName="id")
//      *      },
//      *      inverseJoinColumns={
//      *      @ORM\JoinColumn(name="broker_child", referencedColumnName="id")
//      *      }
//      *      )
//      */
//     private $brokerChild;

    public function __construct()
    {
        //$this->brokerChild = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
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

    public function getCustomer()
    {
        return $this->customer;
    }

    public function setCustomer($cus)
    {
        $this->customer = $cus;
        return $this;
    }

   

//     public function getBrokerChild()
//     {
//         return $this->brokerChild;
//     }

//     public function addBrokerChild($child)
//     {
//         if(!$this->brokerChild->contains($child)){
//             $this->brokerChild->add($child);
//         }
//         return $this;
//     }

//     public function removeBrokerChild($child)
//     {
//         $this->brokerChild->removeElement($child);
//     }
}

