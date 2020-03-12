<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\Hull;

/**
 *
 * @author otaba
 *        
 */
class HullFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new Hull())->setHydrator($hydrator);
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            "name" => "vesselName",
            "type" => "text",
            "options" => array(
                "label" => "Vessel Name",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "vesselName",
                "placeholder"=>"if applicable"
            )
        ));
        
        $this->add(array(
            'name' => 'vesselType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Vessel Type',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\VesselType',
                'empty_option' => '-- Select a Vessel Type --',
                'property' => 'type'
            ),
            'attributes' => array(
                'id' => 'vesselType',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            "name" => "otherVesselType",
            "type" => "text",
            "options" => array(
                "label" => "Other Vessel Type",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "otherVesselType",
                "placeholder"=>"if applicable"
            )
        ));
        
        $this->add(array(
            "name" => "vesselBuilders",
            "type" => "text",
            "options" => array(
                "label" => "Vessel Builders",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "vesselBuilders",
                "placeholder" => "Mc Thomas & Co."
            )
        ));
        
        $this->add(array(
            "name" => "vesselPortOfRegistry",
            "type" => "text",
            "options" => array(
                "label" => "Vessel Port Of Registry",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "vesselPortOfRegistry",
                "placeholder" => "Rebidy Port China"
            )
        ));
        
        $this->add(array(
            "name" => "identificationNo",
            "type" => "text",
            "options" => array(
                "label" => "Vessel Identification No.",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "identificationNo",
                "placeholder" => "ABC 123 XYZ"
            )
        ));
        
        $this->add(array(
            "name" => "dateOfBuilt",
            "type" => "date",
            "options" => array(
                "label" => "Date Built",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "dateOfBuilt"
            
            )
        ));
        
        $this->add(array(
            "name" => "dateOfPurchase",
            "type" => "date",
            "options" => array(
                "label" => "Date Of Purchase",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "dateOfBuilt"
                // "placeholder"=>"ABC 123 XYZ"
            )
        ));
        
        //
        
        $this->add(array(
            "name" => "pricePaid",
            "type" => "text",
            "options" => array(
                "label" => "Price Paid",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "pricePaid",
                "placeholder"=>"if applicable"
                // "placeholder"=>"ABC 123 XYZ"
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
                
                'property' => 'code'
            
            ),
            'attributes' => array(
                'id' => 'currency',
                'class' => 'form-control'
            )
        ));
        
        
        
        $this->add(array(
            "name" => "vesselLength",
            "type" => "text",
            "options" => array(
                "label" => "Length Of Vessel",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "vesselLength",
                "placeholder"=>"50"
            )
        ));
        

        
        $this->add(array(
            "name" => "vesselBeam",
            "type" => "text",
            "options" => array(
                "label" => "Vessel Beam",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "vesselBeam"
                // "placeholder"=>"ABC 123 XYZ"
            )
        ));
        
