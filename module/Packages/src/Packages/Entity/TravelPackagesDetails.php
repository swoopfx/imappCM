<?php
namespace Packages\Entity;


use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\TravelRegion;
use Settings\Entity\TravelDuration;


/**
 * @ORM\Table(name="travel_packages_details")
 * @ORM\Entity
 * @author otaba
 *
 */

class TravelPackagesDetails {
	
	/**
	 *
	 * @var integer @ORM\Column(name="id", type="integer", nullable=false)
	 *      @ORM\Id
	 *      @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;
	
	
	/**
	 * @ORM\ManyToOne(targetEntity="Settings\Entity\TravelRegion")
	 * @var TravelRegion
	 */
	private $region ;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Settings\Entity\TravelDuration")
	 * @var TravelDuration
	 */
	private $duration;
	
	/**
	 * @ORM\Column(name="created_on", type="datetime", nullable=false)
	 * @var \DateTime
	 */
	private $createdOn;
	
	/**
	 * @ORM\Column(name="updated_on", type="datetime", nullable=false)
	 * @var \DateTime
	 */
	private $updatedOn;
	
	public function getId(){
		return $this->id;
		
	}
	
	public function getRegion(){
		return $this->region;
	}
	
	public function setRegion($reg){
		$this->region = $reg;
		return $this;
	}
	
	public function getDuration(){
		return $this->duration;
	}
	
	public function setDuration($dur){
		$this->duration = $dur;
		return $this;
	}
	
	public function setCreatedOn($date){
		$this->createdOn = $date;
		return $this;
	}
	
	public function getCreatedOn(){
		return $this->createdOn ;
	}
	
	
}