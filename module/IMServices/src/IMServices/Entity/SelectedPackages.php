<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SelectedPackages
 * This actuaally defines the package seleted by the user of the application
 * The main categories are only agents and brokers as user
 * @ORM\Table(name="selected_packages")
 * @ORM\Entity
 */
class SelectedPackages
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
     * @var \CsnUser\Entity\User @ORM\ManyToOne(targetEntity="CsnUser\Entity\User")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *      })
     */
    private $user;

    /**
     *
     * @var \Users\Entity\InsuranceBrokerRegistered @ORM\ManyToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="broker_id", referencedColumnName="id")
     *      })
     */
    private $broker;

    /**
     *
     * @var \Settings\Entity\Packages @ORM\ManyToOne(targetEntity="Settings\Entity\Packages")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="package_id", referencedColumnName="id")
     *      })
     */
    private $package;

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
     * Set user
     *
     * @param \All\Entity\User $user            
     *
     * @return SelectedPackages
     */
    public function setUser(\All\Entity\User $user = null)
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

    /**
     * Set broker
     *
     * @param \All\Entity\InsuranceBrokerRegistered $broker            
     *
     * @return SelectedPackages
     */
    public function setBroker(\All\Entity\InsuranceBrokerRegistered $broker = null)
    {
        $this->broker = $broker;
        
        return $this;
    }

    /**
     * Get broker
     *
     * @return \All\Entity\InsuranceBrokerRegistered
     */
    public function getBroker()
    {
        return $this->broker;
    }

    /**
     * Set agent
     *
     * @param \All\Entity\InsuranceAgentRegistered $agent            
     *
     * @return SelectedPackages
     */
    public function setAgent(\All\Entity\InsuranceAgentRegistered $agent = null)
    {
        $this->agent = $agent;
        
        return $this;
    }

    /**
     * Get agent
     *
     * @return \All\Entity\InsuranceAgentRegistered
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * Set package
     *
     * @param \All\Entity\Packages $package            
     *
     * @return SelectedPackages
     */
    public function setPackage(\All\Entity\Packages $package = null)
    {
        $this->package = $package;
        
        return $this;
    }

    /**
     * Get package
     *
     * @return \All\Entity\Packages
     */
    public function getPackage()
    {
        return $this->package;
    }
}
