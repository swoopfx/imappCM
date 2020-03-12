<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\GroupLife;

/**
 *
 * @author otaba
 *        
 */
class GroupLifeFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new GroupLife());
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            "name" => "isCustomPackage",
            "type" => "checkbox",
            "options" => array(
                "label" => "Is Custom Package",
                
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isCustomPackage",
                "class" => "col-md-7 col-xs-12",
                "checked" => false
                // "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name" => "packagetType",
            "type" => "text",
            "options" => array(
                "label" => "Custom Package Name",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "packagetType",
                "class" => " form-control col-md-7 col-xs-12"
                // 'checked' => false
            )
        ));
        
        //
        
        $this->add(array(
            'name' => 'memberClass',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Member Class',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                // 'empty_option' => '--Member Class -- ',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\GroupLifeMemberClass',
                'property' => 'class'
            ),
            'attributes' => array(
                'id' => 'memberClass',
                "value" => 2,
                'class' => 'form-control col-md-7 col-xs-12'
            
            )
        ));
        
        $this->add(array(
            "name" => "otherClass",
            "type" => "text",
            "options" => array(
                "label" => "Other Class",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "otherClass",
                "class" => " form-control col-md-7 col-xs-12",
                "placeholder" => "if applicable"
            )
        ));
        
        // $this->add(array(
        // "name" => "annualEmolument",
        // "type" => "text",
        // "options" => array(
        // "label" => "Annual Emolument",
        // "label_attributes" => array(
        // "class" => "control-label col-md-3 col-sm-3 col-xs-12"
        // )
        // ),
        // "attributes" => array(
        // "id" => "annualEmolument",
        // "class" => "form-control col-md-7 col-xs-12"
        // // 'checked' => false
        // )
        // ));
        
        // $this->add(array(
        // "name" => "lifeAssuranceBenefit",
        // "type" => "text",
        // "options" => array(
        // "label" => "Life Assurance Benefit",
        // "label_attributes" => array(
        // "class" => "control-label col-md-3 col-sm-3 col-xs-12"
        // )
        // ),
        // "attributes" => array(
        // "id" => "lifeAssuranceBenefit",
        // "class" => "form-control col-md-7 col-xs-12"
        // // 'checked' => false
        // )
        // ));
        
        $this->add(array(
            "name" => "startDate",
            "type" => "date",
            "options" => array(
                "label" => "Start Date",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "startDate",
                "class" => "form-control col-md-7 col-xs-12"
                // 'checked' => false
            )
        ));
        
        $this->add(array(
            "name" => "retirementAge",
            "type" => "number",
            "options" => array(
                "label" => "Retirement Age",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "retirementAge",
                "class" => "form-control col-md-7 col-xs-12"
                // 'checked' => false
            )
        ));
        
        $this->add(array(
            "name" => "isPreviousinsurer",
            "type" => "checkbox",
            "options" => array(
                "label" => "Previously Insured",
                
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isPreviousinsurer",
                "class" => "col-md-7 col-xs-12",
                "checked" => false
                // "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name" => "isPreviousClaims",
            "type" => "checkbox",
            "options" => array(
                "label" => "Previously had claims",
                
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isPreviousClaims",
                "class" => "col-md-7 col-xs-12",
                "checked" => false
                // "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name" => "previousClaims",
            "type" => "textarea",
            "options" => array(
                "label" => "Previous Claims Details",
                
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "previousClaims",
                "class" => "col-md-7 col-xs-12"
                // "checked" => false
                // "required"=>"required"
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
            "previousClaims" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isPreviousClaims" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isPreviousinsurer" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "retirementAge" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "startDate" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "memberClass" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "otherClass" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "packagetType" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "isCustomPackage" => array(
                "allow_empty" => true,
                "required" => false
            )
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

