<?php
namespace Users\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IndividualContact
 *
 * @ORM\Table(name="individual_contact")
 * @ORM\Entity
 */
class IndividualContact
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
     * @var string @ORM\Column(name="address1", type="string", length=100, nullable=true)
     */
    private $address1;

    /**
     *
     * @var string @ORM\Column(name="address2", type="string", length=100, nullable=true)
     */
    private $address2;

    /**
     *
     * @var string @ORM\Column(name="city", type="string", length=45, nullable=true)
     */
    private $city;

    /**
     *
     * @var string @ORM\Column(name="postal_code", type="string", length=16, nullable=true)
     */
    private $postalCode;

    /**
     *
     * @var string @ORM\Column(name="phone_country_code", type="string", length=45, nullable=true)
     */
    private $phoneCountryCode;

    /**
     *
     * @var string @ORM\Column(name="phone_number1", type="string", length=45, nullable=true)
     */
    private $phoneNumber1;

    /**
     *
     * @var string @ORM\Column(name="fax_country_code", type="string", length=45, nullable=true)
     */
    private $faxCountryCode;

    /**
     *
     * @var string @ORM\Column(name="fax_area_code", type="string", length=45, nullable=true)
     */
    private $faxAreaCode;

    /**
     *
     * @var string @ORM\Column(name="fax_phone_number", type="string", length=45, nullable=true)
     */
    private $faxPhoneNumber;

    /**
     *
     * @var integer @ORM\Column(name="created_date", type="datetime", nullable=true)
     */
    private $createdDate;

    /**
     *
     * @var integer @ORM\Column(name="updated_date", type="datetime", nullable=true)
     */
    private $updatedDate;
    
    // private $individual;
    
    /**
     *
     * @var \Settings\Entity\Country @ORM\ManyToOne(targetEntity="Settings\Entity\Country")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     *      })
     *      Make default be Nigeria
     */
    private $country;

    /**
     *
     * @var \Settings\Entity\Zone @ORM\ManyToOne(targetEntity="Settings\Entity\Zone")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="state_province_id", referencedColumnName="id")
     *      })
     */
    private $stateProvince;

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
     * Set address1
     *
     * @param string $address1            
     * @return IndividualContact
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
     * @return IndividualContact
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
     * Set city
     *
     * @param string $city            
     * @return IndividualContact
     */
    public function setCity($city)
    {
        $this->city = $city;
        
        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode            
     * @return IndividualContact
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
        
        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set phoneCountryCode
     *
     * @param string $phoneCountryCode            
     * @return IndividualContact
     */
    public function setPhoneCountryCode($phoneCountryCode)
    {
        $this->phoneCountryCode = $phoneCountryCode;
        
        return $this;
    }

    /**
     * Get phoneCountryCode
     *
     * @return string
     */
    public function getPhoneCountryCode()
    {
        return $this->phoneCountryCode;
    }

    /**
     * Set phoneNumber1
     *
     * @param string $phoneNumber1            
     * @return IndividualContact
     */
    public function setPhoneNumber1($phoneNumber1)
    {
        $this->phoneNumber1 = $phoneNumber1;
        
        return $this;
    }

    /**
     * Get phoneNumber1
     *
     * @return string
     */
    public function getPhoneNumber1()
    {
        return $this->phoneNumber1;
    }

    /**
     * Set faxCountryCode
     *
     * @param string $faxCountryCode            
     * @return IndividualContact
     */
    public function setFaxCountryCode($faxCountryCode)
    {
        $this->faxCountryCode = $faxCountryCode;
        
        return $this;
    }

    /**
     * Get faxCountryCode
     *
     * @return string
     */
    public function getFaxCountryCode()
    {
        return $this->faxCountryCode;
    }

    /**
     * Set faxAreaCode
     *
     * @param string $faxAreaCode            
     * @return IndividualContact
     */
    public function setFaxAreaCode($faxAreaCode)
    {
        $this->faxAreaCode = $faxAreaCode;
        
        return $this;
    }

    /**
     * Get faxAreaCode
     *
     * @return string
     */
    public function getFaxAreaCode()
    {
        return $this->faxAreaCode;
    }

    /**
     * Set faxPhoneNumber
     *
     * @param string $faxPhoneNumber            
     * @return IndividualContact
     */
    public function setFaxPhoneNumber($faxPhoneNumber)
    {
        $this->faxPhoneNumber = $faxPhoneNumber;
        
        return $this;
    }

    /**
     * Get faxPhoneNumber
     *
     * @return string
     */
    public function getFaxPhoneNumber()
    {
        return $this->faxPhoneNumber;
    }

    /**
     * Set createdDate
     *
     * @param integer $createdDate            
     * @return IndividualContact
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
        
        return $this;
    }

    /**
     * Get createdDate
     *
     * @return integer
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set updatedDate
     *
     * @param integer $updatedDate            
     * @return IndividualContact
     */
    public function setUpdatedDate($updatedDate)
    {
        $this->updatedDate = $updatedDate;
        
        return $this;
    }

    /**
     * Get updatedDate
     *
     * @return integer
     */
    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }
    
    // /**
    // * Set individual
    // *
    // * @param \Users\Entity\IndividualInfo $individual
    // * @return IndividualContact
    // */
    // public function setIndividual(\Users\Entity\IndividualInfo $individual = null)
    // {
    // $this->individual = $individual;
    
    // return $this;
    // }
    
    // /**
    // * Get individual
    // *
    // * @return \Users\Entity\IndividualInfo
    // */
    // public function getIndividual()
    // {
    // return $this->individual;
    // }
    
    /**
     * Set country
     *
     * @param \Settings\Entity\Country $country            
     * @return IndividualContact
     */
    public function setCountry(\Settings\Entity\Country $country = null)
    {
        $this->country = $country;
        
        return $this;
    }

    /**
     * Get country
     *
     * @return \Settings\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set stateProvince
     *
     * @param \Settings\Entity\Zone $stateProvince            
     * @return IndividualContact
     */
    public function setStateProvince(\Settings\Entity\Zone $stateProvince = null)
    {
        $this->stateProvince = $stateProvince;
        
        return $this;
    }

    /**
     * Get stateProvince
     *
     * @return \Work\Entity\Zone
     */
    public function getStateProvince()
    {
        return $this->stateProvince;
    }
}
