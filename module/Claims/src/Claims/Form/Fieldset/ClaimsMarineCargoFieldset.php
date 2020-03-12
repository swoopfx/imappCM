<?php
namespace Claims\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Claims\Entity\ClaimsMarineCargo;

class ClaimsMarineCargoFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new ClaimsMarineCargo());

        $this->add(array(
            'name' => 'claims',
            'type' => 'Claims\Form\Fieldset\ClaimsFieldset'
        ));

        $this->add(array(
            "name" => "damageExtent",
            "type" => "textarea",
            "options" => array(
                "label" => "Damage Extent",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "damageExtent",
                "class" => "form-control col-md-8 col-sm-8 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "isThirdPartyInvoved",
            "type" => "checkbox",
            "options" => array(
                "label" => "Third party is Involved",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "isThirdPartyInvoved",
                "class" => "col-md-8 col-sm-8 col-xs-12"
            )
        ));
        
        
        $this->add(array(
            "name" => "thirdPartyinvolved",
            "type" => "text",
            "options" => array(
                "label" => "Details of third party involved",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "thirdPartyinvolved",
                "class" => "form-control col-md-8 col-sm-8 col-xs-12"
            )
        ));
        
        
        $this->add(array(
            "name" => "causeOfDamage",
            "type" => "text",
            "options" => array(
                "label" => "Cause of Damage",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "causeOfDamage",
                "class" => "form-control col-md-8 col-sm-8 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "dateOfLoss",
            "type" => "date",
            "options" => array(
                "label" => "Date of Loss/Damage",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "dateOfLoss",
                "class" => "form-control col-md-8 col-sm-8 col-xs-12"
            )
        ));
        
        
        $this->add(array(
            "name" => "clearingAgent",
            "type" => "textarea",
            "options" => array(
                "label" => "Clearing agent details",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "clearingAgent",
                "class" => "form-control col-md-8 col-sm-8 col-xs-12"
            )
        ));
        
        
        $this->add(array(
            "name" => "lossDescription",
            "type" => "textarea",
            "options" => array(
                "label" => "Description of loss",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "lossDescription",
                "class" => "form-control col-md-8 col-sm-8 col-xs-12"
            )
        ));
    }

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

