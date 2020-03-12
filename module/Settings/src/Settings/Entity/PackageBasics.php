<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PackageBasics
 *
 * @author swoopfx
 *         @ORM\Table(name="package_basics")
 *         @ORM\Entity
 */
class PackageBasics
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
     * @var \Settings\Entity\PackageBasicCat @ORM\ManyToOne(targetEntity="Settings\Entity\PackageBasicCat")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="basic_category_id", referencedColumnName="id")
     *      })
     */
    private $packageCategory;

    /**
     *
     * @var string @ORM\Column(name="package_details", type="text", nullable=true)
     */
    private $basicDetails;

    /**
     * Get Id
     *
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * get package Basic Cat
     *
     * @return \Settings\Entity\PackageBasicCat
     */
    public function getBasicCategory()
    {
        return $this->basicCategory;
    }

    /**
     *
     * @param \Settings\Entity\PackageBasicCat $cat            
     */
    public function setBasicCategory($cat)
    {
        $this->basicCategory = $cat;
    }

    /**
     * Set The Basic Details
     *
     * @param unknown $details            
     */
    public function setBasicDetails($details)
    {
        $this->basicDetails = $details;
    }

    /**
     * Get Basic Details
     *
     * @return string
     */
    public function getBasicDetails()
    {
        return $this->basicDetails;
    }
}

?>