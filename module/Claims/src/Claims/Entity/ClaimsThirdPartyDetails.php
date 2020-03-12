<?php
namespace Claims\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\Insurer;

/**
 * @ORM\Entity
 * @ORM\Table(name="claims_third_party_details")
 * 
 * @author otaba
 *        
 */
class ClaimsThirdPartyDetails
{

    /**
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @var integer
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Claims\Entity\ClaimsMotorAccident", inversedBy="thirdpartyDetails")
     * 
     * @var ClaimsMotorAccident
     */
    private $claimsMotorAccident;

    /**
     * @ORM\Column(name="third_party_name", type="string", nullable=true)
     * 
     * @var string
     */
    private $thirPartyName;

    /**
     * @ORM\Column(name="third_party_address", type="text", nullable=true)
     * 
     * @var string
     */
    private $thirdPartyAddress;

    private $vehicleMake;

    /**
     * @ORM\Column(name="vehicle_reg_no", type="string", nullable=true)
     * 
     * @var string
     */
    private $vehicleRegNo;

    /**
     * @ORM\Column(name="vehicle_present_location", type="string", nullable=true)
     * 
     * @var string
     */
    private $vehiclePresentLocation;

    /**
     * @ORM\Column(name="is_insured", type="boolean", nullable=true)
     * 
     * @var boolean
     */
    private $isInsured;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Insurer")
     * 
     * @var Insurer
     */
    private $insurer;

    /**
     * @ORM\Column(name="policy_number", type="string", nullable=true)
     * 
     * @var string
     */
    private $policyNumber;

    /**
     */
    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }
}

