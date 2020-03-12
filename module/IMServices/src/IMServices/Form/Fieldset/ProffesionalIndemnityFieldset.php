<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\ProfessionalIndemnity;

/**
 *
 * @author otaba
 *        
 */
class ProffesionalIndemnityFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new ProfessionalIndemnity());
        
//         $this->add(array(
//             'name' => 'currency',
//             'type' => 'DoctrineModule\Form\Element\ObjectSelect',
//             'options' => array(
//                 'label' => 'Currency',
//                 'label_attributes' => array(
//                     'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
//                 ),
//                 'object_manager' => $this->entityManager,
//                 'target_class' => 'Settings\Entity\Currency',
//                 // 'empty_option' => '-- Select a Proposed Insurer --',
//                 'property' => 'code'
            
//             ),
//             'attributes' => array(
//                 'id' => 'currency',
//                 'class' => 'form-control'
//             )
//         ));
        
        $this->add(array(
            "name" => "headOffice",
            "type" => "textarea",
            "options" => array(
                "label" => "Head Office",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "headOffice",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12"
            
            )
        
        ));
        
        $this->add(array(
            "name" => "otherOffice",
            "type" => "textarea",
            "options" => array(
                "label" => "Other Offices",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "otherOffice",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12"
            
            )
        
        ));
        
        $this->add(array(
            "name" => "isOutStandingIndemnity",
            "type" => "checkbox",
            "options" => array(
                "label" => "Is there availaible any outstanding indemnity",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isOutStandingIndemnity",
                "class" => " col-md-7 col-sm-7 col-xs-12",
//                 "placeholder" => "30,000"
            )
            
        ));
        
        $this->add(array(
            "name" => "indemnityValue",
            "type" => "text",
            "options" => array(
                "label" => "Value of Outstanding Indemnity",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "indemnityValue",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "placeholder" => "30,000"
            )
        
        ));
        
        // $this->add(array(
        // "name"=>"isAlternativePractice",
        // "type"=>"checkbox",
        // "options"=>array(
        // "label"=>"Alternative Practice",
        // "label_attributes"=>array(
        // "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
        // )
        // ),
        // "attributes"=>array(
        // "id"=>"isAlternativePractice",
        // "class"=>"col-md-7 col-sm-7 col-xs-12",
        // "placeholder"=>"30,000"
        // )
        
        // ));
        
        $this->add(array(
            "name" => "indemnityStart",
            "type" => "date",
            "options" => array(
                "label" => "Start Date",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "indemnityStart",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12"
                // "placeholder"=>"30,000"
            )
        
        ));
        
        $this->add(array(
            "name" => "indemnityEnd",
            "type" => "date",
            "options" => array(
                "label" => "End Date",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "indemnityEnd",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12"
                // "placeholder"=>"30,000"
            )
        
        ));
        
        $this->add(array(
            "name" => "annualBrokerageIncome",
            "type" => "text",
            "options" => array(
                "label" => "Annual Brokage Income",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "annualBrokerageIncome",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "placeholder" => "if applicable"
            )
        
        ));
        
        $this->add(array(
            "name" => "isUnderwritingAgent",
            "type" => "checkbox",
            "options" => array(
                "label" => "Is Underwriting Agent",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isUnderwritingAgent",
                "class" => "col-md-7 col-sm-7 col-xs-12"
                // "placeholder"=>"30,000"
            )
        
        ));
        
        $this->add(array(
            "name" => "profession",
            "type" => "text",
            "options" => array(
                "label" => "Type of Profession",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "profession",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12"
                // "placeholder"=>"30,000"
            )
        
        ));
        
        $this->add(array(
            "name" => "professionalBody",
            "type" => "text",
            "options" => array(
                "label" => "Associated Professional Body",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "professionalBody",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12"
                // "placeholder"=>"30,000"
            )
        
        ));
        
        $this->add(array(
            "name" => "membership",
            "type" => "text",
            "options" => array(
                "label" => "Membership Status in professional Body",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "membership",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "placeholder"=>"Member"
            )
        
        ));
        
        $this->add(array(
            "name" => "professionDuration",
            "type" => "text",
            "options" => array(
                "label" => "Practice Duration",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "professionDuration",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12"
                // "placeholder"=>"30,000"
            )
        
        ));
        
        $this->add(array(
            "name" => "isPreviousInsure",
            "type" => "checkbox",
            "options" => array(
                "label" => "Previously Insured",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isPreviousInsure",
                "class" => "col-md-7 col-sm-7 col-xs-12"
                // "placeholder"=>"30,000"
            )
        
        ));
        
        $this->add(array(
            "name" => "isDeclined",
            "type" => "checkbox",
            "options" => array(
                "label" => "Indemnity Previously Declined",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isDeclined",
                "class" => "col-md-7 col-sm-7 col-xs-12"
                // "placeholder"=>"30,000"
            )
        
        ));
        
        $this->add(array(
            "name" => "isSubjectToIncrease",
            "type" => "checkbox",
            "options" => array(
                "label" => "Premium was subject to increase",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isSubjectToIncrease",
                "class" => "col-md-7 col-sm-7 col-xs-12"
                // "placeholder"=>"30,000"
            )
        
        ));
        
        $this->add(array(
            "name" => "isSpecialRestriction",
            "type" => "checkbox",
            "options" => array(
                "label" => "Indemnity Had Special restriction",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isSpecialRestriction",
                "class" => "col-md-7 col-sm-7 col-xs-12"
                // "placeholder"=>"30,000"
            )
        
        ));
        
        $this->add(array(
            "name" => "specialRestriction",
            "type" => "text",
            "options" => array(
                "label" => "Special Restriction",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "specialRestriction",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12"
                // "placeholder"=>"30,000"
            )
        
        ));
        
        // $this->add(array(
        // "name"=>"isOtherCountery",
        // "type"=>"checkbox",
        // "options"=>array(
        // "label"=>"Special Restriction",
        // "label_attributes"=>array(
        // "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
        // )
        // ),
        // "attributes"=>array(
        // "id"=>"isOtherCountery",
        // "class"=>"col-md-7 col-sm-7 col-xs-12",
        // // "placeholder"=>"30,000"
        // )
        
        // ));
        
        // $this->add(array(
        // 'name' => 'otherCountry',
        // 'type' => 'DoctrineModule\Form\Element\ObjectSelect',
        // 'options' => array(
        // 'label' => 'Other Country',
        // 'label_attributes' => array(
        // 'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
        // ),
        // 'object_manager' => $this->entityManager,
        // 'target_class' => 'Settings\Entity\Country',
        // // 'empty_option' => '-- Select a Proposed Insurer --',
        // 'property' => 'countryName'
        
        // ),
        // 'attributes' => array(
        // 'id' => 'otherCountry',
        // 'class' => 'form-control'
        // )
        // ));
        
        $this->add(array(
            "name" => "isAdditonalInfo",
            "type" => "checkbox",
            "options" => array(
                "label" => "Additional Info",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isAdditonalInfo",
                "class" => "col-md-7 col-sm-7 col-xs-12"
                // "placeholder"=>"30,000"
            )
        
        ));
        
        $this->add(array(
            "name" => "totalPartners",
            "type" => "text",
            "options" => array(
                "label" => "Total Partners",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "totalPartners",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12"
                // "placeholder"=>"30,000"
            )
        
        ));
        
        $this->add(array(
            "name" => "totalStaff",
            "type" => "text",
            "options" => array(
                "label" => "Total Number of Staff",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "totalStaff",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12"
                // "placeholder"=>"30,000"
            )
        
        ));
        
        $this->add(array(
            "name" => "isCoverAllStaff",
            "type" => "checkbox",
            "options" => array(
                "label" => "Cover For all Staff",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isCoverAllStaff",
                "class" => "col-md-7 col-sm-7 col-xs-12"
                // "placeholder"=>"30,000"
            )
        
        ));
        
        //
        
        $this->add(array(
            "name" => "limitIndemnity",
            "type" => "text",
            "options" => array(
                "label" => "Limited Identity",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "limitIndemnity",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12"
                // "placeholder"=>"30,000"
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
            "isOutStandingIndemnity"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
            "limitIndemnity"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            "isCoverAllStaff"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            "totalStaff"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            "totalPartners"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            "isAdditonalInfo"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            "specialRestriction"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            "isSpecialRestriction"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            "isSubjectToIncrease"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            "isDeclined"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            "isPreviousInsure"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            "professionDuration"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            "membership"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            "professionalBody"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            "profession"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
            "isUnderwritingAgent"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
            "indemnityEnd"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
            "indemnityStart"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
            "indemnityValue"=>array(
                "allow_empty"=>true,
                "required"=>FALSE,
            ),
            
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

