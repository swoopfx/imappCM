<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\HouseHoldGoods;

/**
 *
 * @author otaba
 *        
 */
class HomeHouseholdGoodsFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;
    

   public function init(){
       
       $hydrator = new DoctrineObject($this->entityManager);
       $this->setHydrator($hydrator)->setObject(new HouseHoldGoods());
       
       $this->add(array(
           "name"=>"goodsName",
           "type"=>"text",
           "options"=>array(
               "label"=>"Name of Goods to be insured",
               "label_attributes"=>array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "id"=>"goodsName",
               "class"=>"form-control col-md-7 col-xs-12",
               "placeholder"=>"60 inch plasma TV"
           )
       ));
       
       $this->add(array(
           "name"=>"value",
           "type"=>"text",
           "options"=>array(
               "label"=>"Value of goods",
               "label_attributes"=>array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "id"=>"value",
               "class"=>"form-control col-md-7 col-xs-12",
               "placeholder"=>"40000"
               
           )
       ));
       
       $this->add(array(
           "name"=>"serialNumber",
           "type"=>"text",
           "options"=>array(
               "label"=>"Serial/Identification Number",
               "label_attributes"=>array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "id"=>"serialNumber",
               "class"=>"form-control col-md-7 col-xs-12",
               "placeholder"=>"IME1234ABS"
           )
       ));
       
      
   }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     *
     */
    public function getInputFilterSpecification()
    {
        
        return array(
            
        );
    }
    
//     public function 

    /**
     * @return the $entityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @param field_type $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }
}

