<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\EmployerLiability;

/**
 *
 * @author otaba
 *        
 */
class EmployerLiabilityFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;
    

    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new EmployerLiability())->setHydrator($hydrator);
        $this->addFields();
    }
    
    private function addFields(){
        
        $this->add(array(
            "name"=>"profession",
            "type"=>"text",
            "options"=>array(
                "label"=>"Occupation",
                "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "id"=>"profession",
                "placeholder"=>"Plant Operator",
                
            ),
        ));
        
        
        $this->add(array(
            "name"=>"desc",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Employee Profession Description",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "id"=>"profession_desc",
                "placeholder"=>"Techincal Department , fixes all mechanical fault",
                
            ),
        ));
        
        $this->add(array(
            "name"=>"isTakenInOtherCountries",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Work Undertaken in other countries",
                'unchecked_value' => false,
                'checked_value' => true,
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"col-md-7 col-xs-12",
                "id"=>"isTakenInOtherCountries",
                "checked"=>false
            ),
        ));
        
        
        $this->add(array(
            "name"=>"otherCountryDetails",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Details Of work in other country",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "id"=>"otherCountryDetails",
                "placeholder"=>"Techincal Department , fixes all mechanical fault",
                
            ),
        ));
        
       
        
        
        
//         $this->add(array(
//             "name"=>"employeeDetails",
//             "type"=>"IMServices\Entity\EmployerLiabilityDetails"
//         ));
        
        $this->add(array(
            "name"=>"isPremiseLawful",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Is Premise Safe",
                'unchecked_value' => false,
                'checked_value' => true,
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"col-md-7 col-xs-12",
                "id"=>"isPremiseLawful",
                "checked"=>true
            ),
        ));
        
        $this->add(array(
            "name"=>"coverFromDate",
            "type"=>"date",
            "options"=>array(
                "label"=>"Cover Start From",
                
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-xs-12",
                "id"=>"cover_from_date",
                
            ),
        ));
        
        $this->add(array(
            "name"=>"coverToDate",
            "type"=>"date",
            "options"=>array(
                "label"=>"Cover Ends On",
                
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-xs-12",
                "id"=>"cover_to_date",
                
            ),
        ));
        
        $this->add(array(
            "name"=>"isLawsNRegulation",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Conforms With Laws",
                'unchecked_value' => false,
                'checked_value' => true,
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"col-md-7 col-xs-12",
                "id"=>"isLawsNRegulation",
                "checked"=>false
            ),
        ));
        
        
        $this->add(array(
            "name"=>"lawsNRegulation",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Laws and Regulations",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "id"=>"lawsNRegulation",
                "placeholder"=>"Copyright Law",
                
            ),
        ));
        
        $this->add(array(
            "name"=>"isSawNMachine",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Has Saw Machine",
                'unchecked_value' => false,
                'checked_value' => true,
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"col-md-7 col-xs-12",
                "id"=>"isPremiseLawful",
                "checked"=>true
            ),
        ));
        
        $this->add(array(
            "name"=>"isBoilersNpressureLifts",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Has Boilers",
                'unchecked_value' => false,
                'checked_value' => true,
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"col-md-7 col-xs-12",
                "id"=>"isBoilersNpressureLifts",
                "checked"=>true
            ),
        ));
        
        
        $this->add(array(
            "name"=>"isFencedProperly",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Is Fenced Properly",
                'unchecked_value' => false,
                'checked_value' => true,
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"col-md-7 col-xs-12",
                "id"=>"isFencedProperly",
                "checked"=>true
            ),
        ));
        
        
        
        $this->add(array(
            "name"=>"isRadioActiveProducts",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Has radio active products",
                'unchecked_value' => false,
                'checked_value' => true,
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"col-md-7 col-xs-12",
                "id"=>"isRadioActiveProducts",
                "checked"=>true
            ),
        ));
        
        
        
        $this->add(array(
            "name"=>"isAcidAndGasses",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Has Acid and Gasses",
                'unchecked_value' => false,
                'checked_value' => true,
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"col-md-7 col-xs-12",
                "id"=>"isAcidAndGasses",
                "checked"=>true
            ),
        ));
        
        
        
        $this->add(array(
            "name"=>"isAbestos",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Has Asbestoes",
                'unchecked_value' => false,
                'checked_value' => true,
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"col-md-7 col-xs-12",
                "id"=>"isAbestos",
                "checked"=>true
            ),
        ));
        
        
        $this->add(array(
            "name"=>"isPreviousInsure",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Has Previous Insurer",
                'unchecked_value' => false,
                'checked_value' => true,
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"col-md-7 col-xs-12",
                "id"=>"isPreviousInsure",
                "checked"=>true
            ),
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
           "previousInsurer"=>array(
               "required"=>FALSE,
               "allow_empty"=>TRUE,
           ),
           "isPreviousInsure"=>array(
               "required"=>FALSE,
               "allow_empty"=>TRUE,
           ),
           "isAbestos"=>array(
               "required"=>FALSE,
               "allow_empty"=>TRUE,
           ),
           "isAcidAndGasses"=>array(
               "required"=>FALSE,
               "allow_empty"=>TRUE,
           ),
           "isRadioActiveProducts"=>array(
               "required"=>FALSE,
               "allow_empty"=>TRUE,
           ),
           "isFencedProperly"=>array(
               "required"=>FALSE,
               "allow_empty"=>TRUE,
           ),
           "isBoilersNpressureLifts"=>array(
               "required"=>FALSE,
               "allow_empty"=>TRUE,
           ),
           "isSawNMachine"=>array(
               "required"=>FALSE,
               "allow_empty"=>TRUE,
           ),
           "isLawsNRegulation"=>array(
               "required"=>FALSE,
               "allow_empty"=>TRUE,
           ),
           "lawsNRegulation"=>array(
               "required"=>FALSE,
               "allow_empty"=>TRUE,
           ),
           
           "coverToDate"=>array(
               "required"=>FALSE,
               "allow_empty"=>TRUE,
           ),
           "coverFromDate"=>array(
               "required"=>FALSE,
               "allow_empty"=>TRUE,
           ),
           "isPremiseLawful"=>array(
               "required"=>FALSE,
               "allow_empty"=>TRUE,
           ),
           "isTakenInOtherCountries"=>array(
               "required"=>FALSE,
               "allow_empty"=>TRUE,
           ),
           "profession"=>array(
               "required"=>FALSE,
               "allow_empty"=>TRUE,
           ),
           "otherCountryDetails"=>array(
               "required"=>FALSE,
               "allow_empty"=>TRUE,
           ),
       );
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

