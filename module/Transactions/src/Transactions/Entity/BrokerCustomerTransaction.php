<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="broker_customer_transaction")
 * @author swoopfx
 *        
 */
class BrokerCustomerTransaction
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
     * @var string @ORM\Column(name="transact_uid", type="string", length=225, nullable=true)
     */
    private $transactUid;

    /**
     *
     * @var boolean @ORM\Column(name="is_success", type="boolean", nullable=false)
     */
    private $isSuccess;

    /**
     *
     * @var \DateTime @ORM\Column(name="payment_date", type="datetime", nullable=true)
     */
    private $paymentDate;

    /**
     *
     * @var \Transactions\Entity\BrokerCustomerInvoice @ORM\OneToOne(targetEntity="Transactions\Entity\BrokerCustomerInvoice")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="invoice", referencedColumnName="id")
     *      })
     *     
     *      An invoice is generated for every transaction made on the platform
     *     
     */
    private $invoice;

    /**
     * this defines pending or finalizzed , failed etc
     * 
     * @var \Transactions\Entity\TransactionStatus @ORM\ManyToOne(targetEntity="Transactions\Entity\TransactionStatus")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="transact_status_id", referencedColumnName="id")
     *      })
     *     
     */
    private $transactStatus;

   



    /**
     *
     * @var \Settings\Entity\PaymentMode @ORM\ManyToOne(targetEntity="Settings\Entity\PaymentMode")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="payment_mode", referencedColumnName="id")
     *      })
     */
    private $paymentMode;

    /**
     *
     * @var \DateTime @ORM\Column(name="created_on", type="datetime", nullable=true)
     */
    private $createdOn;
    
    
    /**
     *
     * @var \DateTime @ORM\Column(name="updated_on", type="datetime", nullable=true)
     */
    private $updatedOn;
   
   
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
}

