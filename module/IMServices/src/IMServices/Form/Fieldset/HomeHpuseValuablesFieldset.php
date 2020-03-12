<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\HouseValuables;

/**
 *
 * @author otaba
 *        
 */
class HomeHpuseValuablesFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;
    
    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new HouseValuables());
        
        $this->add(array(
            "name"=>"name",
            "type"=>"text",
            "options"=>array(
                "label"=>"Name of Valuable",
                "label_attributes"=>array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"name",
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "placeholder"=>"1kg 24 carrat gold"
            )
        ));
        
        
        $this->add(array(
            "name"=>"cost",
            "type"=>"text",
            "options"=>array(
                "label"=>"Price of Valuable",
                "label_attributes"=>array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"cost",
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "placeholder"=>"200000"
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

