<?php
namespace Object\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Object\Entity\ObjectBuildingData;
//use Zend\Filter\Digits;

/**
 *
 * @author otaba
 *        
 */
class ObjectBuildingFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new ObjectBuildingData());
        $this->addField();
    }

    private function addField()
    {
        $this->add(array(
            'name' => 'houseAdd1',
            'type' => 'text',
            'options' => array(
                'label' => 'House Address',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-9 col-xs-12',
                'placeholder' => 'No 34 Runsware street',
                "required"=>"required"
            )
        ));
        $this->add(array(
            'name' => 'houseAdd2',
            'type' => 'text',
            'options' => array(
                'label' => '.',
                'label_attributes' => array(
                    "class"=>'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-9 col-xs-12',
                'placeholder' => 'Mushin'
            )
        ));
        
        $this->add(array(
            'name' => 'houseDescription',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Building Description',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-9 col-xs-12',
                'placeholder' => 'Brief description of the house'
            
            )
        ));
        $this->add(array(
            "name"=>"noOfRooms",
            "type"=>"number",
            "options"=>array(
                "label"=>"No of Rooms",
                "label_attributes"=>array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12',
                )
            ),
            "attributes"=>array(
                "class"=>'form-control col-md-9 col-xs-12',
                "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name" => "city",
            'type' => 'text',
            'options' => array(
                'label' => 'City',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-9 col-xs-12',
                'placeholder' => 'E.g Ikeja',
               
            
            )
        ));
        
        $this->add(array(
            'name' => 'country',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Country',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Country',
                'property' => 'countryName',
                'empty_option' => '-- Select Country  --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'country_id',
                'class' => 'form-control col-md-8 col-sm-8 col-xs-12',
                "required" => "required",
                "value" => 156,
                "required"=>"required"
                // 'data-ng-model' => 'selectedService',
                // 'data-ng-change' => 'onCategoryChange(selectedService)'
            )
        ));
        
        $this->add(array(
            'name' => 'state',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'State / Province',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Zone',
                'property' => 'zoneName',
                'empty_option' => '-- Select State / Province  --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'state_id',
                'class' => 'form-control col-md-8 col-sm-8 col-xs-12',
                "required" => "required",
                "value"=>152
                // 'data-ng-model' => 'selectedService',
                // 'data-ng-change' => 'onCategoryChange(selectedService)'
            )
        ));
        
        $this->add(array(
            'name' => 'wallType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Wall Type',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\BuildingWallType',
                'property' => 'wallType',
                'empty_option' => '-- Select a Wall Type  --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-8 col-sm-8 col-xs-12',
                'placeholder' => 'E.g Concrete, Wood, Brick, Sythetic Fiber, Blocks'
            )
        ));
        
        $this->add(array(
            'name' => 'roofType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            
            'options' => array(
                'label' => 'Roof Type',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\BuildingRoofType',
                'property' => 'roofType',
                'empty_option' => '-- Select a Roof Type  --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-8 col-sm-8 col-xs-12',
                'placeholder' => 'E.g Coated aluminium, non-coated Aluminium roofing Sheet, iron sheet, raft, straw, plastic, systhethic'
            )
        ));
        
        $this->add(array(
            'name' => 'floorArea',
            'type' => 'text',
            'options' => array(
                'label' => 'Total Floor Area',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-8 col-sm-8 col-xs-12',
                'placeholder' => 'E.g 300sqm',
                'data-toggle'=>"touch-spin",
                'data-min'=>"0",
                'data-max'=>"1000000", 
                'data-postfix'=>"sqm",
                'data-step'=>"0.1", 
                'data-decimals'=>"2"
            )
        ));
        
//         $this->add(array(
//             "name" => "IsPreviousInsured",
//             "type" => "Zend\Form\Element\Radio",
//             "options" => array(
//                 'label' => 'Has THe Building Been PreviousLy Insured',
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
//                // 'placeholder' => 'E.g 300sqm'
//             )
//         ));
        
//         $this->add(array(
//             'name' => 'previousInsurer',
//             'type' => 'DoctrineModule\Form\Element\ObjectSelect',
//             'options' => array(
//                 'label' => 'Previous Insurance Company',
//                 'object_manager' => $this->entityManager,
//                 'target_class' => 'Settings\Entity\Insurer',
//                 'property' => 'insuranceName',
//                 'empty_option' => '-- Select Previous Insurance Company  --',
//                 'label_attributes' => array(
//                     'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
//                 )
//             ),
//             'attributes' => array(
//                 'id' => 'currency',
//                 'class' => 'form-control col-md-8 col-sm-8 col-xs-12',
//                 "required" => "required"
//                 // "value"=>152
//                 // 'data-ng-model' => 'selectedService',
//                 // 'data-ng-change' => 'onCategoryChange(selectedService)'
//             )
//         ));
        
        $this->add(array(
            'name' => 'buildingType',
            'type' => 'DoctrineModule\Form\Element\ObjectRadio',
            'options' => array(
                'label' => 'Building Type',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\BuildingType',
                'property' => 'type',
                'empty_option' => '-- Select Previous Insurance Company  --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'buildingType',
               // 'class' => 'form-control col-md-8 col-sm-8 col-xs-12',
                "required" => "required"
                // "value"=>152
                // 'data-ng-model' => 'selectedService',
                // 'data-ng-change' => 'onCategoryChange(selectedService)'
            )
        ));
        
        $this->add(array(
            "name" => "isIntruderAlarmSystem",
            "type" => "Zend\Form\Element\Select",
            "options" => array(
                'label' => 'Has Intruder Alarm System',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12',
                    'data-toggle'=>'tooltip',
                    'data-placement'=>'top',
                    'title'=>'An intruder alarm system notify you of an un-authorized person in the building'
                    
                ),
                'value_options' => array(
                    "0"=>"FALSE",
                    "1"=>"TRUE",
                    
                )
            ),
            'attributes' => array(
               'class' => 'form-control col-md-8 col-sm-8 col-xs-12',
                // 'placeholder' => 'E.g 300sqm'
                
               
            )
        ));
        
        $this->add(array(
            "name" => "isFireAlarmSystem",
            "type" => "Zend\Form\Element\Select",
            "options" => array(
                'label' => "Has Fire Alarm System  ",
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12',
                    'data-toggle'=>'tooltip',
                   'data-placement'=>'top',
                    'title'=>'A fire alarm system is a device that notifiy you in case there is a fire or smoke'
                ),
                'value_options' => array(
                    "0"=>"FALSE",
                    "1"=>"TRUE",
                    
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-8 col-sm-8 col-xs-12',
                // 'placeholder' => 'E.g 300sqm'
                //"value"=>0
            )
        ));
        
        $this->add(array(
            "name" => "isFireProtectionSystem",
            "type" => "Zend\Form\Element\Select",
            "options" => array(
                'label' => "Has fire protection system ",
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12',
                    'data-toggle'=>'tooltip',
                    'data-placement'=>'top',
                    'title'=>'A fire protection system reduces the effect of fire on a building'
                ),
                'value_options' => array(
                    "0"=>"FALSE",
                    "1"=>"TRUE",
                    
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-8 col-sm-8 col-xs-12',
                // 'placeholder' => 'E.g 300sqm'
                //"value"=>0
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
//             "isFireProtectionSystem"=>array(
//                 "validators"=>array(
//                     array(
//                         "name"=>'Digits',
//                         "break_chain_on_failure"=>true,
//                         "options"=>array(
//                             ""
//                         )
//                     )
//                 )
//             ),
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

