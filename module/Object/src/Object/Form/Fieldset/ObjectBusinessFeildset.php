<?php
namespace Object\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Object\Entity\ObjectBusiness;

/**
 *
 * @author otaba
 *        
 */
class ObjectBusinessFeildset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new ObjectBusiness());
        $this->addFields();
        
    }

    private function addFields()
    {
        $this->add(array(
            "name" => "businessName",
            "type" => "text",
            "options" => array(
                "label" => "Name Of Company",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-9 col-xs-12",
                "placeholder" => "Boris Nigeria Limited"
            )
        ));
        
        $this->add(array(
            "name" => "businessDesc",
            "type" => "textarea",
            "options" => array(
                "label" => "Describe the Business",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-9 col-xs-12",
                "placeholder" => ""
            )
        ));
        
        $this->add(array(
            "name" => "businessRegNo",
            "type" => "text",
            "options" => array(
                "label" => "CAC Registeration No.",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-9 col-xs-12",
                "placeholder" => "RC 1234567"
            )
        ));
        
        $this->add(array(
            "name" => "businessAddress",
            "type" => "textarea",
            "options" => array(
                "label" => "Business Address",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-9 col-xs-12",
                "placeholder" => " 123 Waliu Fuja"
            )
        ));
        
        $this->add(array(
            "name"=>"businessCategory",
            "type"=>"DoctrineModule\Form\Element\ObjectSelect",
            'options'=>array(
                "label"=>"Business Category",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\OccupationalCategory',
                'property' => 'occupation',
                'empty_option' => '-- Category of Business Category --',
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-9 col-xs-12",
                "multiple"=>true,
                "data-toggle"=>"select2",
                "data-placeholder"=>"Select a Business Category ..",
                "data-allow-clear"=>true
                
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

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

