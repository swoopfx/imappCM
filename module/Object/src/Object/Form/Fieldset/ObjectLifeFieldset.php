<?php
namespace Object\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Object\Entity\ObjectLife;

class ObjectLifeFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;

    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new ObjectLife())->setHydrator($hydrator);
        
        $this->add(array(
            "name"=>"title",
            "type"=>"DoctrineModule\Form\Element\ObjectSelect",
            "options"=>array(
                "label"=>"Title",
                "label_attributes"=>array(
                    "class"=>'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\MotorType',
                'property' => 'motor',
//                 'empty_option' => '-- Select Motor Brand --',
            ),
            "attributes"=>array(
                "id"=>"title",
                'class' => 'form-control col-md-6 col-sm-6 col-xs-12'
            )
        ));
        
        $this->add(array(
            "name"=>"lastName",
            "type"=>"text",
            "options"=>array(
                "label"=>"Last Name",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"lastName",
                "class"=>"form-control col-md-6 col-sm-6 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name"=>"firstName",
            "type"=>"text",
            "options"=>array(
                "label"=>"First Name",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"firstName",
                "class"=>"form-control col-md-6 col-sm-6 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name"=>"middleName",
            "type"=>"text",
            "options"=>array(
                "label"=>"Middle Name",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"middleName",
                "class"=>"form-control col-md-6 col-sm-6 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name"=>"isMarried",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Is Married",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"isMarried",
                "class"=>"form-control col-md-6 col-sm-6 col-xs-12"
            )
        ));
        
        
        $this->add(array(
            "name"=>"maidenName",
            "type"=>"text",
            "options"=>array(
                "label"=>"Maiden Name",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"maidenName",
                "class"=>"form-control col-md-6 col-sm-6 col-xs-12"
            )
        ));
        
        
        $this->add(array(
            "name"=>"dob",
            "type"=>"date",
            "options"=>array(
                "label"=>"Date of Birth",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"dob",
                "class"=>"form-control col-md-6 col-sm-6 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name"=>"isNigerian",
            "type"=>"checkbox",
            "options"=>array(
                "label"=>"Is Nigeria",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"isNigerian",
                "checked"=>true,
                "class"=>"form-control col-md-6 col-sm-6 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name"=>"bvn",
            "type"=>"text",
            "options"=>array(
                "label"=>"BVN",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"bvn",
                "class"=>"form-control col-md-6 col-sm-6 col-xs-12"
            )
        ));
        
        
        $this->add(array(
            "name"=>"telephoneNumber",
            "type"=>"text",
            "options"=>array(
                "label"=>"Telephone Number",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"telephoneNumber",
                "class"=>"form-control col-md-6 col-sm-6 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name"=>"address",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Address",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"address",
                "class"=>"form-control col-md-6 col-sm-6 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name"=>"communicationMethod",
            "type"=>"text",
            "options"=>array(
                "label"=>"Prefered Communication Method",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"communicationMethod",
                "placeholder"=>"email, Phone, fax",
                "class"=>"form-control col-md-6 col-sm-6 col-xs-12"
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

