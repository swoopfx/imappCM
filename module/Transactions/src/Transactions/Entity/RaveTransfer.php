<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class pptovides status for the transfer of
 * and provides a platform to monitor the transfer of a fund
 * @ORM\Entity
 * @ORM\Table(name="rave_transfer")
 * 
 * @author otaba
 *        
 */
class RaveTransfer
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
     * @ORM\ManyToOne(targetEntity="Transactions\Entity\RaveTransferStatus")
     * 
     * @var RaveTransferStatus
     */
    private $status;

    /**
     * @ORM\Column(name="reference", type="string", nullable=true)
     * 
     * @var string
     */
    private $reference;

    /**
     * @ORM\Column(name="transfer_id", type="string", nullable=true)
     * 
     * @var string
     */
    private $transferId;

    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $createdOn;

    /**
     * @ORM\Column(name="updated_on", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $updatedOn;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($stat)
    {
        $this->status = $stat;
        return $this;
    }

    public function getReference()
    {
        return $this->reference;
    }

    public function setReference($ref)
    {
        $this->reference = $ref;
        return $this;
    }

    public function getTransferId()
    {
        return $this->transferId;
    }

    public function setTransferId($id)
    {
        $this->transferId = $id;
        return $this;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function setCreatedOn($date)
    {
        $this->createdOn = $date;
        $this->updatedOn = $date;
        return $this;
    }

    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    public function setUpdatedOn($date)
    {
        $this->updatedOn = $date;
        return $this;
    }
}

