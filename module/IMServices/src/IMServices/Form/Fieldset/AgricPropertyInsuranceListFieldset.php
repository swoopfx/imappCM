<?php
namespace IMServices\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\ModuleManager\Feature\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\AgricPropertyInsuranceList;

/**
 *
 * @author otaba
 *        
 */
class AgricPropertyInsuranceListFieldset extends Fieldset implements InputFilterProviderInterface
{
    private $entityManager;

    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new AgricPropertyInsuranceList())->setHydrator($hydrator);
        
        $this->add(array(
            "name"=>"propertyName",
            "type"=>"text",
            "options"=>array(
                "label"=>"Property Name",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"propertyName",
                "class"=>"form-control col-md-7 col-xs-12"
            ),
        ));
        
        $this->add(array(
            "name"=>"value",
            "type"=>"text",
            "options"=>array(
                "label"=>"Property Value",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"value",
                "class"=>"form-control col-md-7 col-xs-12"
            ),
        ));
        
        
        $this->add(array(
            "name"=>"desc",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Property Description",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"desc",
                "class"=>"form-control col-md-7 col-xs-12"
            ),
        ));
        
        //desc
    }
    
    
    /**
     * {@inheritDoc}
     * @see \Zend\ModuleManager\Feature\InputFilterProviderInterface::getInputFilterConfig()
     */
    public function getInputFilterConfig()
    {
        return array();
        
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }

}

