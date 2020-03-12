<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\GoodsInTransit;

/**
 *
 * @author otaba
 *        
 */
class GitFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new GoodsInTransit());
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            "name" => "goodDescription",
            "type" => "textarea",
            "options" => array(
                "label" => "Goods Description",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "goods_desc",
                "class" => "form-control col-md-7 col-xs-12",
                "placeholder" => "Provide a description of the type of goods being conveyed by this facility"
            )
        ));
        
        $this->add(array(
            'name' => 'geographicalArea',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Area of Operation',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'empty_option' => '--Select Geographical Area -- ',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\GeographicalArea',
                'property' => 'area'
            ),
            'attributes' => array(
                'id' => 'geographical_areas',
                'class' => 'form-control col-md-7 col-xs-12'
            
            )
        ));
        
        $this->add(array(
            "name"=>"otherGeographicalArea",
            "type"=>"text",
            "options"=>array(
                "label"=>"Other Area",
                "label_attributes"=>array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            "attributes"=>array(
                'id' => 'otherGeographicalArea',
                'class' => 'form-control col-md-7 col-xs-12'
            )
        ));
        
        $this->add(array(
            "name"=>"otherTransportMedium",
            "type"=>"text",
            "options"=>array(
                "label"=>"Other Transport Medium",
                "label_attributes"=>array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            "attributes"=>array(
                'id' => 'otherTransportMedium',
                'class' => 'form-control col-md-7 col-xs-12'
            )
        ));
        
        $this->add(array(
            'name' => 'transportMedium',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Transport Medium',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'empty_option' => '--Select Transport Medium -- ',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\TransportMedium',
                'property' => 'medium'
            ),
            'attributes' => array(
                'id' => 'transportMedium',
                'class' => 'form-control col-md-7 col-xs-12'
            
            )
        ));
        
        $this->add(array(
            'name' => 'specificGoods',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Specific Goods',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'empty_option' => '--Select Specific Goods -- ',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\GITSpecificGoods',
                'property' => 'service'
            ),
            'attributes' => array(
                'id' => 'specificGoods',
                'class' => 'form-control col-md-7 col-xs-12',
                'multiple' => 'multiple'
            
            )
        ));
        
        $this->add(array(
            "name" => "isLockeNAttended",
            "type" => "checkbox",
            "options" => array(
                "label" => "Goods Locked and Attended",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "is_locked_n_attended",
                "class" => "col-md-7 col-xs-12",
                'checked' => false
            )
        ));
        
        $this->add(array(
            "name" => "isAntiTheftDevice",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Anti Theft Device",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "is_anti_theft",
                "class" => "col-md-7 col-xs-12",
                'checked' => false
            )
        ));
        
        $this->add(array(
            "name" => "antiTheftDevice",
            "type" => "text",
            "options" => array(
                "label" => "Type of Anti Theft",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "antiTheftDevice",
                "class" => "form-control col-md-7 col-xs-12",
                "placeholder"=>"Type of Anti Theft device used "
            )
        ));
        
//         $this->add(array(
//             "name"=>"vehicleDetails",
//         ));

        $this->add(array(
            "name"=>"yearlyTotalEstimate",
            "type"=>"text",
            "options"=>array(
                "label"=>"Yearly Estimate",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"yearlyTotalEstimate",
                "class"=>"form-control col-md-7  col-xs-12"
            ),
            
        ));
        
        
        $this->add(array(
            "name"=>"estimatedLimit",
            "type"=>"text",
            "options"=>array(
                "label"=>" Consignment Limit",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"estimatedLimit",
                "class"=>"form-control col-md-7  col-xs-12"
            ),
            
        ));
        
        
        $this->add(array(
            "name" => "isOtherInsurance",
            "type" => "checkbox",
            "options" => array(
                "label" => "Had a previous insurer",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "is_other_insurance",
                "class" => "col-md-7 col-xs-12",
                'checked' => false
            )
        ));
        
        $this->add(array(
            "name" => "isPreviousDecline",
            "type" => "checkbox",
            "options" => array(
                "label" => "Previously Declined",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isPreviousDecline",
                "class" => " col-md-7 col-xs-12",
                'checked' => false
            )
        ));
        
        $this->add(array(
            "name" => "isIncreaseContribution",
            "type" => "checkbox",
            "options" => array(
                "label" => "Previous Insurer Increased Contribution",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isIncreaseContribution",
                "class" => " col-md-7 col-xs-12",
                'checked' => false
            )
        ));
        
        $this->add(array(
            "name" => "isRequireSpecialTerm",
            "type" => "checkbox",
            "options" => array(
                "label" => "Previous Insurer Required Special Term",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isRequireSpecialTerm",
                "class" => " col-md-7 col-xs-12",
                'checked' => false
            )
        ));
        
        $this->add(array(
            "name" => "specialTerm",
            "type" => "textarea",
            "options" => array(
                "label" => "Special Term Defined",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "specialTerm",
                "class" => "form-control col-md-7 col-xs-12",
//                 'checked' => false
            )
        ));
        
        $this->add(array(
            "name" => "isCanceledPolicy",
            "type" => "checkbox",
            "options" => array(
                "label" => "Previous Policy canceled",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isCanceledPolicy",
                "class" => "form-control col-md-7 col-xs-12",
                'checked' => false
            )
        ));
        
        $this->add(array(
            "name" => "isPreviousLoss",
            "type" => "checkbox",
            "options" => array(
                "label" => "Is Previous Loss",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isPreviousLoss",
                "class" => "form-control col-md-7 col-xs-12",
                'checked' => false
            )
        ));
        
       
        
        $this->add(array(
            "name" => "additionalInfo",
            "type" => "textarea",
            "options" => array(
                "label" => "Any Additional Info",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "addtional_info",
                "class" => "form-control col-md-7 col-xs-12",
                //                 'checked' => false
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
            "goodDescription"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "geographicalArea"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "additionalInfo"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isPreviousLoss"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isCanceledPolicy"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "specialTerm"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isRequireSpecialTerm"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isIncreaseContribution"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isPreviousDecline"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isOtherInsurance"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "estimatedLimit"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "yearlyTotalEstimate"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "antiTheftDevice"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isAntiTheftDevice"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "isLockeNAttended"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "specificGoods"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "transportMedium"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            
            "otherTransportMedium"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "otherGeographicalArea"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            //
            
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

