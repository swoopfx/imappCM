<?php
namespace Messages\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\Status;

/**
 * @ORM\Entity
 * @ORM\Table(name="message_status")
 * 
 * @author otaba
 *        
 */
class MessageStatus
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
     * @var \Settings\Entity\Status @ORM\OneToOne(targetEntity="Settings\Entity\Status")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="status", referencedColumnName="id")
     *      })
     *     
     */
    private $status;

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

    public function setStatu($id)
    {
        $this->status = $id;
        return $this;
    }
}

