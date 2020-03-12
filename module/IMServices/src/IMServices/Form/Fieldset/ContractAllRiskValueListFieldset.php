<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\ContractAllRiskValueList;

/**
 *
 * @author otaba
 *        
 */
class ContractAllRiskValueListFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new ContractAllRiskValueList());
        $this->addField();
    }

    private function addField()
    {
        $this->add(array(
            "name" => "valueName",
            "type" => "text",
            "options" => array(
                "label" => "Item Insured",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "valueName",
                "class" => "form-control col-md-9 col-xs-12"
            )
        
        ));
        
        $this->add(array(
            "name" => "value",
            "type" => "text",
            "options" => array(
                "label" => "Item Value",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "value",
                "class" => "form-control col-md-9 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "currency",
            "type" => "DoctrineModule\Form\Element\ObjectSelect",
            "options" => array(
                "label" => "Type Of Packaging",
                'object_manager' => $this->entityManager,
                // "empty_options" => "-- Select A Package Type--",
                'target_class' => 'Settings\Entity\Currency',
                'property' => 'code',
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "currency",
                "class" => "form-control col-md-9 col-sm-9 col-xs-12",
                "required" => "required"
            
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
        return array();
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        
        return $this;
    }
}

