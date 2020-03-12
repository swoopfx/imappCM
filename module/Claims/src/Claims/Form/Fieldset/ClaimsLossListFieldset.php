<?php
namespace Claims\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Claims\Entity\ClaimLossList;

/**
 *
 * @author otaba
 *        
 */
class ClaimsLossListFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new ClaimLossList())->setHydrator($hydrator);
        
        $this->add(array(
            "name"=>"lossName",
            "type"=>"text",
            "options"=>array(
                "label"=>"Loss Name",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-xs-12",
                "id"=>"lossName",
                "placeholder"=>"Vehicle part"
            )
        ));
        
        $this->add(array(
            "name"=>"description",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Loss Description",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-xs-12",
                "id"=>"description",
//                 "placeholder"=>"Vehicle part"
            )
        ));
        
        $this->add(array(
            "name"=>"lossValue",
            "type"=>"text",
            "options"=>array(
                "label"=>"Loss Value",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-xs-12",
                "id"=>"lossValue",
                //                 "placeholder"=>"Vehicle part"
            )
        ));
        
        $this->add(array(
            "name"=>"salvage",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Salvaged Content/Value",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-xs-12",
                "id"=>"salvage",
                //                 "placeholder"=>"Vehicle part"
            )
        ));
        
        $this->add(array(
            "name"=>"amountClaimed",
            "type"=>"text",
            "options"=>array(
                "label"=>"Claim Value",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-xs-12",
                "id"=>"amountClaimed",
                //                 "placeholder"=>"Vehicle part"
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
            'amountClaimed'=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            'salvage'=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "lossValue"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "description"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "lossName"=>array(
                "alow_empty"=>true,
                "required"=>false
            )
        );
    }
    /**
     * @param object $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
    }

}

