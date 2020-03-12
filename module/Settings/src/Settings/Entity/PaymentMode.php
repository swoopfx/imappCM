<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaymentMode
 *
 * @ORM\Table(name="payment_mode", uniqueConstraints={@ORM\UniqueConstraint(name="medium_name_UNIQUE", columns={"payment_mode"})})
 * @ORM\Entity
 */
class PaymentMode
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
     * @var string @ORM\Column(name="payment_mode", type="string", length=100, nullable=true)
     */
    private $paymentMode;

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
     * Set paymentMode
     *
     * @param string $paymentMode            
     *
     * @return PaymentMode
     */
    public function setPaymentMode($paymentMode)
    {
        $this->paymentMode = $paymentMode;
        
        return $this;
    }

    /**
     * Get paymentMode
     *
     * @return string
     */
    public function getPaymentMode()
    {
        return $this->paymentMode;
    }
}
