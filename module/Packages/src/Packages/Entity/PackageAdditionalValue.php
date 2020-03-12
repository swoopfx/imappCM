<?php

namespace Packages\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("package_additional_value")
 *
 * @author otaba
 *        
 */
class PackageAdditionalValue {
	
	/**
	 *
	 * @var integer @ORM\Column(name="id", type="integer", nullable=false)
	 *      @ORM\Id
	 *      @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;
	
	/**
	 * @ORM\Column(name="additional_name", type="string", nullable=false)
	 * 
	 * @var string
	 */
	private $additionalName;
	
	/**
	 * @ORM\Column(name="value", type="string", nullable=false)
	 * 
	 * @var string
	 */
	private $value;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Packages\Entity\Packages", inversedBy="additionalValue")
	 * 
	 * @var Packages
	 */
	private $packages;
	public function getId() {
		return $this->id;
	}
	public function getAdditionalName() {
		return $this->additionalName;
	}
	public function setAdditionalName($add) {
		$this->additionalName = $add;
		return $this;
	}
	public function getValue() {
		return $this->value;
	}
	public function setValue($val) {
		$this->value = $val;
		return $this;
	}
	public function getPackages() {
		return $this->packages;
	}
	public function setPackages($pack) {
		$this->packages = $pack;
		return $this;
	}
}

