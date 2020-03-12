<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * this includes
 * INITIATED, SUCCESS, FAILED
 * @ORM\Entity
 * @ORM\Table(name="rave_transfer_status")
 * 
 * @author otaba
 *        
 */
class RaveTransferStatus
{

    /**
     *
     * @var integer This is only genertated upon successful transaction
     *      @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="status", type="string", nullable=false)
     * 
     * @var string
     */
    private $status;

    /**
     */
    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($ats)
    {
        $this->status = $ats;
        return $this;
    }
}

