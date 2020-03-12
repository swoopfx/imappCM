<?php
namespace Policy\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Policy\Entity\CoverNote;

class PolicyPremiumPayableFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;
    

    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new CoverNote());
        
        
        $this->add(array(
            "name"=>"premiumPayable",
            "type"=>"text",
            "options"=>array(
                "label"=>"Premium Payable",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"premiumPayable",
                "class"=>"form-control col-md-8 col-sm-8 col-xs-12 ",
                "required"=>"required",
                
            )
        ));
        
        $this->add(array(
            "name"=>"premiumChangeReason",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Reason for Change",
                "label_attributes"=>array(
                    "class"=>"ontrol-label col-md-4 col-sm-4 col-xs-12",
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-8 col-sm-8 col-xs-12",
                "id"=>"premiumChangeReason",
                "required"=>"required",
            )
        ));
        
    }
    public function getInputFilterSpecification()
    {
        return array(
            "premiumPayable"=>array(
                "required"=>true,
                "allow_empty"=>false
            ),
            "premiumChangeReason"=>array(
                "required"=>true,
                "allow_empty"=>false
            ),
        );
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }

}

