<?php
namespace Object\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Settings\Entity\NonBusinessEquipment;

/**
 *
 * @author otaba
 *        
 */
class NonBusinessEquipmentFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;

   public function init(){
       $hydrator = new DoctrineObject($this->entityManager);
       $this->setHydrator($hydrator)->setObject(new NonBusinessEquipment());
       return $this->addField();
   }
   
   private function addField(){
       $this->add(array(
           "name"=>"equipmentCategory",
           "type"=>"DoctrineModule\Form\Element\ObjectSelect",
           "options"=>array(
               "label"=>"Equipment Category",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               ),
               'object_manager' => $this->entityManager,
               'target_class' => 'Settings\Entity\BusinessEquipments',
               'property' => 'equipments',
               'empty_option' => '-- Select a Category  --',
           ),
           "attributes"=>array(
               'class' => 'form-control col-md-8 col-sm-8 col-xs-12',
               "required"=>"required",
               "multiple"=>true,
               "data-toggle"=>"select2",
               "data-placeholder"=>"Select a Category ..",
               "data-allow-clear"=>true,
               "required"=>"required"
           )
           
          
       ));
       $this->add(array(
           "name"=>"equipmentName",
           "type"=>"text",
           'options'=>array(
               "label"=>"Equipment Name",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "placeholder"=>"TECHNO CX Air",
               "class"=>"form-control col-md-8 col-sm-8 col-xs-12",
               "required"=>"required"
           )
       ));
       
       $this->add(array(
           "name"=>"equipmentDesc",
           "type"=>"textarea",
           "options"=>array(
               "label"=>"Equipment Description",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-8 col-sm-8 col-xs-12",
               "placeholder"=>"",
           ),
           
           
       ));
       
       $this->add(array(
           "name"=>"equipmentUid",
           "type"=>"text",
           "options"=>array(
               "label"=>"Equipment ID",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-8 col-sm-8 col-xs-12",
               "placeholder"=>"e.g IMEI number",
           ),
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
    
    public function setENtityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

