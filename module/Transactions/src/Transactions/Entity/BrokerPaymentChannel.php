<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * e.g Bank transfer, cheque deposit, epayment
 * @ORM\Entity
 * @ORM\Table(name="broker_payment_channel")
 *
 * @author swoopfx
 *        
 */
class BrokerPaymentChannel
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="channel", type="string", nullable=false)
     *
     * @var string
     */
    private $channel;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getChannel()
    {
        return $this->channel;
    }

    public function setChannel($chammel)
    {
        $this->channel = $chammel;
        return $this;
    }
}

