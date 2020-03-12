<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="professional_indemnity_partner_details")
 * 
 * @author otaba
 *        
 */
class ProfessionalIndemnityPartnerDetails
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="partner_name", type="string", nullable=true)
     * 
     * @var string
     */
    private $partnerName;

    /**
     * @ORM\Column(name="qualification", type="string", nullable=true)
     * 
     * @var string
     */
    private $qualification;

    /**
     * @ORM\Column(name="date_qualified", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $dateQualified;

    /**
     * @ORM\Column(name="partner_capacity", type="string", nullable=true)
     * 
     * @var string
     */
    private $partnerCapacity;

    /**
     * @ORM\ManyToOne(targetEntity="IMServices\Entity\ProfessionalIndemnity", inversedBy="partnerDetails")
     * 
     * @var ProfessionalIndemnity
     */
    private $professionalIndemnity;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPartnerName()
    {
        return $this->partnerName;
    }

    public function setPartnerName($part)
    {
        $this->partnerName = $part;
        return $this;
    }

    public function getQualification()
    {
        return $this->qualification;
    }

    public function setQualification($qal)
    {
        $this->qualification = $qal;
        return $this;
    }

    public function getDateQualified()
    {
        return $this->dateQualified;
    }

    public function setDateQualified($date)
    {
        $this->dateQualified = $date;
        return $this;
    }

    public function getPartnerCapacity()
    {
        return $this->partnerCapacity;
    }

    public function setPartnerCapacity($cap)
    {
        $this->partnerCapacity = $cap;
        return $this;
    }

    public function getProfessionalIndemnity()
    {
        return $this->professionalIndemnity;
    }

    public function setProfessionalIndemnity($pro)
    {
        $this->professionalIndemnity = $pro;
        return $this;
    }
}

