<?php
namespace Users\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="broker_default_account")
 * 
 * @author otaba
 *        
 */
class BrokerDefaultAccount
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Users\Entity\BrokerBankAccount", inversedBy="defaultBankAccount")
     * 
     * @var BrokerBankAccount
     */
    private $brokerBankAccount;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getBrokerBankAccount()
    {
        return $this->brokerBankAccount;
    }

    public function setBrokerBankAccount($bank)
    {
        $this->brokerBankAccount = $bank;
        return $this;
    }
}

