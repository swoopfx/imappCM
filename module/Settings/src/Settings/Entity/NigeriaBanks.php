<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NigeriaBanks
 *
 * @ORM\Table(name="nigeria_banks")
 * @ORM\Entity
 */
class NigeriaBanks
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
     * @var string @ORM\Column(name="bank_name", type="string", length=225, nullable=true)
     */
    private $bankName;

    /**
     *
     * @var string @ORM\Column(name="bank_logo", type="string", length=100, nullable=true)
     */
    private $bankLogo;

    /**
     * @ORM\Column(name="money_wave_code", type="string", nullable=false)
     * 
     * @var string
     */
    private $moneyWaveCode;
    
    /**
     * @ORM\Column(name="paystack_code", type="string", nullable=false)
     * @var string
     */
    private $paystackCode;
    
    
    /**
     * @ORM\Column(name="is_pay_with_bank", type="boolean", nullable=false)
     * @var boolean
     */
    private $isPayWithBank;
    
    
    /**
     * @ORM\Column(name="pay_stack_long_code", type="string", nullable=false)
     * @var string
     */
    private $paystackLongCode;
    
    /**
     * permits if it is registered on Rave for bank to bank transfer
     * @ORM\Column(name="is_rave_bank_transfer", type="boolean", nullable=false)
     * @var boolean
     */
    private $isRaveBankTransfer;
    
    
    /**
     * Defines if the entity is a bank or an alternative financial institution
     *  @ORM\Column(name="is_bank", type="boolean", nullable=false)
     * @var boolean
     */
    private $isBank;

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
     * Set bankName
     *
     * @param string $bankName            
     *
     * @return NigeriaBanks
     */
    public function setBankName($bankName)
    {
        $this->bankName = $bankName;
        
        return $this;
    }

    /**
     * Get bankName
     *
     * @return string
     */
    public function getBankName()
    {
        return $this->bankName;
    }

    /**
     * Set bankLogo
     *
     * @param string $bankLogo            
     *
     * @return NigeriaBanks
     */
    public function setBankLogo($bankLogo)
    {
        $this->bankLogo = $bankLogo;
        
        return $this;
    }

    /**
     * Get bankLogo
     *
     * @return string
     */
    public function getBankLogo()
    {
        return $this->bankLogo;
    }

    public function getMoneyWaveCode()
    {
        return $this->moneyWaveCode;
    }

    public function setMoneyWaveCode($code)
    {
        $this->moneyWaveCode = $code;
        return $this;
    }
    
    public function getPaystackCode(){
        return $this->paystackCode;
    }
    
    public function setPaystackCode($code){
        $this->paystackCode =$code;
        return $this;
    }
    
    public function setIsPayWithBank($bank){
        $this->isPayWithBank = $bank;
        return $this;
    }
    
    public function getIsPayWithBank(){
        return $this->isPayWithBank;
    }
    
    public function getPaystackLongCode(){
        return $this->paystackLongCode;
    }
    
    public function setPaystackLongCode($set){
        $this->paystackLongCode = $set;
        return $this;
    }
    /**
     * @return the $isRaveBankTransfer
     */
    public function getIsRaveBankTransfer()
    {
        return $this->isRaveBankTransfer;
    }

    /**
     * @param boolean $isRaveBankTransfer
     */
    public function setIsRaveBankTransfer($isRaveBankTransfer)
    {
        $this->isRaveBankTransfer = $isRaveBankTransfer;
        return $this;
    }
    /**
     * @return the $isBank
     */
    public function getIsBank()
    {
        return $this->isBank;
    }

    /**
     * @param boolean $isBank
     */
    public function setIsBank($isBank)
    {
        $this->isBank = $isBank;
        return $this;
    }

    
    

}
