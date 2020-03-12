<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\ContractAllRisk;

/**
 *
 * @author otaba
 *        
 */
class ContractALlRiskFieldset extends Fieldset implements InputFilterProviderInterface
{
    private $entityManager;

    public function init(){
        
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new ContractAllRisk())->setHydrator($hydrator);
        
        $this->addField();
        
    }
    
    private function addField(){
        $this->add(array(
            "name"=>"contractName",
            "type"=>"text",
            "options"=>array(
                "label"=>"Contract Title",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"contractName",
                "class"=>"form-control col-md-7 col-xs-12",
//                 "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name"=>"contractAddress",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Contract Address",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"contractAddress",
                "class"=>"form-control col-md-7 col-xs-12",
//                 "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name"=>"supervisingEngineer",
            "type"=>"text",
            "options"=>array(
                "label"=>"Supervising Engineer",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"supervisingEngineer",
                "class"=>"form-control col-md-7 col-xs-12",
//                 "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name"=>"nearestAirport",
            "type"=>"text",
            "options"=>array(
                "label"=>"Nearest Airport",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"nearestAirport",
                "class"=>"form-control col-md-7 col-xs-12",
//                 "required"=>"required"
            )
        ));
        
        
        $this->add(array(
            "name"=>"nearestLandmark",
            "type"=>"text",
            "options"=>array(
                "label"=>"Nearest Landmark",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"nearestLandmark",
                "class"=>"form-control col-md-7 col-xs-12",
//                 "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name"=>"contractDescription",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Contract Description",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"contractDescription",
                "class"=>"form-control col-md-7 col-xs-12",
                "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name"=>"mainContractor",
            "type"=>"text",
            "options"=>array(
                "label"=>"Main Contractor",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"mainContractor",
                "class"=>"form-control col-md-7 col-xs-12",
                //                 "required"=>"required"
            )
        ));
        
      
      
        
        $this->add(array(
            "name"=>"consultingEngineer",
            "type"=>"text",
            "options"=>array(
                "label"=>"Consulting Engineer",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"consultingEngineer",
                "class"=>"form-control col-md-7 col-xs-12",
              //  "required"=>"required"
            )
        ));
        
        
        
       
        
        $this->add(array(
            "name"=>"contractStartDate",
            "type"=>"Zend\Form\Element\Date",
            "options"=>array(
                "label"=>"Contract Start Date",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"contractStartDate",
                "class"=>"form-control col-md-7 col-xs-12",
                 "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name"=>"contractEndDate",
            "type"=>"Zend\Form\Element\Date",
            "options"=>array(
                "label"=>"Contract End Date",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"contractEndDate",
                "class"=>"form-control col-md-7 col-xs-12",
                "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name" => "isTesting",
            "type" => "checkbox",
            "options" => array(
                "label" => "Project has a testing Period",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12 flat",
                "id" => "isTesting",
                'checked' => false
            )
        ));
        
        $this->add(array(
            "name"=>"testingStartDate",
            "type"=>"Zend\Form\Element\Date",
            "options"=>array(
                "label"=>"Testing Begins",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"testingStartDate",
                "class"=>"form-control col-md-7 col-xs-12",
                //"required"=>"required"
            )
        ));
        
        $this->add(array(
            "name"=>"testingEndDate",
            "type"=>"Zend\Form\Element\Date",
            "options"=>array(
                "label"=>"Testing Ends",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"testingEndDate",
                "class"=>"form-control col-md-7 col-xs-12",
                //"required"=>"required"
            )
        ));
        
        
        $this->add(array(
            "name" => "isMaintenance",
            "type" => "checkbox",
            "options" => array(
                "label" => "Project has a maintenance Period",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12 flat",
                "id" => "isMaintenance",
                'checked' => false
            )
        ));
        
        $this->add(array(
            "name"=>"maintenanceStartDate",
            "type"=>"Zend\Form\Element\Date",
            "options"=>array(
                "label"=>"Maintenance Begins",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"maintenanceStartDate",
                "class"=>"form-control col-md-7 col-xs-12",
                //"required"=>"required"
            )
        ));
        
        
        
        $this->add(array(
            "name"=>"maintenanceEndDate",
            "type"=>"Zend\Form\Element\Date",
            "options"=>array(
                "label"=>"maintenance Ends",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"maintenanceEndDate",
                "class"=>"form-control col-md-7 col-xs-12",
                //"required"=>"required"
            )
        ));
        
        $this->add(array(
            "name"=>"isSimilarConstruction",
            "type" => "checkbox",
            "options"=>array(
                "label"=>"Handled Similar Project",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"isSimilarConstruction",
                "class"=>" col-md-7 col-xs-12",
                //                 "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name" => "previousContructionName",
            "type" => "text",
            "options" => array(
                "label" => "Title of Similar Project",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "previousContructionName",
                'checked' => false
            )
        ));
        
        $this->add(array(
            "name" => "isExtension",
            "type" => "checkbox",
            "options" => array(
                "label" => "Is extension of previous project",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => " col-md-7 col-xs-12 flat",
                "id" => "isExtension",
                'checked' => false
            )
        ));
        
        // this an extension of previous projectDetails of
        $this->add(array(
            "name" => "existingPlant",
            "type" => "textarea",
            "options" => array(
                "label" => "Extended project details",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "existingPlant",
                'checked' => false
            )
        ));
        
        $this->add(array(
            "name" => "isCivilCompleted",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Completed Civil/Engineering",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12 flat",
                "id" => "isCivilCompleted",
                'checked' => true
            )
        ));
        
        $this->add(array(
            "name" => "civilWork",
            "type" => "textarea",
            "options" => array(
                "label" => "OutStanding Civil/Engineering",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "civilWork",
                'checked' => false
            )
        ));
        
        //isOtherRisk
        
        $this->add(array(
            "name"=>"isOtherRisk",
            "type" => "checkbox",
            "options"=>array(
                "label"=>"Other Risk",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"isOtherRisk",
                "class"=>"col-md-7 col-xs-12",
                "checked"=>false
                //                 "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name"=>"isAgravatedRisk",
            "type" => "checkbox",
            "options"=>array(
                "label"=>"Has Aggravated Risk",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"isAgravatedRisk",
                "class"=>"col-md-7 col-xs-12",
                "checked"=>false
                //                 "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name"=>"isAgravatedFire",
            "type" => "checkbox",
            "options"=>array(
                "label"=>"Has Aggravated Fire",
               
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"isAgravatedFire",
                "class"=>" col-md-7 col-xs-12",
                "checked"=>false
                //                 "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name"=>"isAgravatedExplosion",
            "type" => "checkbox",
            "options"=>array(
                "label"=>"Has Aggravated Explosion",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"isAgravatedExplosion",
                "class"=>" col-md-7 col-xs-12",
                "checked"=>false
                //                 "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name"=>"isEarthQuake",
            "type" => "checkbox",
            "options"=>array(
                "label"=>"Prone To Earthquake",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"isEarthQuake",
                "class"=>"col-md-7 col-xs-12",
                "checked"=>false
                //                 "required"=>"required"
            )
        ));
        
        $this->add(array(
            'name' => 'soilCondition',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Soil Condition',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'empty_option' => '-- if applicable --',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\SoilCondition',
                'property' => 'condition'
            ),
            'attributes' => array(
                'id' => 'soilCondition',
                'class' => 'form-control col-md-7 col-xs-12',
                // 'disabled' => 'disabled',
                //'placeholder' => 'Unsaved'
            )
        ));
        
        $this->add(array(
            "name"=>"otherSoil",
            "type"=>"text",
            "options"=>array(
                'label' => 'Other Soil',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
            ),
            "attributes"=>array(
                'id' => 'otherSoil',
                'class' => 'form-control col-md-7 col-xs-12',
            ),
        ));
        
        $this->add(array(
            "name"=>"isGeologicalFault",
            "type" => "checkbox",
            "options"=>array(
                "label"=>"Geological Faults",
                
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"isGeologicalFault",
                "class"=>"form-control col-md-7 col-xs-12",
                "checked"=>true
                //                 "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name"=>"geologicalFault",
            "type"=>"textarea",
            "options"=>array(
                'label' => 'State Geological Faults',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
            ),
            "attributes"=>array(
                'id' => 'geologicalFault',
                'class' => 'form-control col-md-7 col-xs-12',
            ),
        ));
        
        $this->add(array(
            "name" => "possibleFireLoss",
            "type" => "text",
            "options" => array(
                "label" => "Value Fire Loss value(max)",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-8 col-xs-12",
                "id" => "possibleFireLoss",
               
            )
        ));
        
        $this->add(array(
            "name" => "possibleQuakeLoss",
            "type" => "text",
            "options" => array(
                "label" => "Possible Quake Loss value(max)",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-8 col-xs-12",
                "id" => "possibleQuakeLoss",
               
            )
        ));
        
        $this->add(array(
            "name" => "possibleOtherLoss",
            "type" => "text",
            "options" => array(
                "label" => "Possible Other Loss value(max)",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-8 col-xs-12",
                "id" => "possibleOtherLoss",
               
            )
        ));
        
        $this->add(array(
            "name" => "isScafolding",
            "type" => "checkbox",
            "options" => array(
                "label" => "Cover for Scafolding",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "flat",
                "id" => "isScafolding",
                'checked' => false
            )
        ));
        
        $this->add(array(
            "name" => "isExcavatorNMachine",
            "type" => "checkbox",
            "options" => array(
                "label" => "Cover for Machines",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "flat",
                "id" => "isExcavatorNMachine",
                'checked' => false
            )
        ));
        
        $this->add(array(
            "name" => "isThirdLiability",
            "type" => "checkbox",
            "options" => array(
                "label" => "Third Party Liability",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "flat",
                "id" => "isThirdLiability",
                'checked' => false
            )
        ));
        
//        
        
        $this->add(array(
            "name" => "isAdjacentBuilding",
            "type" => "checkbox",
            "options" => array(
                "label" => "Available Adjacent Building",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "flat",
                "id" => "isAdjacentBuilding",
                'checked' => false
            )
        ));
        
        $this->add(array(
            "name" => "isSpecialExtension",
            "type" => "checkbox",
            "options" => array(
                "label" => "Special Extension",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "flat",
                "id" => "isSpecialExtension",
                'checked' => false
            )
        ));
        
        $this->add(array(
            "name" => "contract_value",
            "type" => "text",
            "options" => array(
                "label" => "Contract Value",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-sm-7 col-md-7 col-xs-12",
                "id" => "constract_value",
                "placeholder"=>"0.00"
//                 'checked' => false
            )
        ));
        
        $this->add(array(
            'name' => 'currency',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Value Currency',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                // 'empty_option' => 'Unsaved',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Currency',
                'property' => 'title'
            ),
            'attributes' => array(
                'id' => 'currency',
                'class' => 'form-control col-md-7 col-xs-12',
                // 'disabled' => 'disabled',
                'placeholder' => 'Unsaved'
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
            "currency"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "value"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "isSpecialExtension"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "isAdjacentBuilding"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "isThirdLiability"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "isExcavatorNMachine"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "isScafolding"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "possibleOtherLoss"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "possibleQuakeLoss"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "possibleFireLoss"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "geologicalFault"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "isGeologicalFault"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "otherSoil"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "soilCondition"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "isEarthQuake"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "isAgravatedExplosion"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "isAgravatedFire"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "isAgravatedRisk"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "isOtherRisk"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "civilWork"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "isCivilCompleted"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "existingPlant"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "contractName"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "contractAddress"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "supervisingEngineer"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "nearestAirport"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "nearestLandmark"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "contractDescription"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "mainContractor"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "consultingEngineer"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "contractStartDate"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "isTesting"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "testingStartDate"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "testingEndDate"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "isMaintenance"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "maintenanceStartDate"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            
            "maintenanceEndDate"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "isSimilarConstruction"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "previousContructionName"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            "isExtension"=>array(
                "required"=>FALSE,
                "allow_empty"=>TRUE
            ),
            
        );
    }
    
    public function setEntityManager($em){
        $this->entityManager  = $em;
        return $this;
    }
}

