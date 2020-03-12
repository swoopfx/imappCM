<?php
namespace Object\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="object_others")
 * 
 * @author otaba
 *        
 */
class ObjectOthers
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", nullable=false)
     * @var string
     */
    private $name;
    
    /**
     * @ORM\Column(name="object_type", type="string", nullable=true)
     * @var string
     */
    private $objectType;

    /**
     * @ORM\Column(name="description", type="text", nullable=true)
     * @var Text
     */
    private $description;
    
    
    /**
     * @ORM\OneToOne(targetEntity="Object", inversedBy="objectOthers")
     * @var Object
     */
    private $object;

   
    
    /**
     * @ORM\Column(name="info_definition1", type="string", nullable=true)
     * @var string
     */
    private $infoDefnition1;
    
    /**
     * @ORM\Column(name="information1", type="string", nullable=true)
     * @var string
     */
    private $information1;
    
    /**
     * @ORM\Column(name="info_definition2", type="string", nullable=true)
     * @var string
     */
    private $infoDefnition2;
    
    
   
    
    /**
     * @ORM\Column(name="information2", type="string", nullable=true)
     * @var string
     */
    private $information2;
    
    
    /**
     * @ORM\Column(name="info_definition3", type="string", nullable=true)
     * @var string
     */
    private $infoDefnition3;
    
    
    /**
     * @ORM\Column(name="information3", type="string", nullable=true)
     * @var string
     */
    private $information3;
    
    
    /**
     * @ORM\Column(name="info_definition4", type="string", nullable=true)
     * @var string
     */
    private $infoDefnition4;
    
    
    /**
     * @ORM\Column(name="information4", type="string", nullable=true)
     * @var string
     */
    private $information4;
    
    /**
     * @ORM\Column(name="info_definition5", type="string", nullable=true)
     * @var string
     */
    private $infoDefnition5;
    
    
    /**
     * @ORM\Column(name="information5", type="string", nullable=true)
     * @var string
     */
    private $information5;
    
//     /**
//      *
//      * @ORM\OneToOne(targetEntity="Object\Entity\ObjectValue",  cascade={"persist"})
//      * @ORM\JoinColumn(name="object_value", referencedColumnName="id")
//      *
//      * @var ObjectValue
//      */
//     private $objectValue;

    public function __construct()
    {
        
       
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getObject(){
        return $this->object;
    }
    
    /**
     * 
     * @param Object $obj
     * @return \Object\Entity\ObjectOthers
     */
    public function setObject($obj){
        $this->object = $obj;
        $obj->setObjectOthers($this);
        return $this;
    }
    
    public function setObjectType($type){
        $this->objectType = $type;
        return $this;
    }
    
    public function getObjectType(){
        return $this->objectType;
    }
    public function getName(){
        return $this->name;
    }
    
    public function setName($name){
        $this->name = $name;
        return $this;
    }
    
    public function getDescription(){
        return $this->description;
    }
    
    public function setDescription ($desc){
        $this->description = $desc;
        return $this;
    }
    
    public function getObjectValue(){
        return $this->objectValue;
    }
    
    public function getCreatedOn(){
        return $this->createdOn;
    }
    
    public function setCreatedOn($date){
        $this->createdOn = $date;
        return $this;
    }
    
    public function getInfoDefnition1(){
        return $this->infoDefnition1;
    }
    
    public function setInfoDefnition1($def){
        $this->infoDefnition1 = $def;
        return $this;
    }
    
    public function getInfoDefnition2(){
        return $this->infoDefnition2;
    }
    
    
    public function setInfoDefnition2($def){
        $this->infoDefnition2 = $def;
        return $this;
    }
    public function getInfoDefnition3(){
        return $this->infoDefnition3;
    }
    
    public function setInfoDefnition3($def){
        $this->infoDefnition3 = $def;
        return $this;
    }
    
    public function getInfoDefnition4(){
        return $this->infoDefnition4;
    }
    
    public function setInfoDefnition4($def){
        $this->infoDefnition4 = $def;
        return $this;
    }
    
    public function getInfoDefnition5(){
        return $this->infoDefnition5;
    }
    
    public function setInfoDefnition5($def){
        $this->infoDefnition5 = $def;
        return $this;
    }
    
    public function getInformation1(){
        return $this->information1;
    }
    
    public function setInformation1($info){
        $this->information1  = $info;
        return $this;
        
    }
    
    public function getInformation2(){
        return $this->information2;
    }
    
    public function setInformation2($info){
        $this->information2  = $info;
        return $this;
        
    }
    
    public function getInformation3(){
        return $this->information3;
    }
    
    public function setInformation3($info){
        $this->information3  = $info;
        return $this;
        
    }
    
    public function getInformation4(){
        return $this->information4;
    }
    
    public function setInformation4($info){
        $this->information4  = $info;
        return $this; 
    }
    
    public function getInformation5(){
        return $this->information5;
    }
    
    public function setInformation5($info){
        $this->information5  = $info;
        return $this;
    }
}

