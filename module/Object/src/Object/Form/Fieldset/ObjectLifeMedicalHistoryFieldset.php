<?php
namespace Object\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Object\Entity\ObjectLifeMedicalHistroy;

class ObjectLifeMedicalHistoryFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;

    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        
        $this->setObject(new ObjectLifeMedicalHistroy())->setHydrator($hydrator);
        
        $this->add(array(
            "name"=>"ailment",
            "type"=>"text",
            "options"=>array(
                "label"=>"Ailment Name",
                "label_attributes"=>array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                    
                )
            ),
            "attributes"=>array(
                "id"=>"ailment",
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12"
                
            )
        ));
        
        
        $this->add(array(
            "name"=>"doctorName",
            "type"=>"text",
            "options"=>array(
                "label"=>"Doctor Name",
                "label_attributes"=>array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                    
                )
            ),
            "attributes"=>array(
                "id"=>"doctorName",
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12"
                
            )
        ));
        
        
        $this->add(array(
            "name"=>"doctorInfo",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Doctor Information",
                "label_attributes"=>array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                    
                )
            ),
            "attributes"=>array(
                "id"=>"doctorInfo",
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12"
                
            )
        ));
        
        $this->add(array(
            "name"=>"desccription",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Ailment Description",
                "label_attributes"=>array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                    
                )
            ),
            "attributes"=>array(
                "id"=>"description",
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12"
                
            )
        ));
    }

    public function getInputFilterSpecification()
    {

        return array();
    }
    
    public function setEntityManager($em) {
        $this->entityManager = $em;
        return $this;
    }
}

