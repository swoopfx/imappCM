<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

/**
 *
 * @author otaba
 *        
 */
class GroupPersonalAccidentFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;
    

    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new GroupPersonalAccidentFieldset())->setHydrator($hydrator);
        
        $this->add(array(
            'name' => 'personalAccidentType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Group Personal Accident Type',
                'label_attributes' => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\GroupPersonalAccidentType',
                'empty_option' => '-- Select a a Type --',
                'property' => 'type'
                
            ),
            'attributes' => array(
                'id' => 'personalAccidentType',
                'class' => 'form-control',
                "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name"=>"isIncludeEmoluments",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Include Emolument",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"isIncludeEmoluments",
                "class"=>"col-md-6"
            ),
        ));
        
        $this->add(array(
            "name"=>"emoluments",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Emolument",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"emoluments",
                "class"=>"form-control"
            ),
        ));
        
        
        $this->add(array(
            "name"=>"highestEmolumentPaid",
            "type"=>"text",
            "options"=>array(
                "label"=>"Highest Emolument to be Paid",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"highestEmolumentPaid",
                "class"=>"form-control"
            ),
        ));
        
        $this->add(array(
            "name"=>"isRestrictedToEmployeeAccident",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Restrict Cover to Employee Accidents only",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"isRestrictedToEmployeeAccident",
                "class"=>"col-md-6"
            ),
        ));
        
        $this->add(array(
            "name"=>"restriction",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Restriction Details/Condition",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"restriction",
                "class"=>"form-control"
            ),
        ));
        
        $this->add(array(
            "name"=>"isPersonsInSoundHealth",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>" Attest persons are in sound health",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"isPersonsInSoundHealth",
                "class"=>"col-md-6"
            ),
        ));
        
        $this->add(array(
            "name"=>"isTravel",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Persons should be covered for Travel accident",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"isTravel",
                "class"=>"col-md-6"
            ),
        ));
        
        $this->add(array(
            "name"=>"travelDetails",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Details of Travel",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"travelDetails",
                "class"=>"form-control"
            ),
        ));
        
        
        $this->add(array(
            "name"=>"isUseMachinery",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Covered for machine use",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"isUseMachinery",
                "class"=>"col-md-6"
            ),
        ));
        
        
        $this->add(array(
            "name"=>"machineDetails",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Details of machine cover",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"machineDetails",
                "class"=>"form-control"
            ),
        ));
        
        
        
        $this->add(array(
            "name"=>"isOtherExtension",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Include other extended cover",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"isOtherExtension",
                "class"=>"col-md-6"
            ),
        ));
        
        
        
        $this->add(array(
            "name"=>"extensionDetails",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Other cover details",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"extensionDetails",
                "class"=>"form-control"
            ),
        ));
        
        
        $this->add(array(
            "name"=>"isPreviousGroupAccident",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Previously Covered by another insurer",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"isPreviousGroupAccident",
                "class"=>"col-md-6"
            ),
        ));
        
      
        
        
        
        $this->add(array(
            "name"=>"isDeclined",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Declined by previous insurer",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"isDeclined",
                "class"=>"col-md-6"
            ),
        ));
        
        
        
        $this->add(array(
            "name"=>"declineDetails",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Decline Reason",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"declineDetails",
                "class"=>"form-control col-md-6"
            ),
        ));
        
        
        
        $this->add(array(
            "name"=>"isTerminated",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Terminated by previous insurer",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"isTerminated",
                "class"=>"col-md-6"
            ),
        ));
        
        
        $this->add(array(
            "name"=>"terminatedDetails",
            "type"=>"text",
            "options"=>array(
                "label"=>"Termination Reason",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"terminatedDetails",
                "class"=>"form-control"
            ),
        ));
        
        
        $this->add(array(
            "name"=>"isSpecialCondition",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Previous Insurer had Special Condition",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"isSpecialCondition",
                "class"=>"col-md-6"
            ),
        ));
        
        
        $this->add(array(
            "name"=>"conditionDetails",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Special Condition Details",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"conditionDetails",
                "class"=>"form-control"
            ),
        ));
        
        $this->add(array(
            "name"=>"addtionalFacts",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Additional Facts",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"addtionalFacts",
                "class"=>"form-control"
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
        
       return array(
           "addtionalFacts"=>array(
               "allow_empty"=>TRUE,
               "required"=>FALSE,
           ),
           "conditionDetails"=>array(
               "allow_empty"=>TRUE,
               "required"=>FALSE,
           ),
           "isSpecialCondition"=>array(
               "allow_empty"=>TRUE,
               "required"=>FALSE,
           ),
           "terminatedDetails"=>array(
               "allow_empty"=>TRUE,
               "required"=>FALSE,
           ),
           "isTerminated"=>array(
               "allow_empty"=>TRUE,
               "required"=>FALSE,
           ),
           "declineDetails"=>array(
               "allow_empty"=>TRUE,
               "required"=>FALSE,
           ),
           "isDeclined"=>array(
               "allow_empty"=>TRUE,
               "required"=>FALSE,
           ),
           "isPreviousGroupAccident"=>array(
               "allow_empty"=>TRUE,
               "required"=>FALSE,
           ),
           "extensionDetails"=>array(
               "allow_empty"=>TRUE,
               "required"=>FALSE,
           ),
           "isOtherExtension"=>array(
               "allow_empty"=>TRUE,
               "required"=>FALSE,
           ),
           "machineDetails"=>array(
               "allow_empty"=>TRUE,
               "required"=>FALSE,
           ),
           "isUseMachinery"=>array(
               "allow_empty"=>TRUE,
               "required"=>FALSE,
           ),
           "travelDetails"=>array(
               "allow_empty"=>TRUE,
               "required"=>FALSE,
           ),
           "isTravel"=>array(
               "allow_empty"=>TRUE,
               "required"=>FALSE,
           ),
           "isPersonsInSoundHealth"=>array(
               "allow_empty"=>TRUE,
               "required"=>FALSE,
           ),
           "restriction"=>array(
               "allow_empty"=>TRUE,
               "required"=>FALSE,
           ),
           "isRestrictedToEmployeeAccident"=>array(
               "allow_empty"=>TRUE,
               "required"=>FALSE,
           ),
           "highestEmolumentPaid"=>array(
               "allow_empty"=>TRUE,
               "required"=>FALSE,
           ),
           "emoluments"=>array(
               "allow_empty"=>TRUE,
               "required"=>FALSE,
           ),
           
           "isIncludeEmoluments"=>array(
               "allow_empty"=>TRUE,
               "required"=>FALSE,
           ),
           "personalAccidentType"=>array(
               "allow_empty"=>FALSE,
               "required"=>TRUE,
           ),
          
       );
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return  $this;
    }
}

