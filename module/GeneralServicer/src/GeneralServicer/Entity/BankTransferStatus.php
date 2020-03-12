<?php
namespace GeneralServicer\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BankTransferStatus
 *
 * @ORM\Table(name="bank_transfer_status")
 * @ORM\Entity
 */
class BankTransferStatus
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
     *      @ORM\JoinColumn(name="transfer_status", referencedColumnName="id")
     *      })
     *     
     */
    private $trasferStatus;

    public function getId()
    {
        return $this->getId();
    }

    /**
     */
    public function getTransfeerStatus()
    {
        return $this->trasferStatus;
    }

    /**
     *
     * @param unknown $transfer            
     * @return \GeneralServicer\Entity\BankTransferStatus
     */
    public function setTransferStatus($transfer)
    {
        $this->trasferStatus = $transfer;
        return $this;
    }
}

?>