//         $this->add(array(
//             "name" => "draft",
//             "type" => "text",
//             "options" => array(
//                 "label" => "Draft",
//                 "label_attributes" => array(
//                     "class" => "control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes" => array(
//                 "class" => "form-control col-md-7 col-xs-12",
//                 "id" => "draft"
//                 // "placeholder"=>"ABC 123 XYZ"
//             )
//         ));
        
        $this->add(array(
            "name" => "tonnage",
            "type" => "text",
            "options" => array(
                "label" => "Tonnage",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "tonnage"
                // "placeholder"=>"ABC 123 XYZ"
            )
        ));
        
        $this->add(array(
            "name" => "isProfessionalSurveyed",
            "type" => "checkbox",
            "options" => array(
                "label" => "Vessel Surveyed By Professionals",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isProfessionalSurveyed",
                "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "surveyReport",
            "type" => "textarea",
            "options" => array(
                "label" => "Survey Report",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "surveyReport"
                // "placeholder"=>"ABC 123 XYZ"
            )
        ));
        
        $this->add(array(
            "name" => "vesselValue",
            "type" => "text",
            "options" => array(
                "label" => "Vessel present estimated Value",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "vesselValue"
            
            )
        ));
        
        $this->add(array(
            'name' => 'vesselCurrency',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Currency',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Currency',
                
                'property' => 'code'
            
            ),
            'attributes' => array(
                'id' => 'vesselCurrency',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            "name" => "trailerValue",
            "type" => "text",
            "options" => array(
                "label" => "Trailer Value",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "trailerValue"
            
            )
        ));
        
        $this->add(array(
            'name' => 'trailerCurrency',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Currency',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Currency',
                
                'property' => 'code'
            
            ),
            'attributes' => array(
                'id' => 'trailerCurrency',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            "name" => "totalInsuredValue",
            "type" => "text",
            "options" => array(
                "label" => "Total Insured Value",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "totalInsuredValue"
            
            )
        ));
        
        $this->add(array(
            'name' => 'tiCurrency',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Currency',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Currency',
                
                'property' => 'code'
            
            ),
            'attributes' => array(
                'id' => 'tiCurrency',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            "name" => "makeNModel",
            "type" => "text",
            "options" => array(
                "label" => "Vesel Make & Model",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "makeNModel"
            
            )
        ));
        
        $this->add(array(
            "name" => "engineCount",
            "type" => "number",
            "options" => array(
                "label" => "Engine Count",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                "id" => "engineCount"
            
            )
        ));
        
        $this->add(array(
            'name' => 'engineType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Machine Engine Type',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\MarineEngineType',
                'empty_option' => '-- Select an Engine Typer --',
                'property' => 'type'
            
            ),
            'attributes' => array(
                'id' => 'engineType',
                'class' => 'form-control'
            )
        ));
        

        
        
        $this->add(array(
            "name" => "otherEngineType",
            "type" => "text",
            "options" => array(
                "label" => "Specific Engine Type",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                'placeholder' => "if applicable",
                "id" => "otherEngineType"
                
            )
        ));
        
        
        $this->add(array(
            "name" => "personalEffects",
            "type" => "text",
            "options" => array(
                "label" => "Personal Effects Value",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-xs-12",
                'placeholder' => "if applicable",
                "id" => "personalEffects"
            
            )
        ));
        
     
        
        $this->add(array(
            "name" => "isCoverDroppingOff",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has a Cropping Off Cover",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isCoverDroppingOff",
                "checked" => true
            )
        ));
        
        $this->add(array(
            'name' => 'hullCoverType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Marine Cover Type',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\MarineHullCoverType',
                'empty_option' => '-- Select Marine Cover Type --',
                'property' => 'type'
            
            ),
            'attributes' => array(
                'id' => 'hullCoverType',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            'name' => 'marineTerritorialLimit',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Marine Territorial Limit',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\MarineTerritorialLimit',
                'empty_option' => '-- Select Marine Territory Limit --',
                'property' => 'territory'
            
            ),
            'attributes' => array(
                'id' => 'marineTerritorialLimit',
                'class' => 'form-control'
            )
        ));
        
//         $this->add(array(
//             'name' => 'marineTerritorialLimit',
//             'type' => 'DoctrineModule\Form\Element\ObjectSelect',
//             'options' => array(
//                 'label' => 'Territorial Limit',
//                 'label_attributes' => array(
//                     'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
//                 ),
//                 'object_manager' => $this->entityManager,
//                 'target_class' => 'Settings\Entity\MarineTerritorialLimit',
                
//                 'property' => 'territory'
            
//             ),
//             'attributes' => array(
//                 'id' => 'marineTerritorialLimit',
//                 'class' => 'form-control'
//             )
//         ));
        
        $this->add(array(
            "name" => "isThirdParty",
            "type" => "checkbox",
            "options" => array(
                "label" => "Require Third Party Limit",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isThirdParty",
                "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "isWaterSkierLiability",
            "type" => "checkbox",
            "options" => array(
                "label" => "Require Water Skier Liability",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isWaterSkierLiability",
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
            "dateOfBuilt"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "dateOfPurchase"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "tiCurrency"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "engineCount"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "engineType"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "hullCoverType"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "marineTerritorialLimit"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            
            "isWaterSkierLiability"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            
            "isThirdParty"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "isCoverDroppingOff"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            
            "vesselName"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "vesselType"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "otherVesselType"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "vesselBuilders"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "vesselPortOfRegistry"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "identificationNo"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "pricePaid"=>array(
                "required"=>false,
                "allow_empty"=>true
            ),
            "marineTerritorialLimit"=>array(
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

