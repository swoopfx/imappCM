<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="moneywave_response")
 *
 * @author otaba
 *        
 */
class MoneyWaveResponse
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
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
     * @ORM\Column(name="response_type", type="string", nullable=true)
     *
     * @var string
     */
    private $responseType;

    /**
     * @ORM\Column(name="is_delivery_successful", type="string", nullable=true)
     *
     * @var string
     */
    private $isDeliverySuccessFul;

    /**
     * @ORM\Column(name="is_card_validation_success", type="string", nullable=true)
     *
     * @var string
     */
    private $isCardValidationSuccessful;

    /**
     * @ORM\ManyToOne(targetEntity="Transactions\Entity\Invoice")
     *
     * @var Invoice
     */
    private $invoice;

    /**
     * @ORM\ManyToOne(targetEntity="Transactions\Entity\Transaction")
     *
     * @var Transaction
     */
    private $transaction;

    /**
     * @ORM\Column(name="card_phone", type="string", nullable=true)
     *
     * @var string
     */
    private $cardPhone;

    /**
     * @ORM\Column(name="flutter_disburse_reference", type="string", nullable=true)
     *
     * @var string
     */
    private $flutterDisburseReference;
    
    /**
     * @ORM\Column(name="flutter_charge_reference", type="string", nullable=true)
     *
     * @var string
     */
    private $flutterChargeReference;

    /**
     * @ORM\Column(name="flutter_disburse_response_code", type="string", nullable=true)
     *
     * @var string
     */
    private $flutterDisburseResponseCode;

    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $createdOn;

    /**
     */
    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getResponseId()
    {
        return $this->responseId;
    }

    public function setResponseId($res)
    {
        $this->responseId = $res;
        return $this;
    }

    public function getResponseType()
    {
        return $this->responseType;
    }

    public function setResponseType($type)
    {
        $this->responseType = $type;
        return $this;
    }

    public function getIsDeliverySuccessFul()
    {
        return $this->isDeliverySuccessFul;
    }

    public function setIsDeliverySuccessFul($is)
    {
        $this->isDeliverySuccessFul = $is;
        return $this;
    }

    public function getIsCardValidationSuccessful()
    {
        return $this->isCardValidationSuccessful;
    }

    public function setIsCardValidationSuccessful($set)
    {
        $this->isCardValidationSuccessful = $set;
        return $this;
    }

    public function getInvoice()
    {
        return $this->invoice;
    }

    public function setInvoice($inv)
    {
        $this->invoice = $inv;
        return $this;
    }

    public function getTransaction()
    {
        return $this->transaction;
    }

    public function setTransaction($tran)
    {
        $this->transaction = $tran;
        return $this;
    }

    public function getCardPhone()
    {
        return $this->cardPhone;
    }

    public function setCardPhone($phone)
    {
        $this->cardPhone = $phone;
        return $this;
    }

    public function getFlutterDisburseReference()
    {
        return $this->flutterDisburseReference;
    }

    public function setFlutterDisburseReference($flu)
    {
        $this->flutterDisburseReference = $flu;
        return $this;
    }
    
    public function getFlutterChargeReference(){
        return $this->flutterChargeReference;
    }
    
    public function setFlutterChargeReference($flu){
        $this->flutterChargeReference = $flu;
        return $this;
    }

    public function getFlutterDisburseResponseCode()
    {
        return $this->flutterDisburseResponseCode;
    }

    public function setFlutterDisburseResponseCode($flu)
    {
        $this->flutterDisburseResponseCode = $flu;
        return $this;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function setCreatedOn($date)
    {
        $this->createdOn = $date;
        return $this;
    }
}

