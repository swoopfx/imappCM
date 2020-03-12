<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommisionType
 *
 * @ORM\Table(name="commision_type")
 * @ORM\Entity
 */
class CommisionType
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
     * @var string @ORM\Column(name="commision_type", type="string", length=100, nullable=false)
     */
    private $commisionType;

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
     * Set commisionType
     *
     * @param string $commisionType            
     * @return CommisionType
     */
    public function setCommisionType($commisionType)
    {
        $this->commisionType = $commisionType;
        
        return $this;
    }

    /**
     * Get commisionType
     *
     * @return string
     */
    public function getCommisionType()
    {
        return $this->commisionType;
    }
}
