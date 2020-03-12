<?php
namespace Object\Form\Fieldset;



use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Object\Entity\ObjectPersonData;

/**
 *
 * @author otaba
 *        
 */
class ObjectPersonFieldset extends Fieldset implements  InputFilterProviderInterface
{

   private $entityManager;
   
   public function init(){
       $hydrator = new DoctrineObject($this->entityManager);
       $this->setHydrator($hydrator)->setObject(new ObjectPersonData());
       $this->addFields();
   }
   
   
   private function addFields(){
       
       $this->add(array(
           "name"=>"title",
           "type"=>"DoctrineModule\Form\Element\ObjectSelect",
           "options"=>array(
               'label' => 'Title',
               'object_manager' => $this->entityManager,
               'target_class' => 'Settings\Entity\Title',
               'property' => 'title',
              // 'empty_option' => '-- Select a Category  --',
               'label_attributes' => array(
                   'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
               )
           ),
           "attributes"=>array(
               'id' => 'title',
               'class' => 'form-control col-md-9 col-sm-9 col-xs-12',
               "required" => "required"
           ),
       ));
       
       $this->add(array(
           "name"=>"firstname",
           "type"=>"text",
           "options"=>array(
               "label"=>"First Name",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               ),
           ),
           "attributes"=>array(
               "required"=>"required",
               "class"=>"form-control col-md-9 col-sm-9 col-xs-12",
           ),
       ));
       
