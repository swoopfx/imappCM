<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InvoiceStatus
 *
 * @ORM\Table(name="invoice_status", indexes={@ORM\Index(name="FKinvoice_status_general_status_idx", columns={"status"})})
 * @ORM\Entity
 */
class InvoiceStatus
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
     * @var \Settings\Entity\Status @ORM\ManyToOne(targetEntity="Settings\Entity\Status")
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
     * @return InvoiceStatus
     */
    public function setStatus(\Settings\Entity\GeneralStatus $status = null)
    {
        $this->status = $status;
        
        return $this;
    }

    /**
     * Get status
     *
     * @return \Settings\Entity\GeneralStatus
     */
    public function getStatus()
    {
        return $this->status;
    }
}
