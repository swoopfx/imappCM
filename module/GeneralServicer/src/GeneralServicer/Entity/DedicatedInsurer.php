<?php
namespace GeneralServicer\Entity;

use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\Insurer;

/**
 * @ORM\Entity
 * @ORM\Table(name="dedicated_insurer")
 *
 * @author swoopfx
 *        
 */
class DedicatedInsurer
{
    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */

    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Insurer")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="insurer", referencedColumnName="id")
     *      })
     *  
     * @var Insurer
     */
    private $insurer;

    /**
     *  An auto generated code for 
     * @ORM\Column(name="insurer_code", type="string", nullable=true)
     * @var string
     */
    private $insurerCode;

    /**
     * 
     * @var \DateTime
     * ORM\Column(name="created_on", type="datetime", nullable=true)
     */
    private $createdOn;

    /**
     *
     * @var \DateTime
     * ORM\Column(name="update_on", type="datetime", nullable=true)
     */
    private $updatedOn;
    
    private $insurerName;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getInsurer()
    {
        return $this->insurer;
    }

    public function seInsurer($insurer)
    {
        $this->insurer = $insurer;
        return $this;
    }

    public function getInsurerCode()
    {
        return $this->insurerCode;
    }

    public function setInsurerCode($code)
    {
        $this->insurerCode = $code;
        
        return $this;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function setCreatedOn($date)
    {
        $this->createdOn = $date;
        
        return $this;
    }

    public function getUpdateOn()
    {
        return $this->updatedOn;
    }

    public function setUpdatedOn($date)
    {
        $this->updatedOn = $date;
        return $this;
    }
    
    public function getInsurerName(){
        return $this->getInsurer()->getInsuranceName();
    }
}

