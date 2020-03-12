<?php
namespace Claims\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="claims_fire_loss")
 * 
 * @author otaba
 *        
 */
class CLaimsFireLoss
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="fire_details", nullable=true, type="text")
     * 
     * @var text
     */
    private $fireDetails;

    /**
     * @ORM\Column(name="fire_datetime", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $fireDatetime;

    /**
     * @ORM\Column(name="estimated_loss", type="string", nullable=true)
     * 
     * @var string
     */
    private $estimatedLoss;

    /**
     * @ORM\OneToMany(targetEntity="Claims\Entity\ClaimLossList", mappedBy="claimsFireLoss")
     * 
     * @var Collection
     */
    private $listLoss;

    /**
     *
     * @var boolean
     */
    private $isAggrement;
    
    /**
     * @ORM\OneToOne(targetEntity="Claims\Entity\CLaims", inversedBy="claimsFireLoss")
     *
     * @var CLaims
     */
    private $claims;
    
    

    /**
     */
    public function __construct()
    {
        $this->listLoss = new ArrayCollection();
    }

    public function getListLoss()
    {
        return $this->listLoss;
    }

    public function addListLoss($list)
    {
        if (! $this->listLoss->contains($list)) {
            $this->listLoss->add($list);
        }
        
        return $this;
    }

    public function removeListLoss($list)
    {
        if ($this->listLoss->contains($list)) {
            $this->listLoss->removeElement($list);
        }
        
        return $this;
    }

    public function getFireDetails()
    {
        return $this->fireDetails;
    }

    public function setFireDetails($fire)
    {
        $this->fireDetails = $fire;
        return $this;
    }

    public function getFireDatetime()
    {
        return $this->fireDatetime;
    }

    public function setFireDatetime($date)
    {
        $this->fireDatetime = $date;
        return $this;
    }
    
    public function getEstimetedLoss(){
        return $this->estimatedLoss;
    }
    
    public function setEstimatedLoss($loss){
        $this->estimatedLoss = $loss;
        return $this;
    }
    
    public function getIsAggrement(){
        return $this->isAggrement;
    }
    
    public function setIsAggrement($gree){
        $this->isAggrement = $gree;
        return $this;
    }
    
    public function getClaims(){
        return $this->claims;
    }
    
    public function setClaims($claims){
        $this->claims = $claims;
        return $this;
    }
}

