<?php
namespace Transactions\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="flutterwave_response")
 * @author swoopfx
 *
 */

class FlutterwaveResponse
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
     * @ORM\ManyToOne(targetEntity="Transactions\Entity\Transaction", inversedBy="flutterwave")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="transaction", referencedColumnName="id")
     * })
     * @var Transaction
     */
    private $transaction;
    
    /**
     * @ORM\Column(name="response_code", type="string", nullable=true)
     * @var string
     */
    private $responseCode;
    
    /**
     * @ORM\Column(name="otptransactionidentifier", type="string", nullable=true)
     * var string
     */
    private $otptransactionidentifier;
    
    /**
     * @ORM\Column(name="response_message", type="text", nullable=true)
     * @var string
     */
    private $responseMessage;
    
    /**
     * @ORM\Column(name="transaction_reference", type="string", nullable=true)
     * @var string
     */
    private $transactionreference;
    
    /**
     * @ORM\Column(name="response_token", type="string", nullable=true)
     * @var string
     */
    private $responseToken;
    
    /**
     * @ORM\Column(name="date_created", type="datetime", nullable=true)
     * @var string
     */
    private $dateCreated;
    
    
    /**
     * @ORM\Column(name="date_modified", type="datetime", nullable=true)
     * @var string
     */
    private $dateModified;
    
    public function getId(){
        return $this->id;
    }
    
    public function getTransaction(){
        return $this->transaction;
    }
    
    public function setTransaction($trans){
        $this->transaction = $trans;
        return $this;
    }
    
    public function getResponseCode(){
        return $this->responseCode;
    }
    
    public function setResponseCode($code){
        $this->responseCode = $code;
        
        return $this;
    }
    
    public function getResponseMessage(){
        return $this->responseMessage;
    }
    
    public function  setResponseMessage($message){
        $this->responseMessage = $message;
        return $this;
    }
    
    public function getTransactionReference(){
        return $this->transactionreference ;
    }
    
    public function setTransactionReference($ref){
        $this->transactionreference = $ref;
        return $this;
    }
    
    public function getResponseToken(){
        return $this->responseToken;
    }
    
    public function setResponseToken($token){
        $this->responseToken = $token ;
        return $this;
    }
    
    
    public function setDateCreated($datae){
        $this->dateCreated = $datae;
        $this->dateModified = $datae;
        return $this;
    }
    
    public function getDateCreated(){
        return $this->dateCreated;
    }
    
    public function setDateModified($date){
        $this->dateModified = $date;
        return $this;
    }
    
    public function getDateModified(){
        return $this->dateModified;
    }
    
    public function setOtptransactionidentifier($dd){
        $this->otptransactionidentifier = $dd;
        return $this;
    }
    
    public function getOtptransactionidentifier(){
        return $this->otptransactionidentifier;
    }
}

