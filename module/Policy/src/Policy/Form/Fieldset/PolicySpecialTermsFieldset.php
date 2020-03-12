<?php
namespace Policy\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Policy\Entity\Policy;

class PolicySpecialTermsFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;
    
    
    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new Policy());
        
        $this->add(array(
            "name"=>"specialTerms",
            "type"=>"textarea",
            "options"=>array(
                "label"=>"Special Terms",
                'label_attributes' => array(
                    'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
                ),
            ),
            "attributes"=>array(
                "class" => "form-control col-md-8 col-sm-8 col-xs-12 ",
                "required" => "required",
                // 'multiple' => 'multiple',
                'id' => "specialTerms"
            )
        ));
    }

    public function getInputFilterSpecification()
    {

       return array();
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em ;
        return $this;
    }
    
    
}

