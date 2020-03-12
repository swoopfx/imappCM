<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @author swoopfx
 *         @ORM\Table(name="type_of_body")
 *         @ORM\Entity
 */
class MotorTypeOfBody
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    protected $typeOfBody;
}

?>