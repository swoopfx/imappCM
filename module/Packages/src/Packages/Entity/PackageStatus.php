<?php
namespace Packages\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\Status;

/**
 * @ORM\Entity
 * @ORM\Table(name="package_status")
 * @author otaba
 *        
 */
class PackageStatus
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Status")
     * @var Status
     */
    private $status;
    
   
    
    public function getId(){
        return $this->id;
    }
    
    public function getStatus(){
        return $this->status;
    }
    
    public function setStatus($stat){
        $this->status = $stat;
        return $this;
    }
}