       $this->add(array(
           "name"=>"lastname",
           "type"=>"text",
           "options"=>array(
               "label"=>"Last Name",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               ),
           ),
           "attributes"=>array(
               "required"=>"required",
               "class"=>"form-control col-md-9 col-sm-9 col-xs-12",
           ),
       ));
       
       $this->add(array(
           "name"=>"othername",
           "type"=>"text",
           "options"=>array(
               "label"=>"Other Name",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               ),
           ),
           "attributes"=>array(
               //"required"=>"required",
               "class"=>"form-control col-md-9 col-sm-9 col-xs-12",
           ),
       ));
       
       $this->add(array(
           "name"=>"mobileNumber",
           "type"=>"text",
           "options"=>array(
               "label"=>"Phone Number",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               ),
           ),
           "attributes"=>array(
               "required"=>"required",
               "class"=>"form-control col-md-9 col-sm-9 col-xs-12",
           ),
       ));
       
       $this->add(array(
           "name"=>"sex",
           "type"=>"DoctrineModule\Form\Element\ObjectSelect",
           "options"=>array(
               'label' => 'Sex',
               'object_manager' => $this->entityManager,
               'target_class' => 'Settings\Entity\Sex',
               'property' => 'sex',
               // 'empty_option' => '-- Select a Category  --',
               'label_attributes' => array(
                   'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
               )
           ),
           "attributes"=>array(
               'id' => 'title',
               'class' => 'form-control col-md-9 col-sm-9 col-xs-12',
              // "required" => "required"
           ),
       ));
       
       $this->add(array(
           "name"=>"title",
           "type"=>"DoctrineModule\Form\Element\ObjectSelect",
           "options"=>array(
               'label' => 'Title',
               'object_manager' => $this->entityManager,
               'target_class' => 'Settings\Entity\Title',
               'property' => 'title',
               // 'empty_option' => '-- Select a Category  --',
               'label_attributes' => array(
                   'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
               )
           ),
           "attributes"=>array(
               'id' => 'title',
               'class' => 'form-control col-md-9 col-sm-9 col-xs-12',
               "required" => "required"
           ),
       ));
       
       
       
       $this->add(array(
           "name"=>"isMarried",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"I am Married",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               ),
           ),
           "attributes"=>array(
              // "required"=>"required",
               "class"=>"form-control col-md-9 col-sm-9 col-xs-12",
           ),
       ));
       
       
       $this->add(array(
           "name"=>"maidenName",
           "type"=>"text",
           "options"=>array(
               "label"=>"Maiden Name",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               ),
           ),
           "attributes"=>array(
               //"required"=>"required",
               "class"=>"form-control col-md-9 col-sm-9 col-xs-12",
               "placeholder"=>"if  applicable",
           ),
       ));
       
       $this->add(array(
           "name"=>"age",
           "type"=>"date",
           "options"=>array(
               "label"=>"Date of Birth",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               ),
           ),
           "attributes"=>array(
//                "required"=>"required",
               "class"=>"form-control col-md-9 col-sm-9 col-xs-12",
           ),
       ));
       
       
       
       $this->add(array(
           "name"=>"countryId",
           "type"=>"DoctrineModule\Form\Element\ObjectSelect",
           "options"=>array(
               'label' => 'Country',
               'object_manager' => $this->entityManager,
               'target_class' => 'Settings\Entity\Country',
               'property' => 'countryName',
               // 'empty_option' => '-- Select a Category  --',
               'label_attributes' => array(
                   'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-9 col-sm-9 col-xs-12",
               "value"=>156
           ),
       ));
       
       $this->add(array(
           "name"=>"cityId",
           "type"=>"DoctrineModule\Form\Element\ObjectSelect",
           "options"=>array(
               'label' => 'City',
               'object_manager' => $this->entityManager,
               'target_class' => 'Settings\Entity\Zone',
               'property' => 'zoneName',
               // 'empty_option' => '-- Select a Category  --',
               'label_attributes' => array(
                   'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-9 col-sm-9 col-xs-12"
           ),
       ));
       
//        $this->add(array(
//            "name"=>"occupation",
//            "type"=>"DoctrineModule\Form\Element\ObjectSelect",
//            "options"=>array(
//                'label' => 'Occupation Category',
//                'object_manager' => $this->entityManager,
//                'target_class' => 'Settings\Entity\OccupationalCategory',
//                'property' => 'occupation',
//                'empty_option' => '-- Select an Occupation  --',
//                'label_attributes' => array(
//                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
//                )
//            ),
//            "attributes"=>array(
//                "class"=>"form-control col-md-9 col-sm-9 col-xs-12",
//                "multiple"=>true,
//                "data-toggle"=>"select2"
//            ),
//        ));
       
       
//        $this->add(array(
//            "name"=>"occupationPost",
//            "type"=>"text",
//            "options"=>array(
//                "label"=>"Occupation Designation",
//                "label_attributes"=>array(
//                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
//                ),
//            ),
//            "attributes"=>array(
//                //"required"=>"required",
//                "class"=>"form-control col-md-9 col-sm-9 col-xs-12",
//                "placeholder"=>"CEO, COO, Manager"
//            ),
//        ));
       
       $this->add(array(
           "name"=>"telephoneNumber",
           "type"=>"text",
           "options"=>array(
               "label"=>"Telephone Number",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "id"=>"telephoneNumber",
               "class"=>"form-control col-md-6 col-sm-6 col-xs-12"
           )
       ));
       
       $this->add(array(
           "name"=>"address",
           "type"=>"textarea",
           "options"=>array(
               "label"=>"Address",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "id"=>"address",
               "class"=>"form-control col-md-6 col-sm-6 col-xs-12"
           )
       ));
       
       $this->add(array(
           "name"=>"communicationMethod",
           "type"=>"text",
           "options"=>array(
               "label"=>"Prefered Communication Method",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "id"=>"communicationMethod",
               "placeholder"=>"email, Phone, fax",
               "class"=>"form-control col-md-6 col-sm-6 col-xs-12"
           )
       ));
       
       $this->add(array(
           "name"=>"isNigerian",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Is Nigeria",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "id"=>"isNigerian",
               "checked"=>true,
               "class"=>"form-control col-md-6 col-sm-6 col-xs-12"
           )
       ));
       
       $this->add(array(
           "name"=>"bvn",
           "type"=>"text",
           "options"=>array(
               "label"=>"BVN",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes"=>array(
               "id"=>"bvn",
               "class"=>"form-control col-md-6 col-sm-6 col-xs-12"
           )
       ));
       
       $this->add(array(
           "name"=>"beneficiary",
           "type"=>"Object\Form\Fieldset\ObjectLifeBeneficiaryFieldset"
       ));
       
       
       
       
   }
    /**
     * {@inheritDoc}
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
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

