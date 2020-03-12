<?php
namespace Claims\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Claims\Entity\ClaimsEmployersLiability;

class ClaimsEmployerLiabilityFieldset extends Fieldset implements InputFilterProviderInterface
{
    private $entityManager;

    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new ClaimsEmployersLiability());
        
        $this->add(array(
            "name"=>"injuredName",
            "type"=>"text",
            "options"=>array(
                "label"=>"Injured Person Name",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "id"=>"injuredName",
            ),
        ));
        
        $this->add(array(
            "name"=>"injuredAge",
            "type"=>"text",
            "options"=>array(
                "label"=>"Injured Person Age",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "id"=>"injuredAge",
            ),
        ));
        
        $this->add(array(
            "name"=>"injuredAddress",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Injured Person Address",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "id"=>"injuredAddress",
            ),
        ));
        
        
        $this->add(array(
            "name"=>"isInjuredDirectEmploy",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Injured Person is a direct employ",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            
            "attributes"=>array(
                "class"=>"col-md-7 col-sm-7 col-xs-12",
                "id"=>"isInjuredDirectEmploy",
            ),
        ));
        
        $this->add(array(
            "name"=>"injuredPeriodInService",
            "type"=>"text",
            "options"=>array(
                "label"=>"How long in service",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "id"=>"injuredPeriodInService",
            ),
        ));
        
        
        $this->add(array(
            "name"=>"accidentDate",
            "type"=>"date",
            "options"=>array(
                "label"=>"Date of Accident",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "id"=>"accidentDate",
            ),
        ));
        
        
        $this->add(array(
            "name"=>"accidentDesc",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Description of Accident",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "id"=>"accidentDesc",
            ),
        ));
        
        $this->add(array(
            "name"=>"whomAccidentWasReported",
            "type"=>"text",
            "options"=>array(
                "label"=>"Whom was accident reported to",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "id"=>"whomAccidentWasReported",
            ),
        ));
        
        $this->add(array(
            "name"=>"accidentWitness",
            "type"=>"text",
            "options"=>array(
                "label"=>"Witness of accident",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "id"=>"accidentWitness",
            ),
        ));
        
        $this->add(array(
            "name"=>"isConnectedToMachinery",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Is Accident connected to a machinery",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            
            "attributes"=>array(
                "class"=>"col-md-7 col-sm-7 col-xs-12",
                "id"=>"isConnectedToMachinery",
            ),
        ));
        
        
        $this->add(array(
            "name"=>"machineryName",
            "type"=>"text",
            "options"=>array(
                "label"=>"Involved machinery",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "id"=>"machineryName",
            ),
        ));
        
        $this->add(array(
            "name"=>"isInjuryResultToDeath",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Injury resulted to death",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            
            "attributes"=>array(
                "class"=>"col-md-7 col-sm-7 col-xs-12",
                "id"=>"isInjuryResultToDeath",
            ),
        ));
        
        
        
        $this->add(array(
            "name"=>"isInjuredIntoxicated",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Injured was intoxicated",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            
            "attributes"=>array(
                "class"=>"col-md-7 col-sm-7 col-xs-12",
                "id"=>"isInjuredIntoxicated",
            ),
        ));
        
        
        
        $this->add(array(
            "name"=>"intoxicationDetails",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Intoxication Details",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "id"=>"intoxicationDetails",
            ),
        ));
        
        
        $this->add(array(
            "name"=>"isDueToNegelence",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Accident is due to neglegence",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            
            "attributes"=>array(
                "class"=>"col-md-7 col-sm-7 col-xs-12",
                "id"=>"isDueToNegelence",
            ),
        ));
        
        
        $this->add(array(
            "name"=>"neglegenceDetails",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Neglegence Details",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "id"=>"neglegenceDetails",
            ),
        ));
        
        $this->add(array(
            "name"=>"disablementPeriod",
            "type"=>"text",
            "options"=>array(
                "label"=>"Estimeted period injured might be disabled",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "id"=>"disablementPeriod",
            ),
        ));
        
        $this->add(array(
            'name' => 'claims',
            'type' => 'Claims\Form\Fieldset\ClaimsFieldset'
        ));
        
    }

    public function getInputFilterSpecification()
    {

        return array(
            "disablementPeriod"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "neglegenceDetails"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isDueToNegelence"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "intoxicationDetails"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isInjuredIntoxicated"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isInjuryResultToDeath"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isConnectedToMachinery"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "machineryName"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isConnectedToMachinery"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "accidentWitness"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "whomAccidentWasReported"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "accidentDesc"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            
            "accidentDate"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            
            "injuredPeriodInService"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            
            "isInjuredDirectEmploy"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            
            "injuredAddress"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            
            "injuredAge"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            
            "injuredName"=>array(
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

