<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\CashInTransit;

/**
 *
 * @author otaba
 *        
 */
class CashInTransitFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new CashInTransit())->setHydrator($hydrator);
        $this->addFields();
    }

    private function addFields()
    {
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
            "name" => "singleCarryLimit",
            "type" => "text",
            "options" => array(
                "label" => "Single Carry Limit",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "singleCarryLimit",
                "class" => "form-control col-md-7 col-xs-12",
                "placeholder" => "20,000"
            )
        ));
        
        $this->add(array(
            "name" => "annualTurnover",
            "type" => "text",
            "options" => array(
                "label" => "Annual Turnover",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "annualTurnover",
                "class" => "form-control col-md-7 col-xs-12",
                "placeholder" => "20,000"
            )
        ));
        
        $this->add(array(
            "name" => "conveyMethod",
            "type" => "textarea",
            "options" => array(
                "label" => "Convey Method",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "conveyMethod",
                "class" => "form-control col-md-7 col-xs-12"
                // "placeholder"=>"2"
            )
        ));
        
        $this->add(array(
            "name" => "noOfConveyor",
            "type" => "number",
            "options" => array(
                "label" => "Number Of Conveyor",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "noOfConveyor",
                "class" => "form-control col-md-7 col-xs-12",
                "placeholder" => "2"
            )
        ));
        
        $this->add(array(
            "name" => "otherTransit",
            "type" => "textarea",
            "options" => array(
                "label" => "Other Conveyed Materials",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "otherTransit",
                "class" => "form-control col-md-7 col-xs-12",
                "placeholder" => "Bonds , Jewelry, revenue stamps"
            )
        ));
        
        // $this->add(array(
        // "name" => "otherTransit",
        // "type" => "textarea",
        // "options" => array(
        // "label" => "Other Conveyed Materials",
        // "label_attributes" => array(
        // "class" => "control-label col-md-3 col-sm-3 col-xs-12"
        // )
        // ),
        // "attributes" => array(
        // "id" => "otherTransit",
        // "class" => "form-control col-md-7 col-xs-12",
        // "placeholder"=>"Bonds , Jewelry, revenue stamps"
        // )
        // ));
        
        $this->add(array(
            "name" => "isEmployeeHasFidelityGuaratee",
            "type" => "checkbox",
            "options" => array(
                "label" => "Employee has Fidelity Gauratee",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isEmployeeHasFidelityGuaratee"
                // "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "frequencyOfTransit",
            "type" => "text",
            "options" => array(
                "label" => "Weekly Frequency",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "frequencyOfTransit",
                "class" => "form-control col-md-7 col-xs-12",
                "placeholder" => "2 times weekly"
            )
        ));
        
        $this->add(array(
            "name" => "dailyFrequency",
            "type" => "text",
            "options" => array(
                "label" => "Daily Frequency",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "dailyFrequency",
                "class" => "form-control col-md-7 col-xs-12",
                "placeholder" => "3 times daily"
            )
        ));
        
        //
        
        $this->add(array(
            "name" => "isArmedGaurd",
            "type" => "checkbox",
            "options" => array(
                "label" => "Transit has armed gaurds",
                // 'unchecked_value' => false,
                // 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isArmedGaurd",
                "checked" => true
            )
        ));
        
        $this->add(array(
            'name' => 'fidelityInsurer',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Proposed Insurer',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Insurer',
                'empty_option' => '-- Select the Insurer --',
                'property' => 'insuranceName',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findActiveInsurer'
                
                )
            ),
            'attributes' => array(
                'id' => 'fidelityInsurer',
                'class' => 'form-control'
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
            "fidelityInsurer"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isArmedGaurd"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "dailyFrequency"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "frequencyOfTransit"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isEmployeeHasFidelityGuaratee"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "otherTransit"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "noOfConveyor"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "currency"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "singleCarryLimit"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "annualTurnover"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "conveyMethod"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
           
            
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

