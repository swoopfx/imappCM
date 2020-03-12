<?php
namespace Settings\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Settings\Entity\PolicyCoverTermedValue;

/**
 *
 * @author otaba
 *        
 */
class GeneralPolicyCoverTermedValueFieldset extends Fieldset implements InputFilterProviderInterface
{

     private $entityManager;

    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new PolicyCoverTermedValue());
        $this->addField();
    }
    
    private function addField(){
        $this->add(array(
            "name"=>"value",
            "type"=>"text",
            "options"=>array(
                "label"=>"Termed Value",
                "label_attributes"=>array(
                    "class"=>"control-label"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control",
                "id"=>""
                
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
        
        return array();
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

