<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\LiveStockFarmInsurance;

/**
 *
 * @author otaba
 *        
 */
class LivestockInsuredListFieldset extends Fieldset implements InputFilterProviderInterface
{
    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new LiveStockFarmInsurance())->setHydrator($hydrator);
        
        $this->add(array(
            "name"=>"animalId",
            "type"=>"text",
            "options"=>array(
                "label"=>"Animal Tag Id",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "class"=>"form-control",
                "id"=>"animalId",
            )
        ));
        
        $this->add(array(
            "name"=>"age",
            "type"=>"text",
            "options"=>array(
                "label"=>"Age",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "class"=>"form-control",
                "id"=>"age",
               
            )
        ));
        
        $this->add(array(
            "name"=>"marketValue",
            "type"=>"text",
            "options"=>array(
                "label"=>"Matured Market Value",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "class"=>"form-control",
                "id"=>"marketValue",
            )
        ));
        
        $this->add(array(
            'name' => 'sex',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Sex',
                'label_attributes' => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Sex',
                // 'empty_option' => '-- Select a Proposed Insurer --',
                'property' => 'sex'
                
            ),
            'attributes' => array(
                'id' => 'sex',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            "name"=>"breed",
            "type"=>"text",
            "options"=>array(
                "label"=>"Animal Breed",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "class"=>"form-control",
                "id"=>"breed",
                "placeholder"=>"Cattle, Muturu Muturu"
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
           "breed"=>array(
               "allow_empty"=>true,
               "required"=>false
           ),
            
            "sex"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
        );
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

