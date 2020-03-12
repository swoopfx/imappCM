<?php
namespace Claims\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Claims\Entity\CLaimsFireLoss;

class ClaimsFireLossFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new CLaimsFireLoss());

        $this->add(array(
            "name" => "fireDetails",
            "type" => "textarea",
            "options" => array(
                "label" => "Cause and Details of Fire",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "fireDetails"
            )
        ));

        $this->add(array(
            "name" => "fireDatetime",
            "type" => "date",
            "options" => array(
                "label" => "Date fire occured",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "fireDatetime"
            )
        ));

        $this->add(array(
            "name" => "estimatedLoss",
            "type" => "text",
            "options" => array(
                "label" => "Estimated Loss",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-7 col-sm-7 col-xs-12",
                "id" => "estimatedLoss"
            )
        ));

        $this->add(array(
            'name' => 'claims',
            'type' => 'Claims\Form\Fieldset\ClaimsFieldset'
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            "estimatedLoss" => array(
                "allow_empty" => TRUE,
                "required" => FALSE
            ),
            "fireDatetime" => array(
                "allow_empty" => TRUE,
                "required" => FALSE
            ),
            "fireDetails" => array(
                "allow_empty" => TRUE,
                "required" => FALSE
            )
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

