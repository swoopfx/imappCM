<?php
namespace Claims\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Claims\Entity\ClaimsDefault;

/**
 *
 * @author otaba
 *        
 */
class ClaimsDefaultFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;
    

    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new ClaimsDefault())->setHydrator($hydrator);
        
        $this->add(array(
            'name'=>'claims',
            'type'=>'Claims\Form\Fieldset\ClaimsFieldset',
           
        ));
        
//         $this->add(array(
//             "name"=>"claimsDetails",
//             "type"=>"textarea",
//             "options"=>array(
//                 "label"=>"Claims Details",
//                 "label_attributes"=>array(
//                     "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes"=>array(
//                 "id"=>"claimsDetails",
//                 "class"=>"form-control col-xs-12",
//                 "placeholder"=>"Provide usable and detailed information about the incident"
//             )
//         ));
        
        $this->add(array(
            "name"=>"estimatedClaims",
            "type"=>"text",
            "options"=>array(
                "label"=>"Estimated Claims Value",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"estimatedClaims",
                "class"=>"form-control col-xs-12",
                "placeholder"=>"3000,000.00",
//                 "col"=>100
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
            "estimatedClaims"=>array(
                "allow_empty"=>true,
                "required"=>false
            )
        );
    }
    /**
     * @param object $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

}

