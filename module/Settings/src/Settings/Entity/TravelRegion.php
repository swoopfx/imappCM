<?php
namespace Settings\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * this cat3egirzes the world continents based on categories 
 * Middle East , FarEast , Africa, America
 * @ORM\Table(name="travel_region")
 * @ORM\Entity
 * @author otaba
 *
 */
class TravelRegion{
	
	/**
	 *
	 * @var integer @ORM\Column(name="id", type="integer", nullable=false)
	 *      @ORM\Id
	 *      @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;
	
	/**
	 * @ORM\Column(name="region", type="string", nullable=false)
	 * @var string
	 */
	private $region;
	
	public function getId(){
		return  $this->id;
	}
	
	public function getRegion(){
		return $this->region;
	}
	
	public function setRegion($reg){
		
		$this->region = $reg;
		return $this;
	}
	
}