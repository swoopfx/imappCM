<?php
namespace Offer\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @author swoopfx
 *         ThirdPartyOffer
 *         @ORM\Table(name="third_party_offer")
 *         @ORM\Entity
 *        
 */
class ThirdPartyOffer
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     *
     * @var \Offer\Entity\Offer @ORM\ManyToOne(targetEntity="Offer\Entity\Offer")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="offer_id", referencedColumnName="id")
     *      })
     */
    protected $offer;

    /**
     *
     * @var string @ORM\Column(name="name", type="text", nullable=true)
     */
    protected $name;

    /**
     *
     * @var \DateTime @ORM\Column(name="age", type="datetime", nullable=true)
     */
    protected $age;

    /**
     *
     * @var string @ORM\Column(name="special_info", type="text", nullable=true)
     */
    protected $special_info;

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
     *
     * @param string $fullName            
     */
    public function setName($fullName)
    {
        $this->name = $fullName;
        
        return $this;
    }

    public function setSpecialInfo($specialInfo)
    {
        $this->special_info = $specialInfo;
        
        return $this;
    }

    public function getSpecial()
    {
        return $this->special_info;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }
}