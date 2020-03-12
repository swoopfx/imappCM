<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PropertyInsurnace
 *
 * @ORM\Table(name="property_insurnace")
 * @ORM\Entity
 */
class PropertyInsurnace
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Get idpropertyInsurnace
     *
     * @return integer
     */
    public function getIdpropertyInsurnace()
    {
        return $this->idpropertyInsurnace;
    }
}
