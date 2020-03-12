<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeneralStatus
 *
 * @ORM\Table(name="general_status")
 * @ORM\Entity
 */
class GeneralStatus
{

    /**
     *
     * @var unknown @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $Id;

    /**
     *
     * @var string @ORM\Column(name="status", type="string", nullable=false)
     */
    private $status;

    public function getId()
    {
        return $this->Id;
    }

    /**
     *
     * @param unknown $id            
     * @return \Settings\Entity\GeneralStatus
     */
    public function setId($id)
    {
        $this->Id = $id;
        return $this;
    }

    /**
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     *
     * @param unknown $status            
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
}

?>