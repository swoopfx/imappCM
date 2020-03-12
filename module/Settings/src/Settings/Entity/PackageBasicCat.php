<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PackageBasicCat
 *
 * @author swoopfx
 *        
 *         @ORM\Table(name="package_basic_cat")
 *         @ORM\Entity
 *        
 */
class PackageBasicCat
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Package categories are Agent and Brokers
     *
     * @var string @ORM\Column(name="package_cat", type="string", length=100, nullable=true)
     */
    private $packageCat;

    public function getId()
    {
        return $this->id;
    }

    public function getPackageCat()
    {
        return $this->packageCat;
    }

    public function setPackageCat($pack)
    {
        $this->packageCat = $pack;
        
        return $this;
    }
}

?>