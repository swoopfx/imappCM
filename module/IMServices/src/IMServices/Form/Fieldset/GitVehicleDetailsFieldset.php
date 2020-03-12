<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\GITVehicleDetails;

/**
 *
 * @author otaba
 *        
 */
class GitVehicleDetailsFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new GITVehicleDetails());
        $this->addFieldset();
    }
    
    private function addFieldset(){
        $this->add(array(
            "name"=>"regNo",
            "type"=>"text",
            "options"=>array(
                "label"=>"Vehicle Reg. No.",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"regNo",
                "class"=>"form-control col-md-9 col-xs-12",
                "placeholder"=>"Vehicle Registration Number"
            ),
        ));
        
        $this->add(array(
            'name' => 'carMake',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Transport Medium',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'empty_option' => '--Select Car Make -- ',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\MotorType',
                'property' => 'motor'
            ),
            'attributes' => array(
                'id' => 'carMake',
                'class' => 'form-control col-md-9 col-xs-12',
//                 'multiple' => 'multiple'
                
            )
        ));
        
        $this->add(array(
            "name"=>"otherMake",
            "type"=>"text",
            "options"=>array(
                "label"=>"Other Car Make",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"otherMake",
                "class"=>"form-control col-md-9 col-xs-12",
                "placeholder"=>"Vehicle Make"
            ),
        ));
        
        $this->add(array(
            'name' => 'bodyType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Transport Medium',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'empty_option' => '--Select Body Type -- ',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\MotorTypeOfBody',
                'property' => 'motor'
            ),
            'attributes' => array(
                'id' => 'bodyType',
                'class' => 'form-control col-md-9 col-xs-12',
                //                 'multiple' => 'multiple'
                
            )
        ));
        $this->add(array(
            "name"=>"manuYear",
            "type"=>"text",
            "options"=>array(
                "label"=>"Manufactured Year",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"manuYear",
                "class"=>"form-control col-md-9 col-xs-12",
                "placeholder"=>"2009"
            ),
        ));
        
        $this->add(array(
            "name"=>"maxCapacity",
            "type"=>"text",
            "options"=>array(
                "label"=>"Maximum capacity",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"maxCapacity",
                "class"=>"form-control col-md-9 col-xs-12",
                "placeholder"=>"30000"
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

