<?php
namespace Users\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tjis class defines the information extratted fot the setup acceptance form
 * 
 * @author swoopfx
 *        
 *         @ORM\Table(name="setup_info")
 *         @ORM\Entity
 *        
 */
class SetupInfo
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(name="info", type="text", nullable=false)
     * 
     * @var text
     */
    protected $info;

    public function getId()
    {
        return $this->id;
    }

    public function setInfo($info)
    {
        $this->info = $info;
        return $this;
    }

    public function getInfo()
    {
        return $this->info;
    }
}

?>