<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="broker_transfer_details")
 *
 * @author otaba
 *        
 */
class BrokerTransferDetails
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
     * @ORM\Column(name="response_id", type="string", nullable=true)
     *
     * @var string
     */
    private $responseId;

    /**
     * @ORM\Column(name="acc_number", type="string", nullable=true)
     *
     * @var string
     */
    private $accNumber;

    /**
     * @ORM\Column(name="acc_name", type="string", nullable=true)
     *
     * @var string
     */
    private $accName;

    /**
     * @ORM\Column(name="response_status", type="string", nullable=true)
     *
     * @var string
     */
    private $responseStatus;

    /**
     * @ORM\Column(name="is_approved", type="string", nullable=true)
     *
     * @var string
     */
    private $isApproved;

    /**
     * @ORM\Column(name="date_entered", type="string", nullable=true)
     *
     * @var string
     */
    private $dateEntered;

    /**
     * @ORM\ManyToone(targetEntity="BrokerTransfer")
     *
     * @var BrokerTransfer
     */
    private $brokerTransfer;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    /**
     *
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return the $responseId
     */
    public function getResponseId()
    {
        return $this->responseId;
    }

    /**
     *
     * @return the $accNumber
     */
    public function getAccNumber()
    {
        return $this->accNumber;
    }

    /**
     *
     * @return the $accName
     */
    public function getAccName()
    {
        return $this->accName;
    }

    /**
     *
     * @return the $responseStatus
     */
    public function getResponseStatus()
    {
        return $this->responseStatus;
    }

    /**
     *
     * @return the $isApproved
     */
    public function getIsApproved()
    {
        return $this->isApproved;
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
     * @param string $responseId            
     */
    public function setResponseId($responseId)
    {
        $this->responseId = $responseId;
        return $this;
    }

    /**
     *
     * @param string $accNumber            
     */
    public function setAccNumber($accNumber)
    {
        $this->accNumber = $accNumber;
        return $this;
    }

    /**
     *
     * @param string $accName            
     */
    public function setAccName($accName)
    {
        $this->accName = $accName;
        return $this;
    }

    /**
     *
     * @param string $responseStatus            
     */
    public function setResponseStatus($responseStatus)
    {
        $this->responseStatus = $responseStatus;
        return $this;
    }

    /**
     *
     * @param string $isApproved            
     */
    public function setIsApproved($isApproved)
    {
        $this->isApproved = $isApproved;
        return $this;
    }

    /**
     *
     * @return the $dateEntered
     */
    public function getDateEntered()
    {
        return $this->dateEntered;
    }

    /**
     *
     * @return the $brokerTransfer
     */
    public function getBrokerTransfer()
    {
        return $this->brokerTransfer;
    }

    /**
     *
     * @param string $dateEntered            
     */
    public function setDateEntered($dateEntered)
    {
        $this->dateEntered = $dateEntered;
        return $this;
    }

    /**
     *
     * @param \Transactions\Entity\BrokerTransfer $brokerTransfer            
     */
    public function setBrokerTransfer($brokerTransfer)
    {
        $this->brokerTransfer = $brokerTransfer;
        return $this;
    }
}

