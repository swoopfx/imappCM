<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\OccupiersLiabilityFamilyMembers;

/**
 *
 * @author otaba
 *        
 */
class OccupiersLiabilityFamiliyFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new OccupiersLiabilityFamilyMembers());
        
        $this->add(array(
            "name"=>"fullNamef",
            "type"=>"text",
            "options"=>array(
                "label"=>"Full Name",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-6 col-sm-6 col-xs-12",
                "id" => "fullNamef",
                "placeholder" => "Olawale Kingibe"
            )
        ));
        
        
        $this->add(array(
            "name"=>"relationship",
            "type"=>"text",
            "options"=>array(
                "label"=>"Relationship",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-6 col-sm-6 col-xs-12",
                "id" => "relationship",
                "placeholder" => "Brother"
            )
        ));
        
        
        $this->add(array(
            "name"=>"dob",
            "type"=>"date",
            "options"=>array(
                "label"=>"Date of birth",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-6 col-sm-6 col-xs-12",
                "id" => "dab",
//                 "placeholder" => "Olawale Kingibe"
            )
        ));
        
        
        $this->add(array(
            "name"=>"sex",
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            "options"=>array(
                "label"=>"Full Name",
                "label_attributes" => array(
                    "class" => "control-label col-md-4 col-sm-4 col-xs-12"
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Sex',
                // 'empty_option' => '-- Select a Proposed Insurer --',
                'property' => 'sex'
            ),
            "attributes" => array(
                "class" => "form-control col-md-6 col-sm-6 col-xs-12",
                "id" => "sex",
//                 "placeholder" => "Olawale Kingibe"
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
        
        // TODO - Insert your code here
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

