<?php
namespace Proposal\Entity;

use Doctrine\ORM\Mapping as ORM;

use Settings\Entity\Status;
/**
 * Object
 *
 * @ORM\Table(name="proposal_status")
 * @ORM\Entity
 */
class ProposalStatus
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
     * @ORM\JoinColumn(name="status", referencedColumnName="id")
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

