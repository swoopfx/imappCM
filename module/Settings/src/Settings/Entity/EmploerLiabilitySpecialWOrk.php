<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="employer_liability_special_work")
 *
 * @author otaba
 *        
 */
class EmploerLiabilitySpecialWOrk
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * (a) radio isotopes, radio-active substance or other sources of ionising (a)
     * (b) acids, gases, chemicals or explosives? (b)
     * (c) asbestos or silica or material containing silica? (c)
     * (d) any other materials giving rise to dust or fumes?
     * @ORM\Column(name="work", type="string", nullable=false)
     * 
     * @var string
     */
    private $work;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    public function getId()
    {
        return $this->id;
    }

    public function getWork()
    {
        return $this->work;
    }

    public function setWork($work)
    {
        $this->work = $work;
        return $this;
    }
}

