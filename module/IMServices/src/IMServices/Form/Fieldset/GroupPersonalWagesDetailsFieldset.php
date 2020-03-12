<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\GroupPersonalWagesDetails;

/**
 *
 * @author otaba
 *        
 */
class GroupPersonalWagesDetailsFieldset extends Fieldset implements InputFilterProviderInterface
{
    private $entityManager;

    public function init(){
        
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new GroupPersonalWagesDetails())->setHydrator($hydrator);
        
        $this->add(array(
            "name"=>"name",
            "type"=>"text",
            "options"=>array(
                "label"=>"Persons Name",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control",
                "id"=>"name"
            ),
        ));
        
        $this->add(array(
            'name' => 'occupation',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Occupation Category',
                'label_attributes' => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\OccupationalCategory',
                // 'empty_option' => '-- Select a Proposed Insurer --',
                'property' => 'occupation'
                
            ),
            'attributes' => array(
                'id' => 'occupation',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            "name"=>"otherOccupation",
            "type"=>"text",
            "options"=>array(
                "label"=>"Other Category",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control",
                "id"=>"otherOccupation"
            ),
        ));
        
        $this->add(array(
            "name"=>"numberOfEmployee",
            "type"=>"text",
            "options"=>array(
                "label"=>"Number Of Employee",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control",
                "id"=>"numberOfEmployee"
            ),
        ));
        
        $this->add(array(
            "name"=>"grossAnnualSalary",
            "type"=>"text",
            "options"=>array(
                "label"=>"Gross Annual Salary",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control",
                "id"=>"grossAnnualSalary"
            ),
        ));
        
        $this->add(array(
            "name"=>"isDeath",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Death Cover",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"col-md-6",
                "id"=>"isDeath"
            ),
        ));
        
        $this->add(array(
            "name"=>"isLossOfLimbs",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Loss of Limbs Cover",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"col-md-6",
                "id"=>"isLossOfLimbs"
            ),
        ));
        
        $this->add(array(
            "name"=>"isLossOfEyes",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Loss of eyes cover",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"col-md-6",
                "id"=>"isLossOfEyes"
            ),
        ));
        
        
        $this->add(array(
            "name"=>"temporaryDisablementTotal",
            "type"=>"text",
            "options"=>array(
                "label"=>"Temporary Disablement Value",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-6",
                "id"=>"temporaryDisablementTotal"
            ),
        ));
        
        $this->add(array(
            "name"=>"permanentDisablement",
            "type"=>"text",
            "options"=>array(
                "label"=>"Permanent Disablement Value",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-6",
                "id"=>"permanentDisablement"
            ),
        ));
        
        $this->add(array(
            "name"=>"medicalExpenseLimit",
            "type"=>"text",
            "options"=>array(
                "label"=>"Medical Expense Limit",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"from-control col-md-6",
                "id"=>"medicalExpenseLimit"
            ),
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

