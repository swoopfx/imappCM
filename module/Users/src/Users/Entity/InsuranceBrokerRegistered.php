<?php
namespace Users\Entity;

use Doctrine\ORM\Mapping as ORM;
// use GeneralServicer\Entity\BrokerUid;
use Doctrine\Common\Collections\Collection;
use GeneralServicer\Entity\Document;
use Settings\Entity\Country;
use Settings\Entity\Zone;
use GeneralServicer\Entity\BrokerChild;
use Transactions\Entity\Invoice;
use SMS\Entity\SMSBroker;
use Customer\Entity\CustomerBroker;
use Doctrine\Common\Collections\ArrayCollection;
use Transactions\Entity\BrokerFlutterwaveAccount;
use GeneralServicer\Entity\BrokerSubscription;
use SMS\Entity\SMSAccount;
use Claims\Entity\Claims;
// use Packages\Form\FeaturedPackageForm;
use Packages\Entity\FeaturedPackages;
use Transactions\Entity\BrokerPayStackAccount;

/**
 * InsuranceBrokerRegistered
 *
 * @ORM\Table(name="insurance_broker_registered")
 * @ORM\Entity
 */
class InsuranceBrokerRegistered
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     *
     * @var Document @ORM\OneToOne(targetEntity="GeneralServicer\Entity\Document")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="company_logo", referencedColumnName="id")
     *      })
     */
    private $companyLogo;

    /**
     *
     * @var string @ORM\Column(name="broker_email", type="string", length=500, nullable=true)
     */
    private $brokerEmail;

    /**
     *
     * @var string @ORM\Column(name="broker_website", type="string", length=500, nullable=true)
     */
    private $brokerWebsite;

    /**
     *
     * @var string @ORM\Column(name="official_phone", type="string", nullable=true)
     */
    private $officialPhone;

    /**
     *
     * @var string @ORM\Column(name="broker_profile", type="text", nullable=true)
     */
    private $brokerProfile;

    /**
     *
     * @var \DateTime @ORM\Column(name="date_entered", type="datetime", nullable=true)
     */
    private $dateEntered;

    /**
     *
     * @var \DateTime @ORM\Column(name="date_modified", type="datetime", nullable=true)
     */
    private $dateModified;

    /**
     *
     * @var boolean @ORM\Column(name="is_broker_verified", type="boolean", nullable=true)
     */
    private $isBrokerVerified = '0';

    /**
     *
     * @ORM\Column(name="phone", type="string", nullable=true)
     *
     * @var string
     */
    private $phone;

    /**
     *
     * @var \Settings\Entity\InsuranceBrokerAvailable @ORM\OneToOne(targetEntity="Settings\Entity\InsuranceBrokerAvailable")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="id_indurance_boker", referencedColumnName="id")
     *      })
     */
    private $idInduranceBoker;

    /**
     *
     * @var \CsnUser\Entity\User @ORM\OneToOne(targetEntity="CsnUser\Entity\User", cascade={"persist", "remove"})
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *      })
     */
    private $user;

    /**
     *
     * @var string @ORM\Column(name="address1", type="string", length=45, nullable=true)
     */
    private $address1;

    /**
     *
     * @var string @ORM\Column(name="address2", type="string", length=45, nullable=true)
     */
    private $address2;

    /**
     *
     * @var string @ORM\Column(name="zip_code", type="string", length=11, nullable=true)
     */
    private $zipCode;

    /**
     *
     * @var \Settings\Entity\Country @ORM\ManyToOne(targetEntity="Settings\Entity\Country")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="country", referencedColumnName="id")
     *      })
     */
    private $country;

    /**
     *
     * @var \Settings\Entity\Zone @ORM\ManyToOne(targetEntity="Settings\Entity\Zone")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="state", referencedColumnName="id")
     *      })
     */
    private $state;

    /**
     * This is a unique identifeir for the broker that determines the each broker
     *
     * @ORM\Column(name="broker_uid", type="string", nullable=false, unique=true)
     *
     * @var string
     */
    private $brokerUid;

    /**
     *
     * @ORM\OneToOne(targetEntity="GeneralServicer\Entity\BrokerSubscription", mappedBy="broker", cascade={"persist", "remove"})
     *
     * @var BrokerSubscription
     */
    private $subscription;

    /**
     * This is the code used to verify other sub brokers
     *
     * @var string @ORM\Column(name="activation_code", type="string", nullable=false)
     */
    private $activationCode;

    /**
     *
     * @ORM\OneToMany(targetEntity="GeneralServicer\Entity\BrokerChild", mappedBy="broker", cascade={"persist", "remove"})
     *
     * @var BrokerChild
     */
    private $brokerChild;

    /**
     *
     * @ORM\OneToOne(targetEntity="SMS\Entity\SMSAccount", mappedBy="broker", cascade={"persist", "remove"})
     *
     * @var SMSAccount
     */
    private $smsBroker;

    /**
     *
     * @ORM\OneToMany(targetEntity="Customer\Entity\CustomerBroker", mappedBy="broker")
     *
     * @var CustomerBroker
     */
    private $customers;

    /**
     *
     * @ORM\OneToOne(targetEntity="Users\Entity\BrokerBankAccount")
     *
     * @var BrokerBankAccount
     */
    private $brokerBankAccount;

    /**
     *
     * @ORM\OneToOne(targetEntity="Transactions\Entity\BrokerFlutterwaveAccount", mappedBy="broker")
     *
     * @var BrokerFlutterwaveAccount
     */
    private $brokerFlutterwaveAccount;

    /**
     *
     * @ORM\OneToOne(targetEntity="Transactions\Entity\BrokerPayStackAccount", mappedBy="broker")
     *
     * @var BrokerPayStackAccount
     */
    private $brokerPayStackAccount;

    /**
     *
     * @ORM\OneToOne(targetEntity="Packages\Entity\FeaturedPackages", mappedBy="broker")
     *
     * @var FeaturedPackages
     */
    private $featuredPackages;

    /**
     *
     * @ORM\OneToOne(targetEntity="Users\Entity\BrokerCeo", mappedBy="broker")
     *
     * @var BrokerCeo
     */
    private $ceo;

    /**
     *
     * @ORM\OneToOne(targetEntity="Users\Entity\BrokerActivation", cascade={"persist", "remove"})
     *
     * @var BrokerActivation
     */
    private $brokerActivation;

    // /**
    // * @ORM\OneToMany(targetEntity="")
    // */
    // private $claims;

    // /**
    // * @ORM\OneToMany(targetEntity="Transactions\Entity\BrokerCustomerInvoice", mappedBy="broker", cascade={"persist", "remove"})
    // * @var Invoice
    // */
    // private $brokerCustomerInvoice;
    public function __construct()
    {
        $this->brokerTelephone = new \Doctrine\Common\Collections\ArrayCollection();
        $this->customers = new ArrayCollection();
        $this->claims = new ArrayCollection();
        // $this->brokerBankAccount = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set companyLogo
     *
     * @param Document $companyLogo
     * @return InsuranceBrokerRegistered
     */
    public function setCompanyLogo($companyLogo)
    {
        $this->companyLogo = $companyLogo;

        return $this;
    }

    /**
     * Get companyLogo
     *
     * @return string
     */
    public function getCompanyLogo()
    {
        return $this->companyLogo;
    }

    /**
     *
     * @return string
     */
    public function getBrokerEmail()
    {
        return $this->brokerEmail;
    }

    /**
     *
     * @param string $email
     * @return \Users\Entity\InsuranceBrokerRegistered
     */
    public function setBrokerEmail($email)
    {
        $this->brokerEmail = $email;
        return $this;
    }

    public function getBrokerWebsite()
    {
        return $this->brokerWebsite;
    }

    public function setBrokerWebsite($web)
    {
        $this->brokerWebsite = $web;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getOfficialPhone()
    {
        return $this->officialPhone;
    }

    /**
     *
     * @param string $phone
     * @return \Users\Entity\InsuranceBrokerRegistered
     */
    public function setOfficialPhone($phone)
    {
        $this->officialPhone = $phone;

        return $this;
    }

    /**
     * Set brokerProfile
     *
     * @param string $brokerProfile
     * @return InsuranceBrokerRegistered
     */
    public function setBrokerProfile($brokerProfile)
    {
        $this->brokerProfile = $brokerProfile;

        return $this;
    }

    /**
     * Get brokerProfile
     *
     * @return string
     */
    public function getBrokerProfile()
    {
        return $this->brokerProfile;
    }

    public function getAddress()
    {
        return $this->address1 . " " . $this->address2 . " " . $this->state->getZoneName() . " ";
    }

    /**
     * Set address1
     *
     * @param string $address1
     *            // * @return BrokerAddress
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * Get address1
     *
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set address2
     *
     * @param string $address2
     *            // * @return BrokerAddress
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get address2
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     *            // * @return BrokerAddress
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set country
     *
     * @param integer $country
     *            // * @return BrokerAddress
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set state
     *
     * @param integer $state
     *
     * @return Zone
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return Zone
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set email
     *
     * @param string $email
     *            // * @return BrokerAddress
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set dateEntered
     *
     * @param \DateTime $dateEntered
     * @return InsuranceBrokerRegistered
     */
    public function setDateEntered($dateEntered)
    {
        $this->dateEntered = $dateEntered;
        $this->dateModified = $dateEntered;

        return $this;
    }

    /**
     * Get dateEntered
     *
     * @return \DateTime
     */
    public function getDateEntered()
    {
        return $this->dateEntered;
    }

    /**
     * Set dateModified
     *
     * @param \DateTime $dateModified
     * @return InsuranceBrokerRegistered
     */
    public function setDateModified($dateModified)
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    /**
     * Get dateModified
     *
     * @return \DateTime
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }

    /**
     * Set isBrokerVerified
     *
     * @param boolean $isBrokerVerified
     * @return InsuranceBrokerRegistered
     */
    public function setIsBrokerVerified($isBrokerVerified)
    {
        $this->isBrokerVerified = $isBrokerVerified;

        return $this;
    }

    /**
     * Get isBrokerVerified
     *
     * @return boolean
     */
    public function getIsBrokerVerified()
    {
        return $this->isBrokerVerified;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    public function setBrokerUid($uid)
    {
        $this->brokerUid = $uid;
        return $this;
    }

    public function getBrokerUid()
    {
        return $this->brokerUid;
    }

    /**
     * Set idInduranceBoker
     *
     * // * @param \Work\Entity\InsuranceBrokerAvailable $idInduranceBoker
     *
     * @return InsuranceBrokerRegistered
     */
    public function setIdInduranceBoker(\Settings\Entity\InsuranceBrokerAvailable $idInduranceBoker = null)
    {
        $this->idInduranceBoker = $idInduranceBoker;

        return $this;
    }

    /**
     * Get idInduranceBoker
     *
     * @return \Settings\Entity\InsuranceBrokerAvailable
     */
    public function getIdInduranceBoker()
    {
        return $this->idInduranceBoker;
    }

    /**
     * Set user
     *
     * @param \CsnUser\Entity\User $user
     * @return InsuranceBrokerRegistered
     */
    public function setUser(\CsnUser\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \CsnUser\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    // begin custome Entity
    public function setBrokerName($broker)
    {
        $this->brokerName = $this->getIdInduranceBoker()->getCompanyName();
        return $this;
    }

    public function getBrokerName()
    {
        return $this->idInduranceBoker->getCompanyName();
    }

    public function getBrokerAddress()
    {
        return $this->address1 . " " . $this->address2;
    }

    public function getActivationCode()
    {
        return $this->activationCode;
    }

    public function setActivationCode($code)
    {
        $this->activationCode = $code;
        return $this;
    }

    /**
     * // * @return \Users\Entity\BrokerSubscription
     */
    public function getSubscription()
    {
        return $this->subscription;
    }

    public function setSubscription($ss)
    {
        $this->subscription = $ss;
        return $this;
    }

    // public function getBankAccount()
    // {
    // return $this->bankAccount;
    // }
    public function getBrokerTelephone()
    {
        return $this->brokerTelephone;
    }

    // /**
    // *
    // * @param BrokerTelephone $broker
    // */
    // public function addBrokerTelephone($broker)
    // {
    // $this->brokerTelephone[] = $broker;
    // return $this;
    // }
    public function removeBrokerTelephone($broker)
    {
        return $this;
    }

    /**
     *
     * @param Collection $brokers
     */
    public function addBrokerTelePhones(Collection $brokers)
    {
        // foreach ($brokers as $broker) {
        // $this->addBrokerTelephone($broker);
        // }
        return $this;
    }

    public function getCompanyName()
    {
        return $this->idInduranceBoker->getCompanyName();
    }

    public function getInvoice()
    {
        return $this->invoice;
    }

    public function setInvoice($inv)
    {
        $this->invoice = $inv;
    }

    public function addInvoice()
    {}

    public function removeInvoice()
    {}

    public function getSmsBroker()
    {
        return $this->smsBroker;
    }

    public function getCustomers()
    {
        return $this->customers;
    }

    public function addCustomers($customers)
    {
        foreach ($customers as $customer) {
            $this->customers[] = $customer;
        }
    }

    public function removeCustomers()
    {}

    public function getBrokerBankAccount()
    {
        return $this->brokerBankAccount;
    }

    public function setBrokerBankAccount($brokerBankAccount)
    {
        $this->brokerBankAccount = $brokerBankAccount;
        return $this;
    }

    // public function addBrokerBankAccount($brokerBankAccount)
    // {
    // if ($this->brokerBankAccount->contains($brokerBankAccount)) {
    // return;
    // }
    // $brokerBankAccount->setBroker($this);
    // $this->brokerBankAccount[] = $brokerBankAccount;
    // }

    // public function removeBrokerBankAccount($brokerBankAccount)
    // {
    // $this->brokerBankAccount->removeElement($brokerBankAccount);
    // }
    public function getBrokerFlutterwaveAccount()
    {
        return $this->brokerFlutterwaveAccount;
    }

    public function getBrokerPayStackAccount()
    {
        return $this->brokerPayStackAccount;
    }

    public function setBrokerPayStackAccount($brk)
    {
        $this->brokerPayStackAccount = $brk;
        return $this;
    }

    public function getFeaturedPackages()
    {
        return $this->featuredPackages;
    }

    public function getCeo()
    {
        return $this->ceo;
    }

    public function setCeo($ceo)
    {
        $this->ceo = $ceo;
        return $this;
    }

    public function getBrokerActivation()
    {
        return $this->brokerActivation;
    }

    public function setBrokerActivation($act)
    {
        $this->brokerActivation = $act;
        return $this;
    }

    // public function getCLaims(){
    // return $this->claims;
    // }

    // public function addClaims(Claims $claim){
    // if(!$this->claims->contains($claim)){
    // $this->claims->add($claim);
    // }

    // return $this;
    // }

    // public function removeClaims(Claims $claim){
    // if($this->claims->contains($claim)){
    // $this->claims->removeElement($claim);

    // }

    // return $this;
    // }

    /**
     *
     * @return string $phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     *
     * @return string $brokerChild
     */
    public function getBrokerChild()
    {
        return $this->brokerChild;
    }
}
