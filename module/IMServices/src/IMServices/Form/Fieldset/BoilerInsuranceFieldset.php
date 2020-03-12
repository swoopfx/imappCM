<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\BoilersInsurance;

/**
 *
 * @author otaba
 *        
 */
class BoilerInsuranceFieldset extends Fieldset implements InputFilterProviderInterface
{
    private $entityManager;

    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new BoilersInsurance());
        $this->addFields();
    }
    
    private function addFields(){
        $this->add(array(
            "name"=>"chiefEngineer",
            "type"=>"text",
            "options"=>array(
                "label"=>"Cheif Engineer/Plant Manager",
                "label_attributes"=>array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"chiefEngineer",
                "class"=>"form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name"=>"accidentMeasures",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Measures Taken",
                "label_attributes"=>array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"accidentMeasures",
                "class"=>"form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name"=>"startDate",
            "type"=>"date",
            "options"=>array(
                "label"=>"Cover Start Date",
                "label_attributes"=>array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"startDate",
                "class"=>"form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name"=>"endDate",
            "type"=>"date",
            "options"=>array(
                "label"=>"Cover End Date",
                "label_attributes"=>array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"endDate",
                "class"=>"form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name"=>"natureOfBusiness",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Nature Of Business",
                "label_attributes"=>array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"natureOfBusiness",
                "class"=>"form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name"=>"isPreviouslyInsured",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Was Previously Insured",
                "label_attributes"=>array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"isPreviouslyInsured",
                "class"=>"col-md-7 col-xs-12",
                "checked"=>false
            )
        ));
        
        $this->add(array(
            "name"=>"isPreviousAccident",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Had previous accident",
                "label_attributes"=>array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"isPreviousAccident",
                "class"=>" col-md-7 col-xs-12",
                "checked"=>false
            )
        ));
        
        $this->add(array(
            "name"=>"isIncludeSteam",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Include Cover for Steam water piping",
                "label_attributes"=>array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"isIncludeSteam",
                "class"=>" col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name"=>"isCoverAll",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Provide Full Cover",
                "label_attributes"=>array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"isCoverAll",
                "class"=>" col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name"=>"excludedPart",
            "type"=>"text",
            "options"=>array(
                "label"=>"Exclude Some Part",
                "label_attributes"=>array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"excludedPart",
                "class"=>"form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name"=>"isGoodCondition",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Device in Good Condition",
                "label_attributes"=>array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"isGoodCondition",
                "class"=>"col-md-7 col-xs-12",
                "checked"=>true
            )
        ));
        
        $this->add(array(
            "name"=>"defectPart",
            "type"=>"text",
            "options"=>array(
                "label"=>"Defective Part",
                "label_attributes"=>array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"defectPart",
                "class"=>"form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name"=>"partPeriodicallyinspected",
            "type"=>"text",
            "options"=>array(
                "label"=>"Part Periodically Inspected",
                "label_attributes"=>array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"partPeriodicallyinspected",
                "class"=>"form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name"=>"inspectionBy",
            "type"=>"text",
            "options"=>array(
                "label"=>"Inspection Made By",
                "label_attributes"=>array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"inspectionBy",
                "class"=>"form-control col-md-7 col-xs-12",
                "placeholder"=>"Kontz Technical Service"
            )
        ));
        
        $this->add(array(
            "name"=>"lastInspectionDate",
            "type"=>"date",
            "options"=>array(
                "label"=>"Last InspectionDate",
                "label_attributes"=>array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"lastInspectionDate",
                "class"=>"form-control col-md-7 col-xs-12",
                "placeholder"=>"Kontz Technical Service"
            )
        ));
        
        $this->add(array(
            "name"=>"maxSafetyLoadLevel",
            "type"=>"text",
            "options"=>array(
                "label"=>"Maximum Safety Load",
                "label_attributes"=>array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"maxSafetyLoadLevel",
                "class"=>"form-control col-md-7 col-xs-12",
//                 "placeholder"=>"Kontz Technical Service"
            )
        ));
        
        $this->add(array(
            "name"=>"workingPressure",
            "type"=>"text",
            "options"=>array(
                "label"=>"Working Pressure",
                "label_attributes"=>array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"workingPressure",
                "class"=>"form-control col-md-7 col-xs-12",
                //                 "placeholder"=>"Kontz Technical Service"
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
            "workingPressure"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "maxSafetyLoadLevel"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "accidentMeasures"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "lastInspectionDate"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "inspectionBy"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "partPeriodicallyinspected"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "defectPart"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isGoodCondition"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isCoverAll"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isIncludeSteam"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isPreviousAccident"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            
            "isPreviouslyInsured"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            
            "endDate"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            
            "startDate"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
        );
        
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

