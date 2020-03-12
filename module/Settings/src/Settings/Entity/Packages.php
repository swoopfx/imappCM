<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Packages
 * This entity defines the packages for acquirinf the
 * @ORM\Table(name="packages", indexes={@ORM\Index(name="FK_terms_id_packages_idx", columns={"term_id"})})
 * @ORM\Entity
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
     *
     * @var string @ORM\Column(name="package_name", type="string", length=100, nullable=true)
     */
    private $packageName;
    
    // /**
    // *
    // * @var string @ORM\Column(name="package_price", type="string", nullable=false)
    // */
    // private $packagePrice;
    
    /**
     *
     * @var \Settings\Entity\PackageBasicCat @ORM\ManyToOne(targetEntity="Settings\Entity\PackageBasicCat")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="package_category_id", referencedColumnName="id")
     *      })
     */
    private $packageCategory;
    
    // /**
    // *
    // * @var \Settings\Entity\PackageBasics @ORM\ManyToOne(targetEntity="Settings\Entity\PackageBasics")
    // * @ORM\JoinColumns({
    // * @ORM\JoinColumn(name="package_basic_id", referencedColumnName="id")
    // * })
    // */
    // private $packageBasic;
    
    /**
     *
     * @var string @ORM\Column(name="package_desc", type="text", nullable=true)
     */
    private $packageDesc;

    /**
     *
     * @var integer @ORM\Column(name="max_employee", type="integer", nullable=true)
     */
    private $maxEmployee;

    /**
     *
     * @var boolean @ORM\Column(name="is_desktop", type="boolean", nullable=true)
     */
    private $isDesktop;

    /**
     *
     * @var boolean @ORM\Column(name="is_api", type="boolean", nullable=true)
     */
    private $isApi;
    
    /**
    *
    * @var boolean @ORM\Column(name="is_cutomer_policy_manage", type="boolean", nullable=true)
    */
    private $isCustomerPolicyManage;
    
    /**
    *
    * @var boolean @ORM\Column(name="is_manual_proposal", type="boolean", nullable=true)
    */
    private $isManualProposal;
    
    /**
    *
    * @var boolean @ORM\Column(name="is_payment_mapping", type="boolean", nullable=true)
    */
    private $isPaymentMapping;
    
    /**
    *
    * @var boolean @ORM\Column(name="is_reporting", type="boolean", nullable=true)
    */
    private $isReporting;
    
    /**
    *
    * @var boolean @ORM\Column(name="is_email_support", type="boolean", nullable=true)
    */
    private $isEmailSupport;
    
    /**
    *
    * @var boolean @ORM\Column(name="is_auto_proposal", type="boolean", nullable=true)
    */
    private $isAutoProposal;
    
    /**
    *
    * @var boolean @ORM\Column(name="is_payment_import", type="boolean", nullable=true)
    */
    private $isPaymentImport;
    
    /**
    *
    * @var boolean @ORM\Column(name="is_cutomer_import", type="boolean", nullable=true)
    */
    private $customerImport;
    
    /**
    * This is business Intelligence analytics
    *
    * @var boolean @ORM\Column(name="is_bi_analytics", type="boolean", nullable=true)
    */
    private $isBIAnalytics;
    
    /**
     *
     * @var boolean @ORM\Column(name="support_service", type="boolean", nullable=true)
     */
    private $supportService;

    /**
     *
     * @var \Settings\Entity\Terms @ORM\ManyToOne(targetEntity="Settings\Entity\Terms")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="term_id", referencedColumnName="id")
     *      })
     */
    private $term;
    
    /**
     * 
     * @var boolean @ORM\Column(name="is_mobile_app", type="boolean", nullable=true)
     */
    private $isMobileApp;
    
    /**
     * 
     * @var boolean @ORM\Column(name="price", type="string", nullable=true)
     */
    private $price ;
    
    /**
     * This is the number of sms associated with this package
     * @ORM\Column(name="sms", type="integer", nullable=true)
     * @var integer
     */
    private $sms;

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
     * Set packageName
     *
     * @param string $packageName            
     *
     * @return Packages
     */
    public function setPackageName($packageName)
    {
        $this->packageName = $packageName;
        
        return $this;
    }

    /**
     * Get packageName
     *
     * @return string
     */
    public function getPackageName()
    {
        return $this->packageName;
    }

    /**
     *
     * @param \Settings\Entity\PackageBasicCat $cat            
     */
    public function setPackageCat($cat)
    {
        $this->packageCategory = $cat;
        
        return $this;
    }

    /**
     *
     * @return \Settings\Entity\PackageBasicCat
     */
    public function getPackageCat()
    {
        return $this->packageCategory;
    }

    /**
     * Set packageDesc
     *
     * @param string $packageDesc            
     *
     * @return Packages
     */
    public function setPackageDesc($packageDesc)
    {
        $this->packageDesc = $packageDesc;
        
        return $this;
    }

    /**
     * Get packageDesc
     *
     * @return string
     */
    public function getPackageDesc()
    {
        return $this->packageDesc;
    }

    /**
     * Set maxEmployee
     *
     * @param integer $maxEmployee            
     *
     * @return Packages
     */
    public function setMaxEmployee($maxEmployee)
    {
        $this->maxEmployee = $maxEmployee;
        
        return $this;
    }

    /**
     * Get maxEmployee
     *
     * @return integer
     */
    public function getMaxEmployee()
    {
        return $this->maxEmployee;
    }

    /**
     * Set isDesktop
     *
     * @param boolean $isDesktop            
     *
     * @return Packages
     */
    public function setIsDesktop($isDesktop)
    {
        $this->isDesktop = $isDesktop;
        
        return $this;
    }

    /**
     * Get isDesktop
     *
     * @return boolean
     */
    public function getIsDesktop()
    {
        return $this->isDesktop;
    }

    /**
     * Set isApi
     *
     * @param boolean $isApi            
     *
     * @return Packages
     */
    public function setIsApi($isApi)
    {
        $this->isApi = $isApi;
        
        return $this;
    }

    /**
     * Get isApi
     *
     * @return boolean
     */
    public function getIsApi()
    {
        return $this->isApi;
    }

    public function setCustomerPolicyManage($po)
    {
        $this->isCustomerPolicyManage = $po;
        
        return $$this;
    }

    /**
     *
     * @return boolean
     */
    public function getCustomerPolicyManage()
    {
        return $this->isCustomerPolicyManage;
    }

    public function setManualProposal($mp)
    {
        $this->isManualProposal = $mp;
        return $this;
    }

    public function getManualProposal()
    {
        return $this->isManualProposal;
    }

    public function setPaymentMapping($pm)
    {
        $this->isPaymentMapping = $pm;
        return $this;
    }

    public function getPaymentMapping()
    {
        return $this->isPaymentMapping;
    }

    public function setReporting($report)
    {
        $this->isReporting = $report;
        return $this;
    }

    public function getReporting()
    {
        return $this->isReporting;
    }

    public function setEmailSupport($email)
    {
        $this->isEmailSupport = $email;
        return $this;
    }

    public function getEmailSupport()
    {
        return $this->isEmailSupport;
    }

    public function setAutoProposal($pro)
    {
        $this->isAutoProposal = $pro;
        return $this;
    }

    public function getAutoProposal()
    {
        return $this->isAutoProposal;
    }

    public function setCustomerImport($im)
    {
        $this->customerImport = $im;
        return $this;
    }

    public function getCustomerImport()
    {
        return $this->customerImport;
    }

    public function setBIAnalytics($bi)
    {
        $this->isBIAnalytics = $bi;
        return $this;
    }

    public function getBIAnalytics()
    {
        return $this->isBIAnalytics;
    }

    /**
     * Set supportService
     *
     * @param boolean $supportService            
     *
     * @return Packages
     */
    public function setSupportService($supportService)
    {
        $this->supportService = $supportService;
        
        return $this;
    }

    /**
     * Get supportService
     *
     * @return boolean
     */
    public function getSupportService()
    {
        return $this->supportService;
    }

    /**
     * Set term
     *
     * @param \Settings\Entity\Terms $term            
     *
     * @return Packages
     */
    public function setTerm(\Settings\Entity\Terms $term = null)
    {
        $this->term = $term;
        
        return $this;
    }

    /**
     * Get term
     *
     * @return \Settings\Entity\Terms
     */
    public function getTerm()
    {
        return $this->term;
    }
    
    public function getIsMobileApp(){
        return $this->isMobileApp ;
    }
    
    public function setIsMobileApp($isMo){
        $this->isMobileApp = $isMo;
        
        return $this;
    }
    
    public function getPrice(){
        return $this->price;
        
    }
    
    public function setPrice($price){
        $this->price = $price ;
        
        return $this;
    }
    
    public function setSms($sms){
        $this->sms = $sms;
        return $this;
    }
    
    public function getSms(){
        return $this->sms;
    }
}
