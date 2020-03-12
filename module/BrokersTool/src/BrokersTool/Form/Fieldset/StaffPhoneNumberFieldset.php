<?php
namespace BrokersTool\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use CsnUser\Entity\User;

/**
 *
 * @author otaba
 *        
 */
class StaffPhoneNumberFieldset extends Fieldset implements InputFilterProviderInterface
{
    private $entityManager;

    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new User())->setHydrator($hydrator);
        $this->addField();
    }
    
    private function addField(){
        $this->add(array(
            "name"=>"username",
            "type"=>"text",
            "options"=>array(
                "label"=>"New Phone Number",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"phone_number",
                "required"=>"required",
                "class"=>"form-control col-sm-9 col-md-9 col-xs-12"
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
        
        return array(
            "username"=>array(
                "required"=>true,
                "allow_empty"=>false
                // Validate form it being numbers
                // filter and trim away all non numbers 
            )
        );
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

