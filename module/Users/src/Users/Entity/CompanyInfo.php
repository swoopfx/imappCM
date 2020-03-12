<?php
namespace Users\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompanyInfo
 *
 * @ORM\Table(name="company_info", uniqueConstraints={@ORM\UniqueConstraint(name="user_id_UNIQUE", columns={"user_id"})})
 * @ORM\Entity
 */
class CompanyInfo
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
     * @var string @ORM\Column(name="company_name", type="string", length=200, nullable=false)
     */
    private $companyName;

    /**
     *
     * @var string @ORM\Column(name="company_desc", type="text", nullable=true)
     */
    private $companyDesc;

    /**
     *
     * @var integer @ORM\Column(name="created_on", type="integer", nullable=true)
     */
    private $createdOn;

    /**
     *
     * @var integer @ORM\Column(name="updated_on", type="integer", nullable=true)
     */
    private $updatedOn;

    /**
     *
     * @var \CsnUser\Entity\User @ORM\OneToOne(targetEntity="CsnUser\Entity\User")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *      })
     */
    private $user;

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
     * Set companyName
     *
     * @param string $companyName            
     *
     * @return CompanyInfo
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
        
        return $this;
    }

    /**
     * Get companyName
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set companyDesc
     *
     * @param string $companyDesc            
     *
     * @return CompanyInfo
     */
    public function setCompanyDesc($companyDesc)
    {
        $this->companyDesc = $companyDesc;
        
        return $this;
    }

    /**
     * Get companyDesc
     *
     * @return string
     */
    public function getCompanyDesc()
    {
        return $this->companyDesc;
    }

    /**
     * Set createdOn
     *
     * @param integer $createdOn            
     *
     * @return CompanyInfo
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
        
        return $this;
    }

    /**
     * Get createdOn
     *
     * @return integer
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set updatedOn
     *
     * @param integer $updatedOn            
     *
     * @return CompanyInfo
     */
    public function setUpdatedOn($updatedOn)
    {
        $this->updatedOn = $updatedOn;
        
        return $this;
    }

    /**
     * Get updatedOn
     *
     * @return integer
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    /**
     * Set user
     *
     * @param \All\Entity\User $user            
     *
     * @return CompanyInfo
     */
    public function setUser(\CsnUser\Entity\User $user = null)
    {
        $this->user = $user;
        
        return $this;
    }

    /**
     * Get user
     *
     * @return \All\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
