<?php
namespace Settings\Entity;


use Doctrine\ORM\Mapping as ORM;
/**
 * 
 * @ORM\Entity
 * @ORM\Table(name="polciy_cover_duration")
 * This defines the duration of the policy
 * 
 * Termed  defines for a duration of period 
 * 
 * One Year 
 * Six Months 
 * Tree Months
 * One Month
 * M
 * @author otaba
 *        
 */
class PolicyCoverDuration
{

    
    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private  $id;
    
    
    /**
     * @ORM\Column(name="duration", type="string", nullable=false)
     * @var unknown
     */
    private $duration;
    
    
    
    
    public function __construct()
    {
        
        
    }
    
    public function getId(){
        return $this->id;
        
    }
    
    public function getDuration(){
        return $this->duration;
    }
    
    public function setDuration($dur){
        $this->duration = $dur;
        return $this;
    }
}

