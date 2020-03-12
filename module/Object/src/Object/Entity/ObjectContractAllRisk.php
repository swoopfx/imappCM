<?php
namespace Object\Entity;

// use Doctrine\ORM\Mapping as ORM;
// use Settings\Entity\Currency;
// use Doctrine\Common\Collections\Collection;
// use Offer\Entity\Offer;
// use Doctrine\Common\Collections\ArrayCollection;
// use Proposal\Entity\Proposal;
// use Policy\Entity\PolicyFloat;

// /**
//  * @ORM\Entity
//  * @ORM\Table(name="object_contract_all_risk")
//  *
//  * @author otaba
//  *        
//  */
// class ObjectContractAllRisk
// {

//     /**
//      *
//      * @var integer @ORM\Column(name="id", type="integer", nullable=false)
//      *      @ORM\Id
//      *      @ORM\GeneratedValue(strategy="IDENTITY")
//      */
//     private $id;

//     /**
//      * @ORM\Column(name="contract_name", type="string", nullable=true)
//      *
//      * @var string
//      */
//     private $contractName;

//     /**
//      * @ORM\Column(name="contract_address", type="string", nullable=true)
//      *
//      * @var string
//      */
//     private $contractAddress;

//     /**
//      * @ORM\Column(name="supervising_engineer", type="string", nullable=true)
//      *
//      * @var string
//      */
//     private $supervisingEngineer;

//     /**
//      * @ORM\Column(name="nearest_airport", type="string", nullable=true)
//      *
//      * @var
//      *
//      */
//     private $nearestAirport;

//     /**
//      * @ORM\Column(name="contact_description", type="text", nullable=true)
//      *
//      * @var Text
//      */
//     private $contractDescription;

//     /**
//      * $this is the contract insured value
//      * @ORM\Column(name="contract_insured_value", type="string", nullable=true)
//      *
//      * @var string
//      */
//     private $value;

//     /**
//      * @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
//      *
//      * @var Currency
//      */
//     private $currency;

//     /**
//      * @ORM\OneToOne(targetEntity="Object\Entity\Object", inversedBy="objectContractAllRisk")
//      *
//      * @var Object
//      */
//     private $object;

//     /**
//      * @ORM\Column(name="created_on", type="datetime", nullable=true)
//      *
//      * @var \DateTime
//      */
//     private $createdOn;

//     /**
//      * @ORM\OneToMany(targetEntity="Offer\Entity\Offer", mappedBy="contractAllRisk")
//      *
//      * @var Collection
//      *
//      */
//     private $offer;

//     /**
//      * @ORM\OneToMany(targetEntity="Proposal\Entity\Proposal", mappedBy="contractAllRisk")
//      *
//      * @var Collection
//      *
//      */
//     private $proposal;

//     /**
//      * @ORM\OneToMany(targetEntity="Policy\Entity\PolicyFloat", mappedBy="contractAllRisk")
//      *
//      * @var Collection
//      */
//     private $floatingPolicy;

//     // TODO - Insert your code here
    
//     /**
//      */
//     public function __construct()
//     {
//         $this->offer = new ArrayCollection();
//         $this->proposal = new ArrayCollection();
//         $this->floatingPolicy = new ArrayCollection();
//     }

//     public function getId()
//     {
//         return $this->id;
//     }

//     public function getContractName()
//     {
//         return $this->contractName;
//     }

//     public function setContractName($name)
//     {
//         $this->contractName = $name;
//         return $this;
//     }

//     public function getContractAddress()
//     {
//         return $this->contractAddress;
//     }

//     public function setContractAddress($add)
//     {
//         $this->contractAddress = $add;
//         return $this;
//     }

//     public function getSupervisingEngineer()
//     {
//         return $this->supervisingEngineer;
//     }

//     public function setSupervisingEngineer($eng)
//     {
//         $this->supervisingEngineer = $eng;
//         return $this;
//     }

//     public function getNearestAirport()
//     {
//         return $this->nearestAirport;
//     }

//     public function setNearestAirport($near)
//     {
//         $this->nearestAirport = $near;
//         return $this;
//     }

//     public function getContractDescription()
//     {
//         return $this->contractDescription;
//     }

//     public function setContractDescription($desc)
//     {
//         $this->contractDescription = $desc;
//         return $this;
//     }

//     public function getValue()
//     {
//         return $this->value;
//     }

//     public function setValue($val)
//     {
//         return $this->value;
//     }

//     public function getCurrency()
//     {
//         return $this->currency;
//     }

//     public function setCurrency($cur)
//     {
//         $this->currency = $cur;
//         return $this;
//     }

//     public function getObject()
//     {
//         return $this->object;
//     }

//     public function setObject($obj)
//     {
//         return $this->object;
//     }

//     public function getCreatedOn()
//     {
//         return $this->createdOn;
//     }

//     public function setCreatedOn($date)
//     {
//         $this->createdOn = $date;
//         return $this;
//     }

//     public function getOffer()
//     {
//         return $this->offer;
//     }

//     /**
//      *
//      * @param Offer $offer            
//      * @return \Object\Entity\ObjectContractAllRisk
//      */
//     public function addOffer($offer)
//     {
//         if (! $this->offer->contains($offer)) {
//             $this->offer->add($offer);
//             $offer->setContractAllRisk($this);
//         }
        
//         return $this;
//     }

//     /**
//      *
//      * @param Offer $offer            
//      * @return \Object\Entity\ObjectContractAllRisk
//      */
//     public function removeOffer($offer)
//     {
//         if (! $this->offer->contains($offer)) {
//             $this->offer->removeElement($offer);
//             $offer->setContractAllRisk(NULL);
//         }
        
//         return $this;
//     }

//     public function getProposal()
//     {
//         return $this->proposal;
//     }

//     /**
//      *
//      * @param Proposal $proposal            
//      * @return \Object\Entity\ObjectContractAllRisk
//      */
//     public function addProposal($proposal)
//     {
//         if (! $this->proposal->contains($proposal)) {
//             $this->proposal->add($proposal);
//             $proposal->setContractAllRisk($this);
//         }
        
//         return $this;
//     }

//     /**
//      *
//      * @param Proposal $proposal            
//      * @return \Object\Entity\ObjectContractAllRisk
//      */
//     public function removeProposal($proposal)
//     {
//         if ($this->proposal->contains($proposal)) {
//             $this->proposal->removeElement($proposal);
//             $proposal->setContractAllRisk(NULL);
//         }
        
//         return $this;
//     }

//     public function getFloatingPolicy()
//     {
//         return $this->floatingPolicy;
//     }

//     /**
//      *
//      * @param PolicyFloat $float            
//      * @return \Object\Entity\ObjectContractAllRisk
//      */
//     public function addFloatingPolicy($float)
//     {
//         if (! $this->floatingPolicy->contains($float)) {
//             $this->floatingPolicy->add($float);
//             $float->setContractAllRisk($this);
//         }
        
//         return $this;
//     }

//     /**
//      *
//      * @param PolicyFloat $float            
//      * @return \Object\Entity\ObjectContractAllRisk
//      */
//     public function removeFloatingPolicy($float)
//     {
//         if ($this->floatingPolicy->contains($float)) {
//             $this->floatingPolicy->add($float);
//             $float->setContractAllRisk(NULL);
//         }
//         return $this;
//     }
// }

