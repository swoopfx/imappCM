<?php
namespace Users\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="broker_logo")
 *
 * @author swoopfx
 *        
 */
class BrokerLogo
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
     * @var string @ORM\Column(name="image", type="string", nullable=false)
     */
    private $image;

    /**
     *
     * @var string @ORM\Column(name="image_type", type="string", nullable=true)
     *     
     */
    private $imageType;

    /**
     *
     * @var integer @ORM\Column(name="image_size", type="integer", nullable=true)
     */
    private $imageSize;

    /**
     *
     * @var datetime @ORM\Column(name="created_on", type="datetime", nullable=true)
     */
    private $createdOn;

    /**
     *
     * @var datetime @ORM\Column(name="updated_on", type="datetime", nullable=true)
     */
    private $updatedOn;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function getImageType()
    {
        return $this->imageType;
    }

    public function setImageType($type)
    {
        $this->imageType = $type;
        return $this;
    }

    public function getImageSize()
    {
        return $this->imageSize;
    }

    public function setImageSize($size)
    {
        $this->imageSize = $size;
        return $this;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function setCreatedOn($date)
    {
        $this->createdOn = $date;
        $this->updatedOn = $date;
        return $this;
    }

    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    public function setUpdatedOn($date)
    {
        $this->updatedOn = $date;
    }
}

