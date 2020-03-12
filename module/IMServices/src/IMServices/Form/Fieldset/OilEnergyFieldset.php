<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\OilEnergyInsurance;

/**
 *
 * @author otaba
 *        
 */
class OilEnergyFieldset extends Fieldset implements InputFilterProviderInterface
{
    private $entityManager;

    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new OilEnergyInsurance())->setHydrator($hydrator);
        $this->addFields();
    }
    
    private function addFields(){
        $this->add(array(
            'name' => 'nonOilRisk',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Non Oil Insurance',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'empty_option' => '--Select Cover Region -- ',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\OilEnergyNonOilRisk',
                'property' => 'risk'
            ),
            'attributes' => array(
                'id' => 'nonOilRisk',
                'class' => 'form-control col-md-7 col-xs-12',
                'multiple' => 'multiple'
                
            )
        ));
        
        $this->add(array(
            "name"=>"othersNonoilRisk",
            "type"=>"text",
            "options"=>array(
                "label"=>"Other Non Oil/Energy Risk",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-xs-12",
                "id"=>"othersNonoilRisk",
                "placeholder"=>"if applicable"
            ),
        ));
        
        $this->add(array(
            "name"=>"lossDetails",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Other Non Oil/Energy Risk",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-xs-12",
                "id"=>"lossDetails",
                "placeholder"=>"if applicable"
            ),
        ));
        
        $this->add(array(
            'name' => 'oilRisk',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Non Oil Insurance',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'empty_option' => '--Select Cover Region -- ',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\OilEnergyOilRisk',
                'property' => 'risk'
            ),
            'attributes' => array(
                'id' => 'oilRisk',
                'class' => 'form-control col-md-7 col-xs-12',
                'multiple' => 'multiple'
                
            )
        ));
        
        $this->add(array(
            "name"=>"otherOilRisk",
            "type"=>"text",
            "options"=>array(
                "label"=>"Other Oil/Energy Risk",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-xs-12",
                "id"=>"othersNonoilRisk",
                "placeholder"=>"if applicable"
            ),
        ));
        //
        
        $this->add(array(
            "name"=>"noOfEmployees",
            "type"=>"text",
            "options"=>array(
                "label"=>"Number Of Employees",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-xs-12",
                "id"=>"noOfEmployees",
                "placeholder"=>"if applicable"
            ),
        ));
        
        $this->add(array(
            "name"=>"isPreviouslyInsured",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Was Previously Insured",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-5 col-sm-5 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"col-md-5 col-xs-12",
                "id"=>"isPreviouslyInsured",
//                 "placeholder"=>"2"

            ),
        ));
        
        $this->add(array(
            "name"=>"isPreviousClaims",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Has Previous Claims",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-5 col-sm-5 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"col-md-5 col-xs-12",
                "id"=>"isPreviousClaims",
                //                 "placeholder"=>"2"
                
            ),
        ));
        
        
        $this->add(array(
            "name"=>"isPreviousDecline",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Previously Declined by Insurer",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-5 col-sm-5 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>" col-md-5 col-xs-12",
                "id"=>"isPreviousDecline",
                //                 "placeholder"=>"2"
                
            ),
        ));
        
        //declineReason
        
        $this->add(array(
            "name"=>"declineReason",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Decline Reason",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-xs-12",
                "id"=>"declineReason",
                //                 "placeholder"=>"2"
                
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
            "isPreviousDecline"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isPreviousClaims"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isPreviouslyInsured"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "noOfEmployees"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "otherOilRisk"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "oilRisk"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "othersNonoilRisk"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "nonOilRisk"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "declineReason"=>array(
                "allow_empty"=>true,
                "required"=>false
            )
            
        );
        
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

