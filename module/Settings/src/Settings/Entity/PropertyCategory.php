<?php
namespace All\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PropertyCategory
 *
 * @ORM\Table(name="property_category", uniqueConstraints={@ORM\UniqueConstraint(name="property_category_UNIQUE", columns={"property_category"})})
 * @ORM\Entity
 */
class PropertyCategory
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
     * @var string @ORM\Column(name="property_category", type="string", length=45, nullable=false)
     */
    private $propertyCategory;

    /**
     *
     * @var \Doctrine\Common\Collections\Collection @ORM\ManyToMany(targetEntity="All\Entity\Object", mappedBy="idPropertyCategory")
     */
    private $idObject;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idObject = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set propertyCategory
     *
     * @param string $propertyCategory            
     *
     * @return PropertyCategory
     */
    public function setPropertyCategory($propertyCategory)
    {
        $this->propertyCategory = $propertyCategory;
        
        return $this;
    }

    /**
     * Get propertyCategory
     *
     * @return string
     */
    public function getPropertyCategory()
    {
        return $this->propertyCategory;
    }

    /**
     * Add idObject
     *
     * @param \All\Entity\Object $idObject            
     *
     * @return PropertyCategory
     */
    public function addIdObject( $idObject)
    {
        $this->idObject[] = $idObject;
        
        return $this;
    }

    /**
     * Remove idObject
     *
     * @param \All\Entity\Object $idObject            
     */
    public function removeIdObject( $idObject)
    {
        $this->idObject->removeElement($idObject);
    }

    /**
     * Get idObject
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdObject()
    {
        return $this->idObject;
    }
}
