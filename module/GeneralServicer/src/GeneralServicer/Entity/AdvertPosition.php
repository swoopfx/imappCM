<?php
namespace GeneralServicer\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdvertPosition
 *
 * @ORM\Table(name="advert_position")
 * @ORM\Entity
 */
class AdvertPosition
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
     * @var string @ORM\Column(name="position", type="string", length=80, nullable=true)
     */
    private $position;

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
     * Set position
     *
     * @param string $position            
     *
     * @return AdvertPosition
     */
    public function setPosition($position)
    {
        $this->position = $position;
        
        return $this;
    }

    /**
     * Get position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }
}
