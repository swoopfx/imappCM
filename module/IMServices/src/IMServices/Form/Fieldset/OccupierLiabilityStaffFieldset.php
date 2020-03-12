<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\OccupiersLiabilityDomesticStaff;

/**
 *
 * @author otaba
 *        
 */
class OccupierLiabilityStaffFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    // private
    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new OccupiersLiabilityDomesticStaff());
        
        $this->add(array(
            "name"=>"fullName",
            "type"=>"text",
            "options"=>array(
                "label"=>"Staff Full Name",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
                
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-xs-12",
                "id"=>"fullName"
            )
        ));
        
        $this->add(array(
            "name"=>"natureOfWork",
            "type"=>"text",
            "options"=>array(
                "label"=>"Nature of work",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
                
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-xs-12",
                "id"=>"natureOfWork"
            )
        ));
        
        $this->add(array(
            "name"=>"employmentDuration",
            "type"=>"text",
            "options"=>array(
                "label"=>"Employment Duration",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
                
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-xs-12",
                "id"=>"employmentDuration"
            )
        ));
        
        $this->add(array(
            "name"=>"wages",
            "type"=>"text",
            "options"=>array(
                "label"=>"Total Annual Wages",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
                
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-xs-12",
                "id"=>"wages"
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
    /**
     * @return the $entityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @param field_type $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

    
    
}

