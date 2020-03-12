<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\LiveStockFarmInsurance;

/**
 *
 * @author otaba
 *        
 */
class LiveStockFarmInsuranceFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;
    
    

    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new LiveStockFarmInsurance())->setHydrator($hydrator);
        
        $this->addFields();
    }
    
    private function addFields(){
        $this->add(array(
            "name"=>"noOfLivestock",
            "type"=>"number",
            "options"=>array(
                "label"=>"Number Of Livestock",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"noOfLivestock",
                "class"=>"form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name"=>"isAllInsured",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"All Livestock is insured",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"isAllInsured",
                "class"=>"col-md-7 col-xs-12",
                "checked"=>true
            )
        ));
        
        $this->add(array(
            "name"=>"noOfInsuredAnimals",
            "type"=>"number",
            "options"=>array(
                "label"=>"Number Of Insured Livestock",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"noOfInsuredAnimals",
                "class"=>"form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name"=>"slauterAge",
            "type"=>"number",
            "options"=>array(
                "label"=>"Slaughter Age",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"slauterAge",
                "class"=>"form-control col-md-7 col-xs-12"
            )
        ));
        
        
        
        $this->add(array(
            'name' => 'useOfAnimals',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Use Of Animals',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'empty_option' => '--Select Animal Use -- ',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\FarmAnimalUse',
                'property' => 'use'
            ),
            'attributes' => array(
                'id' => 'useOfAnimals',
                'class' => 'form-control col-md-7 col-xs-12',
                'multiple' => 'multiple'
                
            )
        ));
        
        $this->add(array(
            'name' => 'rearingMethod',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Rearing Method',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'empty_option' => '--Select Rearing Method -- ',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\LiveStockRearingMethod',
                'property' => 'method'
            ),
            'attributes' => array(
                'id' => 'rearingMethod',
                'class' => 'form-control col-md-7 col-xs-12',
//                 'multiple' => 'multiple'
                
            )
        ));
        
        $this->add(array(
            "name"=>"otherMethod",
            "type"=>"text",
            "options"=>array(
                "label"=>"Other Method",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"otherMethod",
                "class"=>"form-control col-md-7 col-xs-12"
            )
        ));
        
        
        $this->add(array(
            "name"=>"feedingMethodandSource",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Feeding Method",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"feedingMethodandSource",
                "class"=>"form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "isVetinaryDoctor",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Vetinary Doctor",
//                 'use_hidden_element' => false,
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isVetinaryDoctor",
                
                
            )
        ));
        
        $this->add(array(
            "name"=>"vetName",
            "type"=>"text",
            "options"=>array(
                "label"=>"Doctors Name",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"vetName",
                "class"=>"form-control col-md-7 col-xs-12"
            )
        ));
        
        
        
        $this->add(array(
            "name"=>"vetQualification",
            "type"=>"text",
            "options"=>array(
                "label"=>"Doctors Qualification",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"vetQualification",
                "class"=>"form-control col-md-7 col-xs-12"
            )
        ));
        
        //vetYearResponsibleforFarm
        
        $this->add(array(
            "name"=>"vetYearResponsibleforFarm",
            "type"=>"text",
            "options"=>array(
                "label"=>"Responsible for Farm Since",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"vetYearResponsibleforFarm",
                "class"=>"form-control col-md-7 col-xs-12"
            )
        ));
        
        
        $this->add(array(
            "name"=>"vetContactDetails",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Doctor Contact",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"vetContactDetails",
                "class"=>"form-control col-md-7 col-xs-12",
                "placeholder"=>"Phone Number, Email"
            )
        ));
        
        //
        
        $this->add(array(
            "name"=>"vacinnation",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Vacinnation Recommended",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"vacinnation",
                "class"=>"form-control col-md-7 col-xs-12"
            )
        ));
        
        //mortalityRate
        
