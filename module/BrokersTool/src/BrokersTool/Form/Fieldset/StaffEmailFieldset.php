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
class StaffEmailFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new User());
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            "name" => "email",
            "type" => "email",
            "options" => array(
                "label" => "New Email",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "user_email",
                "required" => "required",
                "class" => "form-control col-sm-9 col-md-9 col-xs-12"
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

