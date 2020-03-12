<?php
namespace Policy\Entity;


use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\Status;

/**
 * @ORM\Entity
 * @ORM\Table(name="policy_hook_status")
 * @author otaba
 *
 */
class PolicyHookStatus
{
    
    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Status")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="status", referencedColumnName="id")
     *      })
     * @var Status
     */
    private $status;

    // TODO - Insert your code here
    public function __construct()
    {

        // TODO - Insert your code here
    }
    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \Settings\Entity\Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param \Settings\Entity\Status $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

}