//         $this->add(array(
//             "name"=>"mortalityRate",
//             "type"=>"text",
//             "options"=>array(
//                 "label"=>"Vacinnation Recommended",
//                 "label_attributes"=>array(
//                     "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes"=>array(
//                 "id"=>"mortalityRate",
//                 "class"=>"form-control col-md-7 col-xs-12"
//             )
//         ));

        
        $this->add(array(
            "name" => "isAnimalInGoodCondition",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Animals In Good Conditions",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isAnimalInGoodCondition",
                "value"=>true
            )
        ));
        
        $this->add(array(
            "name"=>"conditionStatus",
            "type"=>"text",
            "options"=>array(
                "label"=>"Condition Status",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"conditionStatus",
                "class"=>"form-control col-md-7 col-xs-12"
            )
        ));
        
        
        $this->add(array(
            "name"=>"mortalityRate",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Livestock Mortality rate",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"mortalityRate",
                "class"=>"form-control col-md-7 col-xs-12"
            )
        ));
        
        
        $this->add(array(
            "name"=>"lossHistory",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Livestock Loss History",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"lossHistory",
                "class"=>"form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "isOtherInsurer",
            "type" => "checkbox",
            "options" => array(
                "label" => "Other Insurer Involced in the Farm",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isOtherInsurer",
//                 "checked" => false
            )
        ));
        
        $this->add(array(
            'name' => 'otherInsurer',
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
                'id' => 'otherInsurer',
                'class' => 'form-control col-md-7 col-xs-12'
                // 'disabled' => 'disabled',
                // 'placeholder' => 'Unsaved'
            )
        ));
        
        $this->add(array(
            'name' => 'otherInsurance',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Other Insurance',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                // 'empty_option' => 'Unsaved',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\InsuranceServiceType',
                'property' => 'insuranceService',
//                 'is_method' => true,
//                 'find_method' => array(
//                     'name' => 'findActiveInsurer'
                    
//                 )
            ),
            'attributes' => array(
                'id' => 'otherInsurance',
                'class' => 'form-control col-md-7 col-xs-12'
                // 'disabled' => 'disabled',
                // 'placeholder' => 'Unsaved'
            )
        ));
        
        $this->add(array(
            "name" => "isSubsidizedInsurance",
            "type" => "checkbox",
            "options" => array(
                "label" => "Has Gorvernment Subsidized Insurance",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isSubsidizedInsurance",
//                 "checked" => false
            )
        ));
        
        $this->add(array(
            "name"=>"subsidizedInsurance",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Subsidized Insurance Service",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"subsidizedInsurance",
                "class"=>"form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "isSubsidizedInfectedAnimals",
            "type" => "checkbox",
            "options" => array(
                "label" => "Other Insurer Involced in the Farm",
//                 'unchecked_value' => false,
//                 'checked_value' => true,
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "col-md-7 col-xs-12",
                "id" => "isSubsidizedInfectedAnimals",
//                 "checked" => false
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
            "lossHistory"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            
            "mortalityRate"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            
            "slauterAge"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            
            "noOfLivestock"=>array(
                "allow_empty"=>true,
                "required"=>false
            
            ),
            
            "noOfInsuredAnimals"=>array(
                "allow_empty"=>true,
                "required"=>false
                
            ),
            
            "rearingMethod"=>array(
                "allow_empty"=>true,
                "required"=>false
                
            ),
            
            "useOfAnimals"=>array(
                "allow_empty"=>true,
                "required"=>false
                
            ),
            
            "isVetinaryDoctor"=>array(
                "allow_empty"=>true,
                "required"=>false
                
            ),
            
            "isOtherInsurer"=>array(
                "allow_empty"=>true,
                "required"=>false
                
            ),
            
            "isSubsidizedInsurance"=>array(
                "allow_empty"=>true,
                "required"=>false
                
            ),
            
            "isSubsidizedInfectedAnimals"=>array(
                "allow_empty"=>true,
                "required"=>false
                
            ),
            
            "feedingMethodandSource"=>array(
                "allow_empty"=>true,
                "required"=>false
                
            ),
            "useOfAnimals"=>array(
                "allow_empty"=>true,
                "required"=>false
                
            ),
            "noOfLivestock"=>array(
                "allow_empty"=>true,
                "required"=>false
                
            ),
            "noOfInsuredAnimals"=>array(
                "allow_empty"=>true,
                "required"=>false
                
            ),
            "rearingMethod"=>array(
                "allow_empty"=>true,
                "required"=>false
                
            ),
            "otherMethod"=>array(
                "allow_empty"=>true,
                "required"=>false
                
            ),
            "feedingMethodandSource"=>array(
                "allow_empty"=>true,
                "required"=>false
                
            ),
            "isVetinaryDoctor"=>array(
                "allow_empty"=>true,
                "required"=>false
                
            ),
            "vetName"=>array(
                "allow_empty"=>true,
                "required"=>false
                
            ),
            "vetQualification"=>array(
                "allow_empty"=>true,
                "required"=>false
                
            ),
            "vetYearResponsibleforFarm"=>array(
                "allow_empty"=>true,
                "required"=>false
                
            ),
            "vetContactDetails"=>array(
                "allow_empty"=>true,
                "required"=>false
                
            ),
            "vacinnation"=>array(
                "allow_empty"=>true,
                "required"=>false
                
            ),
            "isAnimalInGoodCondition"=>array(
                "allow_empty"=>true,
                "required"=>false
                
            ),
            "isAllInsured"=>array(
                "allow_empty"=>true,
                "required"=>false
                
            ),
            "conditionStatus"=>array(
                "allow_empty"=>true,
                "required"=>false
                
            ),
            "isOtherInsurer"=>array(
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

