<?php
namespace Settings\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="defined_package_value_type")
 * @author otaba
 *
 */
class DefinePackageValueType {
	
	/**
	 *
	 * @var integer @ORM\Column(name="id", type="integer", nullable=false)
	 *      @ORM\Id
	 *      @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;
	
	/**
	 * @ORM\Column(name="type", type="string", nullable=false)
	 * @var String
	 */
	private $type;
	
	public function __construct(){
		
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getType(){
		return $this->type;
	}
	
	public function setType($ty){
		$this->type = $ty;
		return $this;
	}
	
	
}