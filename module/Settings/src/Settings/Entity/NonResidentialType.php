<?php
namespace Settings\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Factory, Boarding or Lodging, or Office premises Others
 * @ORM\Entity
 * @ORM\Table(name="non_residential_type")
 * @author otaba
 *        
 */
class NonResidentialType
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    
    /**
     * @ORM\Column(name="type", type="string", nullable=true)
     * @var string
     */
    private $type;
    
    /**
     */
    public function __construct()
    {
        
        
    }
    
    public function getId(){
        return $this->id;
    }
    /**
     * @return the $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    
}

