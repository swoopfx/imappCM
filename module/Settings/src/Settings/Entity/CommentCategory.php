<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="comment_category")
 * @author swoopfx
 *        
 */
class CommentCategory
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     *
     */
    private $id;

    /**
     *
     * @ORM\Column(name="comment_category", type="string", nullable=false)
     * @var string
     */
    private $category;

    public function __construct()
    {}

  
    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }
    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }


}

