<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\FireAndSpecialPeril;

/**
 *
 * @author otaba
 *        
 */
class FireAndSpecialPerilFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;

    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new FireAndSpecialPeril())->setHydrator($hydrator);
        $this->addField();
    }
    
    private function addField(){
        $this->add(array(
            "name"=>"buildingType",
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Building Use',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\BuildingType',
                'empty_option' => '-- Select a Building use --',
                'property' => 'type'
                
            ),
            'attributes' => array(
                'id' => 'building_type',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            "name"=>"wallType",
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Building Wall Type',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\BuildingWallType',
                // 'empty_option' => '-- Select a Proposed Insurer --',
                'empty_option' => '-- Select a Wall Type --',
                'property' => 'wallType'
                
            ),
            'attributes' => array(
                'id' => 'wallType',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            "name"=>"otherWallType",
            "type"=>"text",
            "options"=>array(
                "label"=>"Other Wall Type",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"otherWallType",
                "class"=>"form-control",
//                 ""
            ),
        ));
        
        $this->add(array(
            "name"=>"roofType",
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Building Roof Type',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\BuildingRoofType',
                'empty_option' => '-- Select a Roof Type --', // 'empty_option' => '-- Select a Proposed Insurer --',
                'property' => 'roofType'
                
            ),
            'attributes' => array(
                'id' => 'roofType',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            "name"=>"otherRoofType",
            "type"=>"text",
            "options"=>array(
                "label"=>"Other Roof Type",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"otherRoofType",
                "class"=>"form-control",
                //                 ""
            ),
        ));
        
        $this->add(array(
            "name"=>"floorType",
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Building Floor Type',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\BuildingFloorType',
                'empty_option' => '-- Select a Floor Type --',
                'property' => 'floorType'
                
            ),
            'attributes' => array(
                'id' => 'floorType',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            "name"=>"otherFloorType",
            "type"=>"text",
            "options"=>array(
                "label"=>"Other Floor Type",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"otherFloorType",
                "class"=>"form-control",
                //                 ""
            ),
        ));
        
        $this->add(array(
            "name"=>"numberOfStories",
            "type"=>"number",
            "options"=>array(
                "label"=>"Number Of Stories",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"numberOfStories",
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12"
                
            ),
        ));
        
        $this->add(array(
            "name"=>"ageOfBuilding",
            "type"=>"number",
            "options"=>array(
                "label"=>"Age Of Building",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"ageOfBuilding",
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
//                 'placeholder'=>
                
            ),
        ));
        
        $this->add(array(
            "name" => "isManufacturing",
            "type" => "checkbox",
            "options" => array(
                "label" => "Used for Manufacturing Purpose",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isManufacturing",
                "class" => "col-md-7 col-xs-12",
                "checked" => false
                // "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name"=>"manufacturing",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Manaufacturing Description",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"manufacturing",
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12"
                
            ),
        ));
        
        $this->add(array(
            "name"=>"powerType",
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Building Power Type',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\BuildingPowerType',
                'empty_option' => '-- Select a Power Type --',
                'property' => 'powerType'
                
            ),
            'attributes' => array(
                'id' => 'powerType',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            "name"=>"otherPowerType",
            "type"=>"text",
            "options"=>array(
                "label"=>"Other Power Type",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                ),
                
            ),
            "attributes"=>array(
                "id"=>"otherPowerType",
                'class' => 'form-control',
                "placeholder"=>"if applicable"
            )
        ));
        
        $this->add(array(
            "name" => "isHazardousGoods",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Harzadous Goods",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-5 col-sm-5 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isHazardousGoods",
                "class" => "col-md-5 col-xs-12",
                "checked" => false
                // "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name" => "isFireAlarmSystem",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Fire Alarm System",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-5 col-sm-5 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isFireAlarmSystem",
                "class" => "col-md-5 col-xs-12",
                "checked" => true
                // "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name"=>"fireALarmSystem",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Type Of System",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"fireALarmSystem",
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12"
                
            ),
        ));
        
        $this->add(array(
            "name" => "isFireProtectionSystem",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Protection System",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-5 col-sm-5 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isFireProtectionSystem",
                "class" => "col-md-5 col-xs-12",
                "checked" => false
                // "required"=>"required"
            )
        ));
        
        
        $this->add(array(
            "name"=>"fireProtectionSystem",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Type Of Protection System",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"fireALarmSystem",
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12"
                
            ),
        ));
        
