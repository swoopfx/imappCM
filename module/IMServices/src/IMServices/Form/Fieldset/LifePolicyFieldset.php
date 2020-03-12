<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\LifePolicy;

/**
 *
 * @author otaba
 *        
 */
class LifePolicyFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new LifePolicy())->setHydrator($hydrator);
        
        $this->add(array(
            "name" => "businessNature",
            "type" => "text",
            "options" => array(
                "label" => "Nature of Business/Occupation",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "businessNature",
                "class" => "form-control"
            )
        ));
        
        $this->add(array(
            'name' => 'sex',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Sex',
                'label_attributes' => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Sex',
                // 'empty_option' => '-- Select a Proposed Insurer --',
                'property' => 'sex'
            
            ),
            'attributes' => array(
                'id' => 'sex',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            'name' => 'maritalStatus',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Marital Status',
                'label_attributes' => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\MaritalStatus',
                // 'empty_option' => '-- Select a Proposed Insurer --',
                'property' => 'status'
            
            ),
            'attributes' => array(
                'id' => 'maritalStatus',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            "name" => "isPregnant",
            "type" => "checkbox",
            "options" => array(
                "label" => "Is Pregnant",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "isPregnant",
                "class" => "col-md-6"
            )
        ));
        
        $this->add(array(
            "name" => "husbandsName",
            "type" => "text",
            "options" => array(
                "label" => "Husbands Name",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "husbandsName",
                "class" => "form-control col-md-6"
            )
        ));
        
        
        $this->add(array(
            "name" => "isSelfEmployed",
            "type" => "checkbox",
            "options" => array(
                "label" => "Is Self Employed",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "isSelfEmployed",
                "class" => "col-md-6"
            )
        ));
        
        $this->add(array(
            "name" => "selfEmployedBusiness",
            "type" => "text",
            "options" => array(
                "label" => "Business Name",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "selfEmployedBusiness",
                "class" => "form-control"
            )
        ));
        
        $this->add(array(
            "name" => "isJobChangedIn3years",
            "type" => "checkbox",
            "options" => array(
                "label" => "Job has been changed in the last 3 years?",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "isJobChangedIn3years",
                "class" => "col-md-6"
            )
        ));
        
        $this->add(array(
            "name" => "isAccidentOrDisease",
            "type" => "checkbox",
            "options" => array(
                "label" => "Had accidents and diseases",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "isAccidentOrDisease",
                "class" => "col-md-6"
            )
        ));
        
        $this->add(array(
            "name" => "isTravel",
            "type" => "checkbox",
            "options" => array(
                "label" => "Tavel Frequently",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "isTravel",
                "class" => "col-md-6"
            )
        ));
        
        $this->add(array(
            "name" => "localTravelDuration",
            "type" => "text",
            "options" => array(
                "label" => "Local Travel Frequency",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "localTravelDuration",
                "class" => "form-control col-md-6"
            )
        ));
        
        $this->add(array(
            "name" => "abroadTravelDuration",
            "type" => "text",
            "options" => array(
                "label" => "International Travel Frequency",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "abroadTravelDuration",
                "class" => "form-control col-md-6"
            )
        ));
        
        $this->add(array(
            "name" => "sumAssured",
            "type" => "text",
            "options" => array(
                "label" => "Sum Assured",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "sumAssured",
                "class" => "form-control col-md-6"
            )
        ));
        
        $this->add(array(
            "name" => "isPlanOfAssurance",
            "type" => "checkbox",
            "options" => array(
                "label" => "Plan Of Assurance",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "isPlanOfAssurance",
                "class" => "col-md-6",
                "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "isAssuranceTerm",
            "type" => "checkbox",
            "options" => array(
                "label" => "Term Of Assurance",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "isAssuranceTerm",
                "class" => "col-md-6",
                "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "isWithProfit",
            "type" => "checkbox",
            "options" => array(
                "label" => "With Profit",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "isWithProfit",
                "class" => "col-md-6",
                "checked" => true
            )
        ));
        
        $this->add(array(
            "name" => "commencementDate",
            "type" => "date",
            "options" => array(
                "label" => "Commencement Date",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "commencementDate",
                "class" => "form-control col-md-6"
            
            )
        ));
        
        $this->add(array(
            "name" => "isPremiumWaiver",
            "type" => "checkbox",
            "options" => array(
                "label" => "Waiver On Premium",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "isPremiumWaiver",
                "class" => "col-md-6"
                // "checked"=>true
            )
        ));
        
        $this->add(array(
            "name" => "isAccidentalDeathBenefit",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Accidental Death Benefit",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "isAccidentalDeathBenefit",
                "class" => "col-md-6"
                // "checked"=>true
            )
        ));
        
        $this->add(array(
            "name" => "provisionalPremium",
            "type" => "text",
            "options" => array(
                "label" => "Include Provisonal premium",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "provisionalPremium",
                "class" => "form-control col-md-6"
            )
        ));
        
        $this->add(array(
            "name" => "isPersonalAccidentBenefit",
            "type" => "checkbox",
            "options" => array(
                "label" => "Include Personal accident Benefit",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "isPersonalAccidentBenefit",
                "class" => "col-md-6"
            )
        ));
        
        //
        
        $this->add(array(
            'name' => 'paymentFrequency',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Premium Payment Frequency',
                'label_attributes' => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\MicroPaymentStructure',
                // 'empty_option' => '-- Select a Proposed Insurer --',
                'property' => 'microText'
            
            ),
            'attributes' => array(
                'id' => 'paymentFrequency',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            "name" => "isPhysician",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Personal Physician",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "isPhysician",
                "class" => " col-md-6"
            )
        ));
        
        $this->add(array(
            "name" => "physicianName",
            "type" => "text",
            "options" => array(
                "label" => "Physician Name & contact",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "physicianName",
                "class" => "form-control col-md-6"
            )
        ));
        
        $this->add(array(
            "name" => "consultationReason",
            "type" => "text",
            "options" => array(
                "label" => "Consultation Reason",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "consultationReason",
                "class" => "form-control col-md-6"
            )
        ));
        // lastTreatmentDate
        
        $this->add(array(
            "name" => "lastTreatmentDate",
            "type" => "date",
            "options" => array(
                "label" => "Last Treatment date",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "lastTreatmentDate",
                "class" => "form-control col-md-6"
            )
        ));
        
        $this->add(array(
            "name" => "isMedicalCondition",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Medical Condition",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "isMedicalCondition",
                "class" => " col-md-6"
            )
        ));
        
        $this->add(array(
            "name" => "isRespiratoryDisease",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has respiratory disease",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "isRespiratoryDisease",
                "class" => " col-md-6"
            )
        ));
        
        $this->add(array(
            "name" => "isEpilepsy",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has epilepsy",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "isEpilepsy",
                "class" => " col-md-6"
            )
        ));
        
        $this->add(array(
            "name" => "isClinicalDepresion",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has clinical depression",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "isClinicalDepresion",
                "class" => " col-md-6"
            )
        ));
        
        $this->add(array(
            "name" => "isMisCarriage",
            "type" => "checkbox",
            "options" => array(
                "label" => "Had Miscarriage",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "isMisCarriage",
                "class" => " col-md-6"
            )
        ));
        
        $this->add(array(
            "name" => "isInsanity",
            "type" => "checkbox",
            "options" => array(
                "label" => "Suffered Insanity",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "isInsanity",
                "class" => " col-md-6"
            )
        ));
        
        $this->add(array(
            "name" => "isDiabetes",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Diabetes",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "isDiabetes",
                "class" => " col-md-6"
            )
        ));
        
        $this->add(array(
            "name" => "isHeartDisease",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has heart disease",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "isHeartDisease",
                "class" => " col-md-6"
            )
        ));
        
        $this->add(array(
            "name" => "isHiv",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has HIV",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "isHiv",
                "class" => " col-md-6"
            )
        ));
        
        $this->add(array(
            "name" => "isParalysis",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Paralysis of any kind",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "isParalysis",
                "class" => " col-md-6"
            )
        ));
        
        $this->add(array(
            "name" => "isHbp",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has High Blood Pressure",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "isHbp",
                "class" => " col-md-6"
            )
        ));
        
        $this->add(array(
            "name" => "isCancer",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Cancer",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "isCancer",
                "class" => " col-md-6"
            )
        ));
        
        // isOtherCondition
        
        $this->add(array(
            "name" => "isOtherCondition",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Other Condition",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "isOtherCondition",
                "class" => " col-md-6"
            )
        ));
        
        $this->add(array(
            "name" => "conditionDetails",
            "type" => "textarea",
            "options" => array(
                "label" => "Condition Details",
                "label_attributes" => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                )
            ),
            "attributes" => array(
                "id" => "conditionDetails",
                "class" => " form-control col-md-6"
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
            "conditionDetails" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isOtherCondition" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isCancer" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isHbp" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isParalysis" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isHiv" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isHeartDisease" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isDiabetes" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isInsanity" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isMisCarriage" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isClinicalDepresion" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isEpilepsy" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isRespiratoryDisease" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "lastTreatmentDate" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isMedicalCondition" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "consultationReason" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "physicianName" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isPhysician" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "paymentFrequency" => array(
                "allow_empty" => true,
                "required" => false
            ),
            
            "isPersonalAccidentBenefit" => array(
                "allow_empty" => true,
                "required" => false
            ),
            
            "provisionalPremium" => array(
                "allow_empty" => true,
                "required" => false
            ),
            
            "isAccidentalDeathBenefit" => array(
                "allow_empty" => true,
                "required" => false
            ),
            
            "isPremiumWaiver" => array(
                "allow_empty" => true,
                "required" => false
            ),
            
            "commencementDate" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "businessNature" => array(
                "allow_empty" => true,
                "required" => false
            ),
            
            "selfEmployedBusiness" => array(
                "allow_empty" => true,
                "required" => false
            ),
            
            "isSelfEmployed" => array(
                "allow_empty" => true,
                "required" => false
            ),
            
            "maritalStatus" => array(
                "allow_empty" => true,
                "required" => false
            ),
            
            "sex" => array(
                "allow_empty" => true,
                "required" => false
            ),
            
            "abroadTravelDuration" => array(
                "allow_empty" => true,
                "required" => false
            ),
            
            "localTravelDuration" => array(
                "allow_empty" => true,
                "required" => false
            ),
            
            "isTravel" => array(
                "allow_empty" => true,
                "required" => false
            ),
            
            "isAccidentOrDisease" => array(
                "allow_empty" => true,
                "required" => false
            ),
            
            "isJobChangedIn3years" => array(
                "allow_empty" => true,
                "required" => false
            ),
            
            "isAssuranceTerm" => array(
                "allow_empty" => true,
                "required" => false
            ),
            
            "isPlanOfAssurance" => array(
                "allow_empty" => true,
                "required" => false
            ),
           
            "isPregnant" => array(
                "allow_empty" => true,
                "required" => false
            ),
            
            "isWithProfit" => array(
                "allow_empty" => true,
                "required" => false
            ),
            
            "commencementDate" => array(
                "allow_empty" => true,
                "required" => false
            ),
            
           
            
        
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

