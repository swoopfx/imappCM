<?php
namespace Users\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Users\Entity\BrokerCeo;

/**
 *
 * @author otaba
 *        
 */
class BrokerCeoFieldset extends Fieldset implements InputFilterProviderInterface
{
    private $entityManager;
    
    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new BrokerCeo());
        $this->addFields();
    }
    
    private function addFields(){
        $this->add(array(
            "name"=>"firstname",
            "type"=>"text",
            "options"=>array(
                "label"=>"First Name",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-8 col-sm-8 col-xs-12",
                "placeholder"=>"Olumofin",
                "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name"=>"lastname",
            "type"=>"text",
            "options"=>array(
                "label"=>"Last Name",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-8 col-sm-8 col-xs-12",
                "placeholder"=>"Ajanaku",
                "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name"=>"email",
            "type"=>"email",
            "options"=>array(
                "label"=>"CEO email",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-8 col-sm-8 col-xs-12",
                "placeholder"=>"abc@123.com",
                "required"=>"required"
            )
        ));
        
        $this->add(array(
            "name"=>"phone",
            "type"=>"text",
            "options"=>array(
                "label"=>"CEO phone",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-8 col-sm-8 col-xs-12",
                "placeholder"=>"07012345678",
            )
        ));
        
        $this->add(array(
            "name"=>"linkedIn",
            "type"=>"text",
            "options"=>array(
                "label"=>"Linkedin link",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-8 col-sm-8 col-xs-12 url",
                "placeholder"=>"https://linkenln.com/xyz",
//                 "required"=>false
            )
        ));
        
        $this->add(array(
            "name"=>"facebook",
            "type"=>"text",
            "options"=>array(
                "label"=>"Facebook",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-8 col-sm-8 col-xs-12",
                "placeholder"=>"https://facebook.com/xyz",
//                 "required"=>false
            )
        ));
        
        $this->add(array(
            "name"=>"tweeter",
            "type"=>"text",
            "options"=>array(
                "label"=>"Twitter Acc.",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-8 col-sm-8 col-xs-12",
                "placeholder"=>"https://twitter.com/xyz",
//                 "required"=>false
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
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

