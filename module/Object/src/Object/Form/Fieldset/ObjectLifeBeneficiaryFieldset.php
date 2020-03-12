<?php
namespace Object\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Object\Entity\ObjectLifeBeneficiary;

class ObjectLifeBeneficiaryFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new ObjectLifeBeneficiary())->setHydrator($hydrator);

        $this->add(array(
            "name" => "beneficiaryName",
            "type" => "text",
            "options" => array(
                "label" => "Beneficiary Name",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "beneficiaryName",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));

        $this->add(array(
            "name" => "beneficiaryDob",
            "type" => "date",
            "options" => array(
                "label" => "Beneficiary Date of Birth",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "beneficiaryDob",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));

        $this->add(array(
            "name" => "relationship",
            "type" => "text",
            "options" => array(
                "label" => "Relationship with Beneficiary",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "relationship",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));

        $this->add(array(
            "name" => "occupation",
            "type" => "text",
            "options" => array(
                "label" => "Beneficiary Occuation",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "occupation",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));

        $this->add(array(
            "name" => "maritalStatus",
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Make of Motor',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\MaritalStatus',
                'property' => 'status',
                // 'empty_option' => '-- Select Motor Brand --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            "attributes"=>array(
                "id"=>"maritalStatus",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));

        $this->add(array(
            "name" => "address",
            "type" => "text",
            "options" => array(
                "label" => "Beneficiary Address",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "address",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name"=>"telephone",
            "type"=>"text",
            "options" => array(
                "label" => "Beneficiary Telephone",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "telephone",
                "class" => "form-control col-md-7 col-xs-12"
            )
        ));
    }

    public function getInputFilterSpecification()
    {

       return array();
       
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

