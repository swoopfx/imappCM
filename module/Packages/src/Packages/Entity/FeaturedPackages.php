<?php
namespace Packages\Entity;

use Doctrine\ORM\Mapping as ORM;
use Users\Entity\InsuranceBrokerRegistered;

/**
 * @ORM\Entity
 * @ORM\Table(name="featured_packages")
 *
 * @author otaba
 * @copyright Ajayi Oluwaseun Ezekiel 2017
 */
class FeaturedPackages
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Packages\Entity\Packages")
     *
     * @var Packages
     */
    private $package1;

    /**
     * @ORM\ManyToOne(targetEntity="Packages\Entity\Packages")
     *
     * @var Packages
     */
    private $package2;

    /**
     * @ORM\ManyToOne(targetEntity="Packages\Entity\Packages")
     *
     * @var Packages
     */
    private $package3;

    /**
     * @ORM\ManyToOne(targetEntity="Packages\Entity\Packages")
     *
     * @var Packages
     */
    private $package4;

    /**
     * @ORM\ManyToOne(targetEntity="Packages\Entity\Packages")
     *
     * @var Packages
     */
    private $package5;

    /**
     * @ORM\ManyToOne(targetEntity="Users\Entity\InsuranceBrokerRegistered", inversedBy="featuredPackages")
     *
     * @var InsuranceBrokerRegistered
     */
    private $broker;

    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $createdOn;

    /**
     * @ORM\Column(name="updated_on", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedOn;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getPackage1()
    {
        return $this->package1;
    }

    public function setPackage1($pack)
    {
        $this->package1 = $pack;
        return $this;
    }

    public function getPackage2()
    {
        return $this->package2;
    }

    public function setPackage2($pack)
    {
        $this->package2 = $pack;
        return $this;
    }

    public function getPackage3()
    {
        return $this->package3;
    }

    public function setPackage3($pack)
    {
        $this->package3 = $pack;
        return $this;
    }

    public function getPackage4()
    {
        return $this->package4;
    }

    public function setPackage4($pack)
    {
        $this->package4 = $pack;
        return $this;
    }

    public function getPackage5()
    {
        return $this->package5;
    }

    public function setPackage5($pack)
    {
        $this->package5 = $pack;
        return $this;
    }

    public function getBroker()
    {
        return $this->broker;
    }

    public function setBroker($brk)
    {
        $this->broker = $brk;
        return $this;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function setCreatedOn($creat)
    {
        $this->createdOn = $creat;
        $this->updatedOn = $creat;
        return $this;
    }

    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    public function setUpdatedOn($date)
    {
        $this->updatedOn = $date;
        return $this;
    }
}