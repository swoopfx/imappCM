<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MotorType
 *
 * @ORM\Table(name="motor_type")
 * @ORM\Entity
 */
class MotorType
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * This include cars, SUV, trucks
     *
     * @var string @ORM\Column(name="motor", type="string", length=100, nullable=true)
     */
    private $motor;

    /**
     * either commercial or non commercial 
     * @ORM\ManyToOne(targetEntity="Settings\Entity\MotorUseCategory")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="use_category_id", referencedColumnName="id")
     * })
     *
     * @var Settings\Entity\MotorUseCategory
     */
    private $useCategory;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set motor
     *
     * @param string $motor            
     *
     * @return MotorType
     */
    public function setMotor($motor)
    {
        $this->motor = $motor;
        
        return $this;
    }

    /**
     * Get motor
     *
     * @return string
     */
    public function getMotor()
    {
        return $this->motor;
    }

    /**
     *
     * @return \Settings\Entity\Settings\Entity\MotorUseCategory
     */
    public function getUseCategory()
    {
        return $this->useCategory;
    }

    /**
     *
     * @param \Settings\Entity\Settings\Entity\MotorUseCategory $use            
     */
    public function setUseCategory($use)
    {
        $this->useCategory = $use;
        
        return $this;
    }
}
