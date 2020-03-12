<?php
namespace Packages\Entity;

use Doctrine\ORM\Mapping as ORM;
// use Settings\Entity\DefinedPackageCategory;
use Object\Entity\AdditionalValue;
use Doctrine\Common\Collections\ArrayCollection;
use Settings\Entity\Currency;
use Customer\Entity\Customer;
use Doctrine\Common\Collections\Collection;
use Settings\Entity\DefinePackageValueType;
use Users\Entity\InsuranceBrokerRegistered;
use Settings\Entity\ObjectType;
use Customer\Entity\CustomerPackage;
use Settings\Entity\Insurer;
use Settings\Entity\InsuranceServiceType;
use Settings\Entity\InsuranceSpecificService;
use Settings\Entity\CoverDuration;
use GeneralServicer\Entity\Document;

/**
 * These are pre defined packages for instant consumption
 * @ORM\Entity(repositoryClass="Packages\Entity\Repository\PackageRepository")
 * @ORM\Table(name="defined_packages")
 *
 * @author otaba
 *        
 */
class Packages
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered")
     * @ORM\JoinColumn(name="broker", referencedColumnName="id")
     *
     * @var InsuranceBrokerRegistered
     */
    private $broker;

    /**
     * @ORM\ManyToOne(targetEntity="GeneralServicer\Entity\Document")
     * @ORM\JoinColumn(name="package_image", referencedColumnName="id")
     *
     * @var Document
     *
     */
    private $packageImage;

    /**
     * @ORM\Column(name="package_name", type="string", nullable=false)
     *
     * @var string
     */
    private $packageName;

    /**
     * This should have formating
     * @ORM\Column(name="description", type="text", nullable=true)
     *
     * @var string
     */
    private $description;

    /**
     * This defines if it is sport, travel, health etc it also includes all proposal categories
     * @ORM\ManyToOne(targetEntity="Settings\Entity\ObjectType")
     * @ORM\JoinColumn(name="package_category", referencedColumnName="id")
     *
     * @var ObjectType
     */
    private $packageCategory;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\InsuranceServiceType")
     * 
     * @var InsuranceServiceType
     */
    private $serviceType;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\InsuranceSpecificService")
     * @ORM\JoinColumn(name="specific_service", referencedColumnName="id")
     *
     * @var InsuranceSpecificService
     */
    private $specificService;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Currency")
     * @ORM\JoinColumn(name="currency", referencedColumnName="id")
     *
     * @var Currency
     */
    private $currency;

    /**
     * if the value is percentage
     * The calculation takes percentile
     * else do it as absolute
     * @ORM\Column(name="value", type="string", nullable=false)
     *
     * @var string
     */
    private $value;

    /**
     * This is used in life assurance or
     * @ORM\Column(name="sum_assured", type="string", nullable=true)
     * 
     * @var string
     */
    private $sumAssured;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\DefinePackageValueType")
     * @ORM\JoinColumn(name="value_type", referencedColumnName="id")
     *
     * @var DefinePackageValueType
     */
    private $valueType;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Insurer")
     * @ORM\JoinColumn(name="packaged_insurer", referencedColumnName="id")
     *
     * @var Insurer
     */
    private $packagedInsurer;

    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     *
     * @var Datetime
     *
     */
    private $createdOn;

    /**
     * @ORM\Column(name="updated_on", type="datetime", nullable=true)
     *
     * @var Datetime
     *
     */
    private $updatedOn;

    /**
     * @ORM\OneToMany(targetEntity="Customer\Entity\Customer", mappedBy="recommendedPackages")
     *
     * @var Collection
     */
    private $recomendedCustomer;

    /**
     * @ORM\OneToMany(targetEntity="Proposal\Entity\Proposal", mappedBy="customer" , cascade={"persist", "remove"})
     *
     * @var Collection
     */
    private $additionalValue;

    /**
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     *
     * @var boolean
     */
    private $isActive;

    /**
     * @ORM\Column(name="package_uid", type="string", nullable=true)
     *
     * @var string
     */
    private $packageUid;

    private $motor;

    /**
     * @ORM\OneToOne(targetEntity="Packages\Entity\TravelPackagesDetails", cascade={"persist", "remove"})
     *
     * @var TravelPackagesDetails
     */
    private $travel;

    private $building;

    private $business;

    private $life;

    private $lifeStyle;

    private $sports;

    private $others;

    /**
     * @ORM\OneToMany(targetEntity="Customer\Entity\CustomerPackage", mappedBy="packages")
     *
     * @var CustomerPackage
     */
    private $customerPackages;

    /**
     * @ORM\Column(name="is_hidden", type="boolean", nullable=true, options={"default":"0"})
     * 
     * @var boolean
     */
    private $isHidden;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\PolicyCoverDuration")
     * 
     * @var CoverDuration
     */
    private $coverDuration;

    /**
     * @ORM\OneToOne(targetEntity="Settings\Entity\PolicyCoverTermedValue", mappedBy="packages", cascade={"persist", "remove"})
     * 
     * @var CoverDuration
     */
    private $termedDuration;

    public function __construct()
    {
        $this->additionalValue = new ArrayCollection();
        $this->recomendedCustomer = new ArrayCollection();
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

    public function getId()
    {
        return $this->id;
    }

    public function getPackageImage()
    {
        return $this->packageImage;
    }

    public function setPackageImage($image)
    {
        $this->packageImage = $image;
        return $this;
    }

    public function getPackageName()
    {
        return $this->packageName;
    }

    public function setPackageName($pack)
    {
        $this->packageName = $pack;
        return $this;
    }

    public function getPackageCategory()
    {
        return $this->packageCategory;
    }

    public function setPackageCategory($pack)
    {
        $this->packageCategory = $pack;
        return $this;
    }

    public function getServiceType()
    {
        return $this->serviceType;
    }

    public function setServiceType($set)
    {
        $this->serviceType = $set;
        return $this;
    }

    public function getSpecificService()
    {
        return $this->specificService;
    }

    public function setSpecificService($set)
    {
        $this->specificService = $set;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($desc)
    {
        $this->description = $desc;
        return $this;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency($cur)
    {
        $this->currency = $cur;
        return $this;
    }

    public function getSumAssured()
    {
        return $this->sumAssured;
    }

    public function setSumAssured($sum)
    {
        $this->sumAssured;
        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($val)
    {
        $this->value = $val;
        return $this;
    }

    public function setValueType($type)
    {
        $this->valueType = $type;
        return $this;
    }

    public function getValueType()
    {
        return $this->valueType;
    }

    public function getPackagedInsurer()
    {
        return $this->packagedInsurer;
    }

    public function setPackagedInsurer($set)
    {
        $this->packagedInsurer = $set;
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

    public function setUpdatedOn($date)
    {
        $this->updatedOn = $date;
        return $this;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setIsActive($acct)
    {
        $this->isActive = $acct;
        return $this;
    }

    public function getAdditionalValue()
    {
        return $this->additionalValue;
    }

    public function setPackageUid($uid)
    {
        $this->packageUid = $uid;
        return $this;
    }

    public function getPackageUid()
    {
        return $this->packageUid;
    }

    /**
     *
     * @param PackageAdditionalValue $values            
     */
    public function addAdditionalValue(PackageAdditionalValue $values)
    {
        foreach ($values as $value) {
            $value->setPackages($this);
            $this->additionalValue[] = $value;
        }
    }

    public function removeAdditionalValue()
    {}

    public function getRecomendedCustomer()
    {
        return $this->recomendedCustomer;
    }

    public function addRecomendedCustomer(Customer $customers)
    {
        foreach ($customers as $customer) {}
    }

    public function setIsHidden($hide)
    {
        $this->isHidden = $hide;
        return $this;
    }

    public function getIsHidden()
    {
        return $this->isHidden;
    }

    public function setCoverDuration($dur)
    {
        $this->coverDuration = $dur;
        return $this;
    }

    public function getCoverDuration()
    {
        return $this->coverDuration;
    }

    public function getTermedDuration()
    {
        return $this->termedDuration;
    }

    public function setTermedDuration($term)
    {
        $this->termedDuration = $term;
        return $this;
    }
}

