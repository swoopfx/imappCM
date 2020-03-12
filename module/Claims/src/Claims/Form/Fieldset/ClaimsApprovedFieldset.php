<?php
namespace Claims\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Claims\Entity\ClaimsSettlement;

class ClaimsApprovedFieldset extends Fieldset implements InputFilterProviderInterface
{

   private $entityManager; 
    
    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new ClaimsSettlement());
        
        $this->add(array(
            "name"=>"amountApproved",
            "type"=>"text",
            "options"=>array(
                "label"=>"Approved Amount",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
                    
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "id"=>"amountApproved",
                "required"=>"required",
            )
        ));
        
        $this->add(array(
            "name"=>"dateApproved",
            "type"=>"date",
            "options"=>array(
                "label"=>"Date Approved",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
                    
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "id"=>"dateApproved",
                "value"=>date("Y-m-d"),
                "required"=>"required",
            )
        ));
        
        
        $this->add(array(
            "name"=>"information",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Approval Information",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
                    
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "id"=>"information",
//                 "required"=>"required",
            )
        ));
    }

    public function getInputFilterSpecification()
    {

        return array(
            "information"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            
            "dateApproved"=>array(
                "allow_empty"=>false,
                "required"=>TRUE
            ),
            
            "amountApproved"=>array(
                "allow_empty"=>false,
                "required"=>TRUE
            ),
        );
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

