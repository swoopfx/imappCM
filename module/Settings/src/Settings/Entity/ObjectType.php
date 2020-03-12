<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ObjectType
 *
 * @ORM\Table(name="object_type")
 * @ORM\Entity
 */
class ObjectType
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
     * @var string @ORM\Column(name="object_type", type="string", length=100, nullable=true)
     */
    private $objectType;
    
    /**
     * @ORM\Column(name="is_for_object", type="boolean", nullable=false)
     * @var 
     */
    private $isForObject;
    
    
    /**
     * @ORM\Column(name="is_for_packages", type="boolean", nullable=false)
     * @var
     */
    private $isForPackages;

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
     * Set objectType
     *
     * @param string $objectType            
     *
     * @return ObjectType
     */
    public function setObjectType($objectType)
    {
        $this->objectType = $objectType;
        
        return $this;
    }

    /**
     * Get objectType
     *
     * @return string
     */
    public function getObjectType()
    {
        return $this->objectType;
    }
}
