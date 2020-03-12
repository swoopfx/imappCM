<?php
namespace Claims\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @author swoopfx
 *         @ORM\Entity
 *         @ORM\Table(name="claims_status")
 *        
 */
class ClaimStatus
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
     *      @ORM\JoinColumn(name="status", referencedColumnName="id")
     *      })
     *     
     */
    protected $status;

    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return \Settings\Entity\Status
     */
   public function getStatus(){
       return $this->status;
   }

    /**
     *
     * @param \Settings\Entity\Status $status            
     * @return \Offer\Entity\OfferStatus
     */
    public function setStatus(\Settings\Entity\Status $status)
    {
        $this->status = $status;
        return $this;
    }
}

?>