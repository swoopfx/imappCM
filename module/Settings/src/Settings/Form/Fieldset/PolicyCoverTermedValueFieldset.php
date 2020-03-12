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
class PolicyCoverTermedValueFieldset extends Fieldset implements InputFilterProviderInterface
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
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-8 col-sm-8 col-xs-12",
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

