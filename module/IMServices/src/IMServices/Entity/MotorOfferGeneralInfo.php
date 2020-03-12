<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MotorOfferGeneralInfo
 * 
 * @author swoopfx
 *         @ORM\Table(name="comprehensive_motor_general_info")
 *         @ORM\Entity
 *        
 */
class MotorOfferGeneralInfo
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     *
     * @var boolean @ORM\Column(name="is_car_parked", type="boolean", nullable=false)
     */
    private $isCarParked;

    /**
     *
     * @var boolean @ORM\Column(name="is_car_owner", type="boolean", nullable=false)
     */
    private $isSoleOwner;

    /**
     *
     * @var boolean @ORM\Column(name="is_car_hired", type="boolean", nullable=false)
     */
    private $isCarHired;

    /**
     *
     * @var boolean @ORM\Column(name="finance_company", type="string", nullable=false)
     */
    private $financeCompany;

    /**
     *
     * @var boolean @ORM\Column(name="is_valid_license", type="boolean", nullable=false)
     */
    private $isValidLicense;

    /**
     *
     * @var boolean @ORM\Column(name="is_motor_convict", type="boolean", nullable=false)
     */
    private $isMotorConvict;
}

?>