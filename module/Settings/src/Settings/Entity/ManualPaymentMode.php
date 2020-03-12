<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CASH, CHEQUE
 * @ORM\Entity
 * @ORM\Table(name="manual_payment_mode")
 * 
 * @author otaba
 *        
 */
class ManualPaymentMode
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
     * @ORM\Column(name="mode", type="string", nullable=false)
     * 
     * @var string
     */
    private $mode;

    /**
     */
    public function __construct()
    {
        
        
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMode()
    {
        return $this->mode;
    }

    public function setMode($mode)
    {
        $this->mode = $mode;
        return $this;
    }
}

