<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AgentThirdPartyValue
 *
 * @ORM\Table(name="agent_third_party_value")
 * @ORM\Entity
 */
class AgentThirdPartyValue
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
     * @var integer @ORM\Column(name="agent_id", type="integer", nullable=false)
     */
    private $agentId;

    /**
     *
     * @var string @ORM\Column(name="value", type="string", length=45, nullable=false)
     */
    private $value;

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
     * Set agentId
     *
     * @param integer $agentId            
     *
     * @return AgentThirdPartyValue
     */
    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
        
        return $this;
    }

    /**
     * Get agentId
     *
     * @return integer
     */
    public function getAgentId()
    {
        return $this->agentId;
    }

    /**
     * Set value
     *
     * @param string $value            
     *
     * @return AgentThirdPartyValue
     */
    public function setValue($value)
    {
        $this->value = $value;
        
        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}
