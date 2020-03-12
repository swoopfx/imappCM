<?php
namespace All\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RegistrationStatus
 *
 * @ORM\Table(name="registration_status", indexes={@ORM\Index(name="FK_registration_status_general_idx", columns={"status"})})
 * @ORM\Entity
 */
class RegistrationStatus
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
     * @var \All\Entity\GeneralStatus @ORM\ManyToOne(targetEntity="All\Entity\GeneralStatus")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="status", referencedColumnName="id")
     *      })
     */
    private $status;

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
     * Set status
     *
     * @param \All\Entity\GeneralStatus $status            
     *
     * @return RegistrationStatus
     */
    public function setStatus( $status = null)
    {
        $this->status = $status;
        
        return $this;
    }

    /**
     * Get status
     *
     * @return \All\Entity\GeneralStatus
     */
    public function getStatus()
    {
        return $this->status;
    }
}
