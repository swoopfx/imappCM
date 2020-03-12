<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MotorPurposeOfUse
 *
 * @ORM\Table(name="motor_purpose_of_use")
 * @ORM\Entity
 */
class MotorPurposeOfUse
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * This purpose Of UseInclude But not Limted to
     * Social, Domestic Use, Pleasurable Use, Business Use (excluding Hiring and transport of Merchandise)
     *
     * @var string @ORM\Column(name="motor_purpose", type="string", nullable=false, length=200)
     *     
     *     
     */
    private $motorPurpose;

    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @param unknown $motorPurpose            
     * @return \Settings\Entity\MotorPurposeOfUse
     */
    public function setMotorPurpose($motorPurpose)
    {
        $this->motorPurpose = $motorPurpose;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getMotorPurpose()
    {
        return $this->motorPurpose;
    }
}

?>