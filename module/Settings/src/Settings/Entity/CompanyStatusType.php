<?php
namespace Settings\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Sole Proprietorship
 * Private 
 * Public
 * Listed On Nigeria Stock Exchange
 * Listed on Nigeria and Foriegn Exchage
 * Listed On Forign Stock Exchange
 * Listed on the Unlisted Securities Market
 * 
 * @ORM\Entity
 * @ORM\Table(name="company_status_type")
 * @author otaba
 *        
 */
class CompanyStatusType
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="type", type="string" , nullable=true)
     * @var string
     */
    private $type;
    
    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getType(){
        return $this->type;
    }
    
    public function setType($type){
        $this->type = $type;
        return $this;
    }
}

