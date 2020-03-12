<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\OccupiersLiability;

/**
 *
 * @author otaba
 *        
 */
class OccupiersLiabilityFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new OccupiersLiability());
        $this->addField();
    }

    private function addField()
    {
        $this->add(array(
            "name" => "occupiersName",
            "type" => "text",
            "options" => array(
                "label" => "Occupiers Name",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "occupiersName",
                "class" => "form-control col-md-7 col-xs-12",
                "placeholder" => "Seun Hamzat"
            )
        ));
        
        $this->add(array(
            "name" => "coverStartDate",
            "type" => "date",
            "options" => array(
                "label" => "Cover Start Date",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "coverStartDate",
//                 "min" => date(),
                "class" => "form-control col-md-7 col-xs-12"
                // "placeholder"=>"Seun Hamzat"
            )
        ));
        
        $this->add(array(
            "name" => "coverEndDate",
            "type" => "date",
            "options" => array(
                "label" => "Cover End Date",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "coverEndDate",
                "class" => "form-control col-md-7 col-xs-12"
                // "placeholder"=>"Seun Hamzat"
            )
        ));
        
        $this->add(array(
            "name" => "residenceDesription",
            "type" => "textarea",
            "options" => array(
                "label" => "Describe what residence is used for:",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "residenceDesription",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "badCondition",
            "type" => "text",
            "options" => array(
                "label" => "List the bad conditions",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "badCondition",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "isGoodState",
            "type" => "checkbox",
            "options" => array(
                "label" => "Building is in Good State",
                'unchecked_value' => false,
                'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isGoodState",
                "checked" => true
            )
        ));
        
        
        
        $this->add(array(
            "name" => "isSubjectToFlooding",
            "type" => "checkbox",
            "options" => array(
                "label" => "Building is Subject to Flood",
                'unchecked_value' => false,
                'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isSubjectToFlooding",
                "checked" => false
            )
        ));
        
        $this->add(array(
            "name" => "distanceFromGround",
            "type" => "text",
            "options" => array(
                "label" => "Distance from Ground",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "distanceFromGround",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "isExposedToFireStormOrQuake",
            "type" => "checkbox",
            "options" => array(
                "label" => "Is Exposed to Fire, Storm, Quake",
                'unchecked_value' => false,
                'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isExposedToFireStormOrQuake",
                "checked" => false
            )
        ));
        
        //lossType
        
        $this->add(array(
            "name" => "lossType",
            "type" => "text",
            "options" => array(
                "label" => "Loss Type",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "lossType",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "isPreviousLoss",
            "type" => "checkbox",
            "options" => array(
                "label" => "Had Previous Loss",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isPreviousLoss",
                "checked" => false
            )
        ));
        
        
        // previousLoss
        
        $this->add(array(
            "name" => "previousLoss",
            "type" => "text",
            "options" => array(
                "label" => "Previous Loss Details",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "previousLoss",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "isUnoccupied",
            "type" => "checkbox",
            "options" => array(
                "label" => "Would Building be unoccupied",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isUnoccupied",
                "checked" => false
            )
        ));
        
        //unOccupiedPeriod
        
        $this->add(array(
            "name" => "unOccupiedPeriod",
            "type" => "text",
            "options" => array(
                "label" => "How Long",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "unOccupiedPeriod",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "isPreviousDeclined",
            "type" => "checkbox",
            "options" => array(
                "label" => "Cover is Previously Declined",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isPreviousDeclined",
                "checked" => false
            )
        ));
        
        $this->add(array(
            "name" => "declineDetails",
            "type" => "textarea",
            "options" => array(
                "label" => "Decline Reasons",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "declineDetails",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        
        
        $this->add(array(
            "name" => "isForRent",
            "type" => "checkbox",
            "options" => array(
                "label" => "Building Has Paying tenant",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isForRent",
                "checked" => false
            )
        ));
        
        //countPayingGuest
        
        $this->add(array(
            "name" => "countPayingGuest",
            "type" => "text",
            "options" => array(
                "label" => "How Many Paying Tenant",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "countPayingGuest",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            'name' => 'buildingType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Building Type',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\BuildingType',
                // 'empty_option' => '-- Select a Proposed Insurer --',
                'property' => 'type'
                
            ),
            'attributes' => array(
                'id' => 'buildingType',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            'name' => 'nonResidetialType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Non Residential Type',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\NonResidentialType',
                // 'empty_option' => '-- Select a Proposed Insurer --',
                'property' => 'type'
                
            ),
            'attributes' => array(
                'id' => 'nonResidetialType',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            "name" => "isDomesticStaff",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Domestic Staff",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isDomesticStaff",
                "checked" => false
            )
        ));
        
        // Define Collection Here
        
        //isDaySecurity
        
        $this->add(array(
            "name" => "isDaySecurity",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has a Day Security",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isDaySecurity",
                "checked" => false
            )
        ));
        
        
        $this->add(array(
            "name" => "isTradeWithinBuilding",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Trade Within Building",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isTradeWithinBuilding",
                "checked" => false
            )
        ));
        
        $this->add(array(
            "name" => "isTradeAroundBuilding",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Trade Around Building",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isTradeAroundBuilding",
                "checked" => false
            )
        ));
        
        // Collection 
        
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
            "isTradeAroundBuilding"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "isTradeWithinBuilding"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "isDaySecurity"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "isDomesticStaff"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "nonResidetialType"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "buildingType"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "countPayingGuest"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "isForRent"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "declineDetails"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "isPreviousDeclined"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "unOccupiedPeriod"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "isUnoccupied"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "previousLoss"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "isPreviousLoss"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "lossType"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "occupiersName"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "coverStartDate"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "coverEndDate"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "badCondition"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "isGoodState"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "isSubjectToFlooding"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "isExposedToFireStormOrQuake"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