//         $this->add(array(
//             "name"=>"coverList",
//             "type"=>""
//         ));

        $this->add(array(
            "name" => "isPreviousDecline",
            "type" => "checkbox",
            "options" => array(
                "label" => "Is Declined By Previous Insurer",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-5 col-sm-5 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isPreviousDecline",
                "class" => "col-md-5 col-xs-12",
                "checked" => false
                // "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name" => "isSpecialPeril",
            "type" => "checkbox",
            "options" => array(
                "label" => "Special Peril",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-5 col-sm-5 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isSpecialPeril",
                "class" => "col-md-5 col-xs-12",
                "checked" => false
                // "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name" => "isAircraft",
            "type" => "checkbox",
            "options" => array(
                "label" => "Damage by aircraft",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-5 col-sm-5 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isAircraft",
                "class" => "col-md-5 col-xs-12",
                "checked" => false
                // "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name" => "isExplosion",
            "type" => "checkbox",
            "options" => array(
                "label" => "damage by explosion",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-5 col-sm-5 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isExplosion",
                "class" => "col-md-5 col-xs-12",
                "checked" => false
                // "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name" => "isRiotNdStrike",
            "type" => "checkbox",
            "options" => array(
                "label" => "Damage by riot",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-5 col-sm-5 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isRiotNdStrike",
                "class" => "col-md-5 col-xs-12",
                "checked" => false
                // "required"=>"required"
            )
        ));
        
        
        $this->add(array(
            "name" => "isMaliciousDamage",
            "type" => "checkbox",
            "options" => array(
                "label" => "Malicious damage",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-5 col-sm-5 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isMaliciousDamage",
                "class" => "col-md-5 col-xs-12",
                "checked" => false
                // "required"=>"required"
            )
        ));
        
        
        $this->add(array(
            "name" => "isBushFire",
            "type" => "checkbox",
            "options" => array(
                "label" => "Damage by bush fire",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-5 col-sm-5 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isBushFire",
                "class" => "col-md-5 col-xs-12",
                "checked" => false
                // "required"=>"required"
            )
        ));
        
        
        $this->add(array(
            "name" => "isTornado",
            "type" => "checkbox",
            "options" => array(
                "label" => "Damage by tornado",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-5 col-sm-5 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isTornado",
                "class" => "col-md-5 col-xs-12",
                "checked" => false
                // "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name" => "isFlood",
            "type" => "checkbox",
            "options" => array(
                "label" => "Damage by Flood",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-5 col-sm-5 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isFlood",
                "class" => "col-md-5 col-xs-12",
                "checked" => false
                // "required"=>"required"
            )
        ));
        
        
        
        $this->add(array(
            "name" => "isGoodCondition",
            "type" => "checkbox",
            "options" => array(
                "label" => "Building is in good Condition",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-5 col-sm-5 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isGoodCondition",
                "class" => "col-md-5 col-xs-12",
                "checked" => true
                // "required"=>"required"
            )
        ));
        
        
        
        $this->add(array(
            "name" => "isBurstPipes",
            "type" => "checkbox",
            "options" => array(
                "label" => "Damage by burst pipes",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-5 col-sm-5 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isBurstPipes",
                "class" => "col-md-5 col-xs-12",
                "checked" => false
                // "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name" => "isImpact",
            "type" => "checkbox",
            "options" => array(
                "label" => "Damage by physical Impact",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-5 col-sm-5 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isImpact",
                "class" => "col-md-5 col-xs-12",
                "checked" => false
                // "required"=>"required"
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
            "buildingType"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "wallType"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "roofType"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "floorType"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isManufacturing"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "powerType"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isImpact"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isBurstPipes"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isGoodCondition"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isFlood"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            
            "isTornado"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            
            "isBushFire"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            
            "isMaliciousDamage"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isRiotNdStrike"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isExplosion"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isAircraft"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isSpecialPeril"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isPreviousDecline"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isFireProtectionSystem"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isFireAlarmSystem"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isHazardousGoods"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isManufacturing"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "numberOfStories"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "ageOfBuilding"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            
//            
        );
        
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

