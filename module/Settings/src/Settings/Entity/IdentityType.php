<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @author swoopfx
 *         @ORM\Table(name="identity_type")
 *         @ORM\Entity
 *        
 */
class IdentityType
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="identity", type="string")
     * 
     * @var string
     */
    protected $identityType;

    /**
     *
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return string
     */
    public function getIdentityType()
    {
        return $this->identityType;
    }

    /**
     *
     * @param string $id            
     * @return \Settings\Entity\IdentityType
     */
    public function setIdentityType($id)
    {
        $this->identityType = $id;
        return $this;
    }
}

?>