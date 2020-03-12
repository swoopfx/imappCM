<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\BoilerCoverDetails;

/**
 *
 * @author otaba
 *        
 */
class BoilerCoverDetailsFeildset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new BoilerCoverDetails())->setHydrator($hydrator);
        
        $this->add(array(
            "name" => "itemDescription",
            "type" => "textarea",
            "options" => array(
                "label" => "Item Description",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "itemDescription",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "manuYear",
            "type" => "text",
            "options" => array(
                "label" => "Manufactured Year",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "manuYear",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name" => "replacementValue",
            "type" => "text",
            "options" => array(
                "label" => "Replacement Value",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "replacementValue",
                "class" => "form-control col-md-7 col-sm-7 col-xs-12"
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

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

