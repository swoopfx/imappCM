<?php
namespace Users\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @author swoopfx
 *         @ORM\Table(name="agent_telephone")
 *         @ORM\Entity
 */
class AgentTelephone
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
     * @var string @ORM\Column(name="agent_telephone", type="string", length=45, nullable=false)
     */
    private $agentTelephone;

    /**
     *
     * @var \Users\Entity\AgentAddress @ORM\ManyToOne(targetEntity="Users\Entity\AgentAddress")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="broker_address_id", referencedColumnName="id")
     *      })
     */
    private $agentAddress;
}

?>