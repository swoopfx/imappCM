<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\CropAgricStaffDetails;

/**
 *
 * @author otaba
 *        
 */
class CropInsuranceStafffDetailsFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new CropAgricStaffDetails())->setHydrator($hydrator);
        
        $this->add(array(
            "name"=>"post",
            "type"=>"text",
            "options"=>array(
                "label"=>"Staff Post",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"post",
                "class"=>"form-control",
                "placeholder"=>"Farm Keeper"
            )
        ));
        
        $this->add(array(
            "name"=>"name",
            "type"=>"text",
            "options"=>array(
                "label"=>"Staff Name",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"name",
                "class"=>"form-control",
                "placeholder"=>"Umar Kilani"
            )
        ));
        
        $this->add(array(
            "name"=>"qualification",
            "type"=>"text",
            "options"=>array(
                "label"=>"Staff Qualification",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"name",
                "class"=>"form-control",
                "placeholder"=>"Bsc. Agriculture"
            )
        ));
        
        
        $this->add(array(
            "name"=>"yearsInService",
            "type"=>"number",
            "options"=>array(
                "label"=>"Years In Service",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"name",
                "class"=>"form-control",
                "placeholder"=>"2",
                'value'=>1,
                "step"=>1,
                "min"=>0
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

