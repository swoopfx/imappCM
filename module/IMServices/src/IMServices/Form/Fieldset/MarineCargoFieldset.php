<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\MarineCargo;

/**
 *
 * @author otaba
 *        
 */
class MarineCargoFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new MarineCargo())->setHydrator($hydrator);
        $this->addField();
    }

    private function addField()
    {
        $this->add(array(
            "name" => "cargoNature",
            "type" => "textarea",
            "options" => array(
                "label" => "Nature Of Cargo",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "cargo_nature",
                "class" => "form-control col-md-9 col-xs-12",
                "placeholder" => "Describe the nature of the cargo",
                "required" => "required"
            )
        ));
        
        $this->add(array(
            "name" => "experienceYears",
            "type" => "text",
            'options' => array(
                "label" => "Years Of Experience in Business",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "experienc_years",
                "class" => "form-control col-md-9 col-xs-12",
                "placeholder" => "3 years"
            
            )
        ));
        
        $this->add(array(
            "name" => "packagingType",
            "type" => "DoctrineModule\Form\Element\ObjectSelect",
            "options" => array(
                "label" => "Type Of Packaging",
                'object_manager' => $this->entityManager,
                "empty_options" => "-- Select A Package Type--",
                'target_class' => 'Settings\Entity\MarineCargPackagingType',
                'property' => 'package',
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "packagingType",
                "class" => "form-control col-md-9 col-sm-9 col-xs-12",
                "required" => "required"
            
            )
        ));
        
        $this->add(array(
            "name" => "othersPackage",
            "type" => "text",
            "options" => array(
                "label" => "Other Package",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "other_package",
                "class" => "form-control col-md-9 col-sm-9 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "transitMode",
            "type" => "DoctrineModule\Form\Element\ObjectSelect",
            "options" => array(
                "label" => "Mode of Transmit",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                ),
                'object_manager' => $this->entityManager,
                "empty_options" => "-- Mode oF Transmit--",
                'target_class' => "Settings\Entity\MarineCargoTransitMode",
                'property' => 'transitMode'
            ),
            "attributes" => array(
                "id" => "transmit_mode",
                "class" => "form-control col-md-9 col-sm-9 col-xs-12",
                "required" => "required"
            )
        ));
        
        $this->add(array(
            "name" => "coverType",
            "type" => "DoctrineModule\Form\Element\ObjectSelect",
            "options" => array(
                "label" => "Policy Type ",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                ),
                
                'object_manager' => $this->entityManager,
                "empty_options" => "-- Mode oF Transmit--",
                'target_class' => 'Settings\Entity\MarineCargoCoverType',
                'property' => 'cover'
            ),
            "attributes" => array(
                "id" => "cover_type",
                "class" => "form-control col-md-9 col-sm-9 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "currency",
            "type" => "DoctrineModule\Form\Element\ObjectSelect",
            "options" => array(
                "label" => "Cargo Cover Type ",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                ),
                
                'object_manager' => $this->entityManager,
                "empty_options" => "-- Mode oF Transmit--",
                'target_class' => 'Settings\Entity\Currency',
                'property' => 'title'
            ),
            "attributes" => array(
                "id" => "cover_type",
                "class" => "form-control col-md-9 col-sm-9 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "cargoValue",
            "type" => "text",
            "options" => array(
                "label" => "Cargo Value",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "cargoValue",
                "class" => "form-control col-md-9 col-sm-9 col-xs-12",
                "placeholder"=>"20000"
            )
        ));
        
        $this->add(array(
            "name" => "maxSumInsured",
            "type" => "text",
            "options" => array(
                "label" => "Maximum Sum Insured per Conveyance",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "max_sum_insured",
                "class" => "form-control col-md-9 col-sm-9 col-xs-12"
            
            )
        ));
        
        $this->add(array(
            "name" => "expectedPremium",
            "type" => "text",
            "options" => array(
                "label" => "Expected Premium",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "expected_premium",
                "class" => "form-control col-md-9 col-sm-9 col-xs-12"
            
            )
        
        ));
        
        $this->add(array(
            "name" => "voyageFrom",
            "type" => "text",
            "options" => array(
                "label" => "Voyage From",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "voyage_from",
                "class" => "form-control col-md-9 col-sm-9 col-xs-12",
                "placeholder"=>"Europe Germany"
            
            )
        ));
        
        $this->add(array(
            "name" => "voyageTo",
            "type" => "text",
            "options" => array(
                "label" => "Voyage To",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "voyage_to",
                "class" => "form-control col-md-9 col-sm-9 col-xs-12",
                "placeholder"=>"Lagos, Nigeria"
            
            )
        ));
        
//         $this->add(array(
//             "name" => "typeOfVessel",
//             "type" => "text",
//             "options" => array(
//                 "label" => "Vessel Type",
//                 "label_attributes" => array(
//                     "class" => "control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes" => array(
//                 "id" => "vessel_type",
//                 "class" => "form-control col-md-9 col-sm-9 col-xs-12"
            
//             )
//         ));
        
        $this->add(array(
            'name' => 'typeOfVessel',
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
                'id' => 'typeOfVessel',
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
            "name" => "nameOfVessel",
            "type" => "text",
            "options" => array(
                "label" => "Name Of Vessel",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "nameOfVessel",
                "class" => "form-control col-md-9 col-sm-9 col-xs-12"
            
            )
        ));
        
        $this->add(array(
            "name" => "isContainized",
            "type" => "checkbox",
            "options" => array(
                "label" => "Are goods Containized",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "is_containized",
                "class" => " col-md-9 col-sm-9 col-xs-12"
            
            )
        ));
        
        $this->add(array(
            "name" => "isPreviousDecline",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has any Insurer declined, canceled your business or imposed a special term",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isPreviousDecline",
                "class" => "col-md-9 col-sm-9 col-xs-12"
            
            )
        ));
        
        
        $this->add(array(
            "name" => "declineReason",
            "type" => "textarea",
            "options" => array(
                "label" => "Details of insurer reason",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "declineReason",
                "class" => "col-md-9 col-sm-9 col-xs-12"
                
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
            "packagingType"=>array(
                "required"=>false,
                "allow_empty"=>true,
            )
        );
    }

    public function setEntityManager($em)
    {
       $this->entityManager = $em;
       return $this;
    }
}

