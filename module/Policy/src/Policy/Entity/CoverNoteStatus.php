<?php
namespace Policy\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="cover_note_status")
 * @author otaba
 *        
 */
class CoverNoteStatus
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
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="status", referencedColumnName="id")
     *      })
     * @var Status
     */
    private $status;
    
    
    public function __construct()
    {}
    
    public function getId(){
        return $this->id;
    }
    
    public function getStatus(){
        return $this->status;
        
    }
    
    public function seStatus($state){
        $this->status = $state;
        return $this;
    }
}

