<?php
namespace Users\Entity;

use Doctrine\ORM\Mapping as ORM;
//, indexes={@ORM\Index(name="FK_broker_telephone_address_idx", columns={"broker_address_id"})}
/**
 * BrokerTelephone
 *
 * @ORM\Table(name="broker_telephone")
 * @ORM\Entity
 */
class BrokerTelephone
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
     * @var string @ORM\Column(name="broker_telephone", type="string", length=45, nullable=false)
     */
    private $brokerTelephone;

   

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
     * Set brokerTelephone
     *
     * @param string $brokerTelephone            
     *
     * @return BrokerTelephone
     */
    public function setBrokerTelephone($brokerTelephone)
    {
        $this->brokerTelephone = $brokerTelephone;
        
        return $this;
    }

    /**
     * Get brokerTelephone
     *
     * @return string
     */
    public function getBrokerTelephone()
    {
        return $this->brokerTelephone;
    }

//     /**
//      * Set brokerAddress
//      *
//      * @param \Users\Entity\BrokerAddress $brokerAddress            
//      *
//      * @return BrokerTelephone
//      */
//     public function setBrokerAddress(\Users\Entity\BrokerAddress $brokerAddress = null)
//     {
//         $this->brokerAddress = $brokerAddress;
        
//         return $this;
//     }

//     /**
//      * Get brokerAddress
//      *
//      * @return \Users\Entity\BrokerAddress
//      */
//     public function getBrokerAddress()
//     {
//         return $this->brokerAddress;
//     }
}
