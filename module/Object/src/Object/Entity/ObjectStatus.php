<?php
namespace Object\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="object_status")
 * 
 * @author swoopfx
 *        
 */
class ObjectStatus
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
     * @var \Settings\Entity\Status @ORM\OneToOne(targetEntity="Settings\Entity\Status")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="object_status_id", referencedColumnName="id")
     *      })
     *     
     */
    protected $objectStatus;

    /**
     *
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return \Settings\Entity\Status
     */
    public function getObjectStatus()
    {
        return $this->objectStatus;
    }

    /**
     *
     * @param \Settings\Entity\Status $status            
     * @return \Object\Entity\ObjectStatus
     */
    public function setObjectStatus(\Settings\Entity\Status $status)
    {
        $this->objectStatus = $status;
        
        return $this;
    }
    
   
}