<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="cover_category")
 *
 * This defines where the covernote is originating from
 * Offer, Proposals , Packages, or float
 * 
 * @author otaba
 *        
 *        
 */
class CoverCategory
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="category", type="string", nullable=false)
     * 
     * @var string
     */
    private $category;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($cat)
    {
        $this->category = $cat;
        return $this;
    }
}

