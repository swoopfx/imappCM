<?php
namespace Object\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Object\Entity\ObjectTravel;
use Zend\Form\Element\DateSelect;

/**
 *
 * @author otaba
 *        
 */
class ObjectTravelFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;

    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new ObjectTravel());
        $this->addField();
    }
    
    private function addField(){
        
        $this->add(array(
            "name"=>"passportName",
            "type"=>"text",
            "options"=>array(
                "label"=>"Passport Name",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-xs-12",
                "placeholder"=>"Hamzat Chukudi Olusegun",
                "required"=>"required",
            )
        ));
        
//         $this->add(array(
//             "name"=>"passportLastName",
//             "type"=>"text",
//             "options"=>array(
//                 "label"=>"Passport LastName",
//                 "label_attributes"=>array(
//                     "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes"=>array(
//                 "class"=>"form-control col-md-7 col-xs-12",
//                 "placeholder"=>"Chukwudi",
//                 "required"=>"required",
//             )
//         ));
        
        
//         $this->add(array(
//             "name"=>"passportOtherName",
//             "type"=>"text",
//             "options"=>array(
//                 "label"=>"Passport MiddleName",
//                 "label_attributes"=>array(
//                     "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes"=>array(
//                 "class"=>"form-control col-md-7 col-xs-12",
//                 "placeholder"=>"Olusegun"
//             )
//         ));
        
//         $this->add(array(
//             "name"=>"passportOtherName",
//             "type"=>"text",
//             "options"=>array(
//                 "label"=>"Passport MiddleName",
//                 "label_attributes"=>array(
//                     "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes"=>array(
//                 "class"=>"form-control col-md-7 col-xs-12",
//                 "placeholder"=>"Olusegun"
//             )
//         ));
        
        
        $this->add(array(
            'name' => 'title',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Title:',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
               // 'empty_option' => '--- Select Your Destination ---',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Title',
                'property' => 'title'
            ),
            'attributes' => array(
                'id' => 'form_status',
                'class' => 'form-control col-md-7 col-xs-12',
                "required"=>"required"
            )
        ));
        
        $this->add(array(
            'name' => 'sex',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Sex',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                // 'empty_option' => '--- Select Your Destination ---',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Sex',
                'property' => 'sex'
            ),
            'attributes' => array(
                'id' => 'form_status',
                'class' => 'form-control col-md-7 col-xs-12'
            )
        ));
        
        $this->add(array(
            'name' => 'placeOfIssue',
            'type' => 'text',
            'options' => array(
                'label' => 'Passport Issue Place',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
               // 'id' => 'customer_name',
                //'required' => 'required',
                'class' => 'form-control',
                'title' => 'Provide your customers full name',
                //'placeholder' => '10 days'
            )
        ));
        
        
        $this->add(array(
            'name' => 'age',
            'type' => 'Zend\Form\Element\Date',
            'options' => array(
                'label' => 'Date Of Birth :',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
//                 "day_attributes"=>array(
//                     "class"=>"form-control",
//                     "style"=>"width: 15%",
//                 ),
//                 "month_attributes"=>array(
//                     "class"=>"form-control",
//                     "style"=>"width: 30%",
//                 ),
//                 "year_attributes"=>array(
//                     "class"=>"form-control",
//                     "style"=>"width: 30%",
//                 )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-7 col-xs-12',
                //"required"=>"required"
            )
        ));
        
        $this->add(array(
            'name' => 'passportDateCreated',
            'type' => 'date',
            'options' => array(
                'label' => 'Passport Issue Date :',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                "month_attributes" => array(
                    "class" => "form-control col-md-7 col-xs-12",
                    "style" => "width: 30%"
                ),
                "year_attributes" => array(
                                "class"=>"form-control col-md-8 col-xs-12",
                                "style"=>"width: 30%",
                            )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-7 col-xs-12',
                "required"=>"required"
                
            )
        ));
        
        $this->add(array(
            'name' => 'passportExpiryDate',
            'type' => 'date',
            'options' => array(
                'label' => 'Passport Expiry Date:',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                "month_attributes" => array(
                    "class" => "form-control col-md-7 col-xs-12",
                    "style" => "width: 30%"
                ),
                "year_attributes" => array(
                    "class"=>"form-control col-md-8 col-xs-12",
                    "style"=>"width: 30%",
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-7 col-xs-12',
                 "required"=>"required"
                
            )
        ));
        
        $this->add(array(
            'name' => 'passportNumber',
            'type' => 'text',
            'options' => array(
                'label' => 'Passport Number:',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-7 col-xs-12',
                "required"=>"required"
                
            )
        ));
        
//         $this->add(array(
//             "name" => "isPreExistingMedical",
//             "type" => "Zend\Form\Element\Radio",
//             "options" => array(
//                 'label' => 'Do you have Pre-Existing Medical Condition',
//                 'label_attributes' => array(
//                     'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
//                 ),
//                 'value_options' => array(
//                     '0' => 'No',
//                     '1' => 'Yes'
                    
//                 )
//             ),
//             'attributes' => array(
//                 'class' => 'form-control col-md-8 col-sm-8 col-xs-12',
//                 // 'placeholder' => 'E.g 300sqm'
//             )
//         ));
        
//         $this->add(array(
//             'name' => 'medicalCondition',
//             'type' => 'textarea',
//             'options' => array(
//                 'label' => 'Give a more detailed medical condition (If any):',
//                 'label_attributes' => array(
//                     'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
//                 )
//             ),
//             'attributes' => array(
//                 'class' => 'form-control col-md-7 col-xs-12',
//                 "required"=>"required"
                
//             )
//         ));
        
       
        
        
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

