<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\MotorNonStandardAccesory;

/**
 *
 * @author otaba
 *        
 */
class MotorNonStandardAccesoryFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;

    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new MotorNonStandardAccesory());
        
        $this->add(array(
            "name"=>"accessoryName",
            "type"=>"text",
            "options"=>array(
                "label"=>"Accessory Name",
                "label_attributes"=>array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-xs-12",
                "id"=>"accessoryName"
            )
        ));
        
        
        $this->add(array(
            "name"=>"accessoryValue",
            "type"=>"text",
            "options"=>array(
                "label"=>"Accessory Value",
                "label_attributes"=>array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-xs-12",
                "id"=>"accessoryValue"
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
            "accessoryValue"=>array(
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

