<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\CashInSafe;

/**
 *
 * @author otaba
 *        
 */
class CashInSafeFieldset extends Fieldset implements InputFilterProviderInterface
{
    private $entityManager;

    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new CashInSafe())->setHydrator($hydrator);
        $this->addField();
    }
    
    private function addField(){
        $this->add(array(
            'name' => 'currency',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Currency',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Currency',
                // 'empty_option' => '-- Select a Proposed Insurer --',
                'property' => 'title'
                
            ),
            'attributes' => array(
                'id' => 'currency',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            "name" => "maxInsuredAmount",
            "type" => "text",
            "options" => array(
                "label" => "Maximum Insured Value",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "maxInsuredAmount",
                "class" => "form-control col-md-7 col-xs-12",
                "placeholder"=>"200,000"
            )
        ));
        
        
        $this->add(array(
            "name" => "safeNature",
            "type" => "text",
            "options" => array(
                "label" => "Nature Of Safe",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "safeNature",
                "class" => "form-control col-md-7 col-xs-12",
                "placeholder"=>"Motorlla Platimum Doubl sealed Vault"
            )
        ));
        
        $this->add(array(
            "name" => "safeLocation",
            "type" => "text",
            "options" => array(
                "label" => "Location Of Safe",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "safeLocation",
                "class" => "form-control col-md-7 col-xs-12",
                "placeholder"=>"GM Office"
            )
        ));
        
        $this->add(array(
            "name" => "securityArrangements",
            "type" => "textarea",
            "options" => array(
                "label" => "Additional Security",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "securityArrangements",
                "class" => "form-control col-md-7 col-xs-12",
                "placeholder"=>"Metal Detector, Metal Detector"
            )
        ));
        
        $this->add(array(
            "name" => "isEmployeeHasFidelityGuaratee",
            "type" => "checkbox",
            "options" => array(
                "label" => "Employee has Fidelity Gauratee",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isEmployeeHasFidelityGuaratee",
                //                 "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "isPreviousInsured",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Previous Insurer",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isPreviousInsured",
                //                 "checked" => true
            )
        ));
        
        $this->add(array(
            'name' => 'previousInsurer',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Previous Insurer',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                // 'empty_option' => 'Unsaved',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Insurer',
                'property' => 'insuranceName',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findActiveInsurer'
                    
                )
            ),
            'attributes' => array(
                'id' => 'previousInsurer',
                'class' => 'form-control col-md-7 col-xs-12'
                // 'disabled' => 'disabled',
                // 'placeholder' => 'Unsaved'
            )
        ));
        
        $this->add(array(
            "name" => "leftPreviousInsurerReason",
            "type" => "textarea",
            "options" => array(
                "label" => "Reason For Leaving",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "leftPreviousInsurerReason",
                "class" => "form-control col-md-7 col-xs-12",
                "placeholder"=>"Not satisfied with service"
            )
        ));
        
        
        $this->add(array(
            "name" => "isPreviousloss",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Previous Loss",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isPreviousloss",
                //                 "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "measureTakenAfterLoss",
            "type" => "textarea",
            "options" => array(
                "label" => "Precautions Taken",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "measureTakenAfterLoss",
                "class" => "form-control col-md-7 col-xs-12",
                "placeholder"=>"Created a therapy session for staffs"
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
        
        return array();
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
    
}

