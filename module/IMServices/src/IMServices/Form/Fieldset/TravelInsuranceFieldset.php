<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\TravelInsurance;

/**
 *
 * @author otaba
 *        
 */
class TravelInsuranceFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new TravelInsurance())->setHydrator($hydrator);
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            "name" => "coverStartDate",
            "type" => "date",
            "options" => array(
                "label" => "Proposed Cover Start Date",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "coverStartDate",
                "class" => "form-control col-md-7 col-xs-12",
                "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name" => "coverEndDate",
            "type" => "date",
            "options" => array(
                "label" => "Proposed Cover End Date",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "coverEndDate",
                "class" => "form-control col-md-7 col-xs-12",
                "required"=>"required"
            )
        ));
        
        
        $this->add(array(
           "name"=>"departure",
            "type"=>"text",
            "options"=>array(
                "label"=>"Departure city ",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                    
                )
            ),
            "attributes"=>array(
                "id"=>"departure",
                "class" => "form-control col-md-7 col-xs-12",
                "placeholder"=>"Alexandria Egypt"
            )
        ));
        
        $this->add(array(
            "name" => "coverageSum",
            "type" => "text",
            "options" => array(
                "label" => "Cover Sum",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "coverageSum",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
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
            "name" => "isLostBaggage",
            "type" => "checkbox",
            "options" => array(
                "label" => "Provide Cover For Lost Baggage",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isLostBaggage",
//                 "checked" => true
            )
        ));
        
        
        $this->add(array(
            "name" => "isTravelInteruptionCover",
            "type" => "checkbox",
            "options" => array(
                "label" => "Provide Cover For Interupted Travel",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isTravelInteruptionCover",
                //                 "checked" => true
            )
        ));
        
        //isTravelInteruptionCover
        
        $this->add(array(
            "name"=>"lostBaggageSum",
            "type"=>"text",
            "options"=>array(
                "label"=>"Lost Baggage Sum",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"lostBaggageSum",
                "class"=>"form-control col-md-7 col-xs-12",
                "placeholder"=>"500000"
            )
        ));
        
        
        $this->add(array(
            "name"=>"lostBaggageCoverage",
            "type"=>"text",
            "options"=>array(
                "label"=>"Lost Baggage Coverage Condition",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"lostBaggageCoverage",
                "class"=>"form-control col-md-7 col-xs-12",
                "placeholder"=>"Round trip"
            )
        ));
        
        
        $this->add(array(
            "name"=>"travelInteruptionCoverage",
            "type"=>"text",
            "options"=>array(
                "label"=>"Travel Interuption Coverage condition",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"travelInteruptionCoverage",
                "class"=>"form-control col-md-7 col-xs-12",
                "placeholder"=>"First stop over cover only"

            )
        ));
        
        
        $this->add(array(
            "name"=>"travelInteruptionSum",
            "type"=>"text",
            "options"=>array(
                "label"=>"Travel Interuption Sum",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"travelInteruptionSum",
                "class"=>"form-control col-md-7 col-xs-12",
                "placeholder"=>"20000"
            )
        ));
        
        
        $this->add(array(
            'name' => 'coverageTeritory',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Coverage Teritory',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\CoverageTeritory',
                // 'empty_option' => '-- Select a Proposed Insurer --',
                'property' => 'coverageName'
                
            ),
            'attributes' => array(
                'id' => 'coverageTeritory',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            "name" => "isPackage",
            "type" => "checkbox",
            "options" => array(
                "label" => "Insurer Custom Package",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isPackage",
                //                 "checked" => true
            )
        ));
        
        $this->add(array(
            "name"=>"packageName",
            "type"=>"text",
            "options"=>array(
                "label"=>"Package Name",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"packageName",
                "class"=>"form-control col-md-7 col-xs-12",
                "placeholder"=>"NEXUS WORLDWIDE"
            )
        ));
        
        $this->add(array(
            "name"=>"destination",
            "type"=>"text",
            "options"=>array(
                "label"=>"Destination",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"destination",
                "class"=>"form-control col-md-7 col-xs-12",
                "placeholder"=>"Alberta, Canada"
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
            "destination"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "packageName"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "isPackage"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "coverageTeritory"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "travelInteruptionSum"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "travelInteruptionCoverage"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "lostBaggageCoverage"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "lostBaggageSum"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "isTravelInteruptionCover"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isLostBaggage"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "currency"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "coverageSum"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "coverStartDate"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "coverEndDate"=>array(
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

