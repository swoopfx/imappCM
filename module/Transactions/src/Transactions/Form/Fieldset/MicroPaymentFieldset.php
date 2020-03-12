<?php
namespace Transactions\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

/**
 *
 * @author otaba
 *        
 */
class MicroPaymentFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function init()
    {
        
        $this->add(array(
            "name" => "microPayment",
            "type" => 'DoctrineModule\Form\Element\ObjectSelect',
            "options" => array(
                'label' => 'Payment Period',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\MicroPaymentStructure',
                'property' => 'microText',
                
                'label_attributes' => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12' "
                )
            ),
            "attributes" => array(
                'required' => "required",
                "class" => "form-control col-md-8 col-sm-8 col-xs-12 ",
                // "style" => "width: 100%",
                "id" => "payment_period"
            
            )
        ));
        
//         $this->add(array(
//             'name' => 'submit',
//             'type' => 'Zend\Form\Element\Submit',
//             'attributes' => array(
//                 'type' => 'submit',
//                 'value' => 'GENERATE',
//                 'class' => 'btn btn-primary btn-block btn-xs',
//                 'id' => 'generate-micro'
//             )
//         ));
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
            "microPayment"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            )
        );
    }
    
    public  function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

