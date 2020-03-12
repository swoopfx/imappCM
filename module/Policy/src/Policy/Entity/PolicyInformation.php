<?php
namespace Policy\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PolicyInformation
 *
 * @ORM\Table(name="policy_information", indexes={@ORM\Index(name="FK_policy_info_policy_idx", columns={"policy_id"})})
 * @ORM\Entity
 */
class PolicyInformation
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
     * @var string @ORM\Column(name="policy_info", type="text", nullable=true)
     */
    private $policyInfo;

    /**
     *
     * @var \Policy\Entity\Policy @ORM\ManyToOne(targetEntity="Policy\Entity\Policy")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="policy_id", referencedColumnName="id")
     *      })
     */
    private $policy;

    /**
     * Get idpolicyInformation
     *
     * @return integer
     */
    public function getIdpolicyInformation()
    {
        return $this->idpolicyInformation;
    }

    /**
     * Set policyInfo
     *
     * @param string $policyInfo            
     *
     * @return PolicyInformation
     */
    public function setPolicyInfo($policyInfo)
    {
        $this->policyInfo = $policyInfo;
        
        return $this;
    }

    /**
     * Get policyInfo
     *
     * @return string
     */
    public function getPolicyInfo()
    {
        return $this->policyInfo;
    }

    /**
     * Set policy
     *
     * @param \All\Entity\Policy $policy            
     *
     * @return PolicyInformation
     */
    public function setPolicy(\All\Entity\Policy $policy = null)
    {
        $this->policy = $policy;
        
        return $this;
    }

    /**
     * Get policy
     *
     * @return \All\Entity\Policy
     */
    public function getPolicy()
    {
        return $this->policy;
    }
}
