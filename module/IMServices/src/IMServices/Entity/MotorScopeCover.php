<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MotorScopeCover
 *
 * @ORM\Table(name="motor_scope_cover")
 * @ORM\Entity
 */
class MotorScopeCover
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
     * @var string @ORM\Column(name="cover", type="string", length=45, nullable=true)
     */
    private $cover;

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
     * Set cover
     *
     * @param string $cover            
     *
     * @return MotorScopeCover
     */
    public function setCover($cover)
    {
        $this->cover = $cover;
        
        return $this;
    }

    /**
     * Get cover
     *
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }
}
