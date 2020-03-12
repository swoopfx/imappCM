<?php
namespace Offer\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @author swoopfx
 *         @ORM\Entity
 *         @ORM\Table(name="offer_status")
 *        
 */
class OfferStatus
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     *
     * @var \Settings\Entity\Status @ORM\ManyToOne(targetEntity="Settings\Entity\Status")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="offer_status_id", referencedColumnName="id")
     *      })
     *     
     */
    private $offerStatusId;
    
   
    
//     protected $offerMainStatus;
    
//     protected $offerStatus;

    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return \Settings\Entity\Status
     */
    public function getOfferStatusId()
    {
        return $this->offerStatusId;
    }

    /**
     *
     * @param \Settings\Entity\Status $status            
     * @return \Offer\Entity\OfferStatus
     */
    public function setOfferStatusId(\Settings\Entity\Status $status)
    {
        $this->offerStatusId = $status;
        return $this;
    }
    
    public function getOfferStatus(){
     $this->offerStatus =  $this->offerStatusId->getStatusWord();
     return $this->offerStatus;
    }
    
    public function setofferStatus($sta){
        $this->offerStatus = $sta;
    }
}