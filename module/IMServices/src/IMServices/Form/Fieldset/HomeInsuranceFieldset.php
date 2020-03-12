<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\HomeInsurance;

/**
 *
 * @author otaba
 *        
 */
class HomeInsuranceFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new HomeInsurance())->setHydrator($hydrator);
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            "name"=>"insuredSum",
            "type"=>"text",
            "options"=>array(
                "label"=>"Insured Sum",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"insuredSum",
                "class"=>"form-control col-md-5 col-xs-12",
                "placeholder"=>"0.00"
            )
        ));
        
        $this->add(array(
            'name' => 'occupierCategory',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Occupiers Category',
                'label_attributes' => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\HomeCategoryType',
                // 'empty_option' => '-- Select a Proposed Insurer --',
                'property' => 'type'
                
            ),
            'attributes' => array(
                'id' => 'occupierCategory',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            'name' => 'buildingWallType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Building Wall Type',
                'label_attributes' => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\BuildingWallType',
                // 'empty_option' => '-- Select a Proposed Insurer --',
                'property' => 'wallType'
                
            ),
            'attributes' => array(
                'id' => 'buildingWallType',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            'name' => 'buildingFloorType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Building Floor Type',
                'label_attributes' => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\BuildingFloorType',
                // 'empty_option' => '-- Select a Proposed Insurer --',
                'property' => 'floorType'
                
            ),
            'attributes' => array(
                'id' => 'buildingFloorType',
                'class' => 'form-control'
            )
        ));
        
//         $this->add(array(
//             'name' => 'buildingFloorType',
//             'type' => 'DoctrineModule\Form\Element\ObjectSelect',
//             'options' => array(
//                 'label' => 'Building Floor Type',
//                 'label_attributes' => array(
//                     'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
//                 ),
//                 'object_manager' => $this->entityManager,
//                 'target_class' => 'Settings\Entity\BuildingFloorType',
//                 // 'empty_option' => '-- Select a Proposed Insurer --',
//                 'property' => 'floorType'
                
//             ),
//             'attributes' => array(
//                 'id' => 'buildingFloorType',
//                 'class' => 'form-control'
//             )
//         ));
        
        $this->add(array(
            "name"=>"otherOcuppierCategry",
            "type"=>"text",
            "options"=>array(
                "label"=>"Other Occupier Category",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"otherOcuppierCategry",
                "class"=>"form-control col-md-7 col-xs-12",
               
            )
        ));
        
        $this->add(array(
            "name"=>"buildingLocation",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Building Location",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"buildingLocation",
                "class"=>"form-control col-md-7 col-xs-12",
                
            )
        ));
        
        $this->add(array(
            "name"=>"buildingValue",
            "type"=>"text",
            "options"=>array(
                "label"=>"Building Value",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"buildingValue",
                "class"=>"form-control col-md-7 col-xs-12",
                
            )
        ));
        
        
        $this->add(array(
            "name" => "isOtherFinancialInterest",
            "type" => "checkbox",
            "options" => array(
                "label" => "Other Financial Body has Interest",
                'unchecked_value' => false,
                'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => " col-md-7 col-xs-12",
                "id" => "isOtherFinancialInterest",
                "checked" => false
            )
        ));
        
        $this->add(array(
            "name" => "isPersonalPropertyCoverage",
            "type" => "checkbox",
            "options" => array(
                "label" => "Cover For Personal Property",
                'unchecked_value' => false,
                'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => " col-md-7 col-xs-12",
                "id" => "isPersonalPropertyCoverage",
                "checked" => false
            )
        ));
        
        $this->add(array(
            "name" => "isSoundState",
            "type" => "checkbox",
            "options" => array(
                "label" => "Building in Good State",
                'unchecked_value' => false,
                'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => " col-md-7 col-xs-12",
                "id" => "isSoundState",
                "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "isLeftFor30Days",
            "type" => "checkbox",
            "options" => array(
                "label" => "Empty For 30",
                'unchecked_value' => false,
                'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => " col-md-7 col-xs-12",
                "id" => "isLeftFor30Days",
                "checked" => false
            )
        ));
        
        $this->add(array(
            "name" => "isTenant",
            "type" => "checkbox",
            "options" => array(
                "label" => "Building has Tenant",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => " col-md-7 col-xs-12",
                "id" => "isTenant",
                "checked" => false
            )
        ));
        
        $this->add(array(
            "name" => "isUsedForTrade",
            "type" => "checkbox",
            "options" => array(
                "label" => "Buiding is Used For Trade",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isUsedForTrade",
                "checked" => false
            )
        ));
        
        $this->add(array(
            "name" => "isPreviousInsured",
            "type" => "checkbox",
            "options" => array(
                "label" => "Previously Insured",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isPreviousInsured",
                "checked" => false
            )
        ));
        
        
        
        $this->add(array(
            "name" => "isPreviousDecline",
            "type" => "checkbox",
            "options" => array(
                "label" => "Previously Declined",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isPreviousDecline",
                "checked" => false
            )
        ));
        
        
        $this->add(array(
            "name" => "isValuables",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Valuables",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isValuables",
                "checked" => false
            )
        ));
        
        $this->add(array(
            "name" => "declineReason",
            "type" => "text",
            "options" => array(
                "label" => "Declined Reason",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "declineReason",
                "checked" => false
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
            "declineReason"=>array(
                "required"=>false,
                "allow_empty"=>true,
            ),
            "isValuables"=>array(
                "required"=>false,
                "allow_empty"=>true,
            ),
            "isPreviousDecline"=>array(
                "required"=>false,
                "allow_empty"=>true,
            ),
            "isPreviousInsured"=>array(
                "required"=>false,
                "allow_empty"=>true,
            ),
            "isUsedForTrade"=>array(
                "required"=>false,
                "allow_empty"=>true,
            ),
            "isTenant"=>array(
                "required"=>false,
                "allow_empty"=>true,
            ),
            "isLeftFor30Days"=>array(
                "required"=>false,
                "allow_empty"=>true,
            ),
            "isSoundState"=>array(
                "required"=>false,
                "allow_empty"=>true,
            ),
            "occupierCategory"=>array(
                "required"=>false,
                "allow_empty"=>true,
            ),
            
            
            "isPersonalPropertyCoverage"=>array(
                "required"=>false,
                "allow_empty"=>true,
            ),
            
            "isOtherFinancialInterest"=>array(
                "required"=>false,
                "allow_empty"=>true,
            ),
            "buildingValue"=>array(
                "required"=>false,
                "allow_empty"=>true,
            ),
            
            
            "otherOcuppierCategry"=>array(
                "required"=>false,
                "allow_empty"=>true,
            ),
            
            "buildingFloorType"=>array(
                "required"=>false,
                "allow_empty"=>true,
            ),
            "buildingWallType"=>array(
                "required"=>false,
                "allow_empty"=>true,
            ),
            "insuredSum"=>array(
                "required"=>false,
                "allow_empty"=>true,
            ),
          
            
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

