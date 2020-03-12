<?php
namespace Claims\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="claims_driver_details")
 *
 * @author otaba
 *        
 */
class ClaimsDriverDetails
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
     * @ORM\OneToOne(targetEntity="Claims\Entity\ClaimsMotorAccident", inversedBy="driverDetails")
     * 
     * @var ClaimsMotorAccident
     */
    private $claimsMotorAccident;

    /**
     * @ORM\Column(name="driver_name", type="string", nullable=true)
     * 
     * @var string
     */
    private $driverName;

    /**
     * @ORM\Column(name="driver_age", type="string", nullable=true)
     * 
     * @var string
     */
    private $driverAge;

    /**
     * @ORM\Column(name="driving_licence_number", type="string", nullable=true)
     * 
     * @var string
     */
    private $drivingLicenceNo;

    /**
     * @ORM\Column(name="licence_issue_date", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $licenceIssueDate;

    /**
     * @ORM\Column(name="licence_expire_date", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $licenceExpireDate;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getCLaimsMotorAccident()
    {
        return $this->claimsMotorAccident;
    }

    public function setClaimsMotorAccident($acc)
    {
        $this->claimsMotorAccident = $acc;
        return $this;
    }

    public function getDriverName()
    {
        return $this->driverName;
    }

    public function setDriverName($name)
    {
        $this->driverName = $name;
        return $this;
    }

    public function getDriverAge()
    {
        return $this->driverAge;
    }

    public function setDriverAge($age)
    {
        $this->driverAge = $age;
        return $this;
    }

    public function setDrivingLicenceNo($lic)
    {
        $this->drivingLicenceNo = $lic;
        return $this;
    }

    public function getDrivingLicenceNo()
    {
        return $this->drivingLicenceNo;
    }

    public function setLicenceIssueDate($date)
    {
        $this->licenceIssueDate = $date;
        return $this;
    }

    public function getLicenceExpireDate()
    {
        return $this->licenceExpireDate;
    }

    public function setLicenceExpireDate($date)
    {
        $this->licenceExpireDate = $date;
        return $this;
    }
    /**
     * @return \DateTime
     */
    public function getLicenceIssueDate()
    {
        return $this->licenceIssueDate;
    }

}

