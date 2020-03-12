<?php
namespace Object\Form;

use Zend\Form\Form;


class ObjectTreeForm extends Form
{

   public function init(){
       $this->setAttributes(array(
           "method"=>"POST",
           "class"=>"form-horizontal form-label-left"
       ));
   }
   
   private function addFieldset(){
       $this->add(array(
           "name"=>"objectMotorFieldset",
           "type"=>"Object\Form\Fieldset\ObjectMotorFieldset",
       ));
       
       $this->add(array(
           "name"=>"objectBuildingFieldset",
           "type"=>"Object\Form\Fieldset\ObjectBuildingFieldset",
       ));
       
       $this->add(array(
           "name"=>"objectBusinessEquipmentFieldset",
           "type"=>"Object\Form\Fieldset\ObjectBusinessEquipmentFieldset"
       ));
       
       $this->add(array(
           "name"=>"objectTravelFieldset",
           "type"=>"Object\Form\Fieldset\ObjectTravelFieldset"
       ));
       
   }
}

