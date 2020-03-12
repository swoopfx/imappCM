<?php
namespace Policy\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\Status;

/**
 * PolicyStatus
 *
 * @ORM\Table(name="policy_status")
 * @ORM\Entity
 */
class PolicyStatus
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
    
    
//     private $isChangeable;

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
     * Set status
     *
     * @param integer $status            
     *
     * @return PolicyStatus
     */
    public function setStatus($status)
    {
        $this->status = $status;
        
        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }
}
