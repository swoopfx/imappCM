<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

/**
 *
 * @author otaba
 *        
 */
class FidelityGaurateeEmployeeListFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;

   public function init(){
       $this->addFields();
   }
   private function addFields(){
       $this->add(array(
           "name"=>"employyefullName",
           "type"=>"text",
           "options"=>array(
               "label" => "Employee Full Name",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-7 col-xs-12",
               "id"=>"employyefullName",
               "placeholder"=>"Steve Anucham"
           )
       ));
       
       
       $this->add(array(
           "name"=>"employeeCapacity",
           "type"=>"text",
           "options"=>array(
               "label" => "Employee Designation",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-7 col-xs-12",
               "id"=>"employeeCapacity",
           )
       ));
       
       //employeeGuarateeAmount
       
       $this->add(array(
           "name"=>"employeeGuarateeAmount",
           "type"=>"text",
           "options"=>array(
               "label" => "Employee guaratee amount",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-7 col-xs-12",
               "id"=>"employeeGuarateeAmount",
               "placeholder"=>"120000"
           )
       ));
       
       $this->add(array(
           "name"=>"yearsdOfService",
           "type"=>"text",
           "options"=>array(
               "label" => "Years In Service",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-7 col-xs-12",
               "id"=>"yearsdOfService",
               
           )
       ));
       
       
       $this->add(array(
           "name"=>"employeeSalary",
           "type"=>"text",
           "options"=>array(
               "label" => "Employee Salary",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-7 col-xs-12",
               "id"=>"employeeSalary",
               "placeholder"=>"30000"
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
        
        return array();
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

