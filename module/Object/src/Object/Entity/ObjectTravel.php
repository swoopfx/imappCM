<?php
namespace Object\Entity;

use Doctrine\ORM\Mapping as ORM;

use Settings\Entity\Title;
use Settings\Entity\Sex;

/**
 * @ORM\Entity
 * @ORM\Table(name="object_travel")
 *
 * @author otaba
 *        
 */
class ObjectTravel
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="passport_name", type="string", nullable=true)
     * 
     * @var \DateTime
     */
    private $passportName;

    /**
     * @ORM\Column(name="passport_lastname", type="string", nullable=true)
     * 
     * @var \DateTime
     */
    private $passportLastName;

    /**
     * @ORM\Column(name="passport_othername", type="string", nullable=true)
     * 
     * @var \DateTime
     */
    private $passportOtherName;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Title")
     * 
     * @var Title
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Sex")
     * 
     * @var Sex
     */
    private $sex;

    /**
     * @ORM\Column(name="age", type="datetime", nullable=true)
     * 
     * @var \DateTime
     */
    private $age;

    /**
     * @ORM\Column(name="mobile_number", type="string", nullable=true)
     * 
     * @var string
     */
    private $mobileNumber;

    /**
     * @ORM\Column(name="passport_number", type="string", nullable=true)
     * 
     * @var string
     */
    private $passportNumber;

    /**
     * @ORM\Column(name="passport_date_created", type="datetime", nullable=true)
     * 
     * @var datetime
     */
    private $passportDateCreated;

    /**
     * @ORM\Column(name="passport_expiry_date", type="datetime", nullable=true)
     * 
     * @var datetime
     */
    private $passportExpiryDate;

    /**
     * @ORM\Column(name="place_of_issue", type="string", nullable=true)
     * 
     * @var string
     */
    private $placeOfIssue;

    /**
     *
     * @var \Object\Entity\Object
     *  @ORM\OneToOne(targetEntity="Object\Entity\Object", inversedBy="objectTravel")
     *     
     */
    private $object;

//     /**
//      * @ORM\ManyToOne(targetEntity="Settings\Entity\Country")
//      *
//      * @var Country
//      */
//     private $destination;

//     /**
//      * @ORM\Column(name="period_of_insurance", type="string", nullable=true)
//      *
//      * @var string
//      */
//     private $periodOfInsurance;

//     /**
//      * @ORM\Column(name="departure_date", type="datetime", nullable=true)
//      *
//      * @var \DateTime
//      */
//     private $departureDate;

//     /**
//      * @ORM\Column(name="return_date", type="datetime", nullable=true)
//      *
//      * @var \DateTime
//      */
//     private $returnDate;

//     /**
//      * /**
//      * @ORM\Column(name="purpose_of_trip", type="text", nullable=true)
//      *
//      *
//      * @var text
//      */
//     private $purposeOfTrip;

//     /**
//      * @ORM\Column(name="is_preexisting_medical_condition", type="boolean", nullable=true, options={"default"=false})
//      *
//      * @var boolean
//      */
//     private $isPreExistingMedical;

//     /**
//      * @ORM\Column(name="medical_condition", type="text", nullable=true)
//      *
//      * @var unknown
//      */
//     private $medicalCondition;

    /**
     */
    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getPassportName()
    {
        return $this->passportName;
    }

    public function setPassportName($pass)
    {
        $this->passportName = $pass;
        return $this;
    }

    public function getPassportLastName()
    {
        return $this->passportLastName;
    }

    public function setPassportLastName($name)
    {
        $this->passportLastName = $name;
        return $this;
    }

    public function getPassportOtherName()
    {
        return $this->passportOtherName;
    }

    public function setPassportOtherName($pass)
    {
        $this->passportOtherName = $pass;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getSex()
    {
        return $this->sex;
    }

    public function setSex($sex)
    {
        $this->sex = $sex;
        return $this;
    }
    
    public function getAge(){
        return $this->age;
    }
    
    public function setAge($age){
        $this->age = $age;
        return $this;
    }
    
    public function setMobileNumber($num){
        $this->mobileNumber = $num;
        return $this;
    }
    
    public function getMobileNumber(){
        return $this->mobileNumber;
    }
    
    
    public function getPassportNumber(){
        return $this->passportNumber;
    }
    
    public function setPassportNumber($num){
        $this->passportNumber = $num;
        return $this;
    }
    
    public function getPassportDateCreated(){
        return $this->passportDateCreated;
    }
    
    public function setPassportDateCreated($date){
        $this->passportDateCreated = $date;
        return $this;
    }
    
    public function getPassportExpiryDate(){
        return $this->passportExpiryDate;
    }
    
    public function setPassportExpiryDate($date){
        $this->passportExpiryDate = $date;
        return $this;
    }
    
    public function getPlaceOfIssue(){
        return $this->placeOfIssue ;
    }
    
    public function setPlaceOfIssue($place){
        $this->placeOfIssue = $place ;
        return $this;
    }
    
    public function getObject(){
        return $this->object;
    }
    
    /**
     * 
     * @param object $obj
     * @return \Object\Entity\ObjectTravel
     */
    public function setObject($obj){
        $this->object = $obj;
        $obj->setObjectTravel($this);
        return  $this;
    }

//     public function getDestination()
//     {
//         return $this->destination;
//     }

//     public function setDestination($des)
//     {
//         $this->destination = $des;
//         return $this;
//     }

//     public function getPeriodOfinsurance()
//     {
//         return $this->periodOfInsurance;
//     }

//     public function setPeriodOfInsurance($ins)
//     {
//         $this->periodOfInsurance = $ins;
//         return $this;
//     }

//     public function getDepartureDate()
//     {
//         return $this->departureDate;
//     }

//     public function setDepartureDate($date)
//     {
//         $this->departureDate = $date;
//         return $this;
//     }

//     public function getReturnDate()
//     {
//         return $this->returnDate;
//     }

//     public function setReturnDate($date)
//     {
//         $this->returnDate = $date;
//         return $this;
//     }

//     public function getPurposeOfTrip()
//     {
//         return $this->purposeOfTrip;
//     }

//     public function setPurposeOfTrip($trip)
//     {
//         $this->purposeOfTrip = $trip;
//         return $this;
//     }

//     public function getIsPreExistingMedical()
//     {
//         return $this->isPreExistingMedical;
//     }

//     public function setIsPreExistingMedical($is)
//     {
//         $this->isPreExistingMedical = $is;
//         return $this;
//     }

//     public function getMedicalCondition()
//     {
//         return $this->medicalCondition;
//     }

//     public function setMedicalCondition($con)
//     {
//         $this->medicalCondition = $con;
//         return $this;
//     }
}

