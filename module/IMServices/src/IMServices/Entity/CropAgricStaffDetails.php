<?php
namespace IMServices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="crop_agric_staff_details")
 * @author otaba
 *        
 */
class CropAgricStaffDetails
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="post", type="string", nullable=true)
     * @var string
     */
    private $post;
    
    /**
     * @ORM\Column(name="name", type="string", nullable=true)
     * @var string
     */
    private $name;
    
    /**
     * @ORM\Column(name="qualification", type="string", nullable=true)
     * @var string
     */
    private $qualification;
    
    /**
     * @ORM\Column(name="years_in_service", type="string", nullable=true)
     * @var string
     */
    private $yearsInService;
    
    /**
     * @ORM\ManyToOne(targetEntity="IMServices\Entity\CropAgricInsurance", inversedBy="staffDetails")
     * @var CropAgricInsurance
     */
    private $cropAgricInsurance;
    
    
    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getPost(){
        return $this->post;
    }
    
    public function setPost($post){
        $this->post = $post;
        return $this;
    }
    
    
    public function getName(){
        return $this->name;
    }
    
    public  function  setName($name){
        $this->name= $name;
        return $this;
    }
    
    public function getQualification(){
        return $this->qualification;
    }
    
    public function  setQualification($qua){
        $this->qualification = $qua;
        return $this;
    }
    
    public function getYearsInService(){
        return $this->yearsInService;
       
    }
    
    public function setYearsInService($years){
        $this->yearsInService = $years;
        return  $this;
    }
    
    public function getCropAgricInsurance(){
        return $this->cropAgricInsurance;
    }
    
    public function setCropAgricInsurance($crop){
        $this->cropAgricInsurance = $crop;
        return $this;
    }
}

