<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;
use Users\Entity\InsuranceBrokerRegistered;
use Wallet\Entity\Wallet;

/**
 * This provides information about transfer of payment
 *
 * @ORM\Entity
 * @ORM\Table(name="broker_transfer")
 *
 * @author otaba
 *        
 */
class BrokerTransfer
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
     *
     * @ORM\Column(name="transfer_reference", type="string", nullable=true, unique=true)
     *
     * @var string
     */
    private $transferReference;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered")
     *
     * @var InsuranceBrokerRegistered
     */
    private $broker;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Transactions\Entity\BrokerTransferStatus")
     *
     * @var BrokerTransferStatus
     */
    private $status;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Wallet\Entity\Wallet")
     * @var Wallet
     */
    private $wallet;

    /**
     */
    public function __construct()
    {

        // TODO - Insert your code here
    }

    /**
     *
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return object $transferReference
     */
    public function getTransferReference()
    {
        return $this->transferReference;
    }

    /**
     *
     * @return object $broker
     */
    public function getBroker()
    {
        return $this->broker;
    }

    /**
     *
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @param string $transferReference
     */
    public function setTransferReference($transferReference)
    {
        $this->transferReference = $transferReference;
        return $this;
    }

    /**
     *
     * @param \Users\Entity\InsuranceBrokerRegistered $broker
     */
    public function setBroker($broker)
    {
        $this->broker = $broker;
        return $this;
    }

    /**
     *
     * @return object $status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     *
     * @param \Transactions\Entity\BrokerTransferStatus $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
    /**
     * @return \Wallet\Entity\Wallet
     */
    public function getWallet()
    {
        return $this->wallet;
    }

    /**
     * @param \Wallet\Entity\Wallet $wallet
     */
    public function setWallet($wallet)
    {
        $this->wallet = $wallet;
        return $this;
    }

}

