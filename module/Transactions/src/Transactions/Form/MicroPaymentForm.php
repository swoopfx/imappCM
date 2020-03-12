<?php
namespace Transactions\Form;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class MicroPaymentForm extends Form implements InputFilterProviderInterface
{
    
    private $entityManager;

   
    
    public function init(){
        $this->setAttributes(array(
            "method"=>"POST",
            "class"=>"form-horizontal form-label-left",
            "data-ng-app"=>""
        ));
        $this->addFields();
    }
    
    private function addFields(){
        $this->add(array(
            "name" => "microPayment",
            "type" => 'DoctrineModule\Form\Element\ObjectSelect',
            "options" => array(
                'label' => 'Select Split Duration',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\MicroPaymentStructure',
                'property' => 'microText',
                
                'label_attributes' => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12' "
                )
            ),
            "attributes" => array(
                'required' => "required",
                "class"=>"form-control col-md-8 col-sm-8 col-xs-12 ",
                "style"=>"width: 100%",
                'data-ng-model' => 'microPayment',
                "data-ng-click"=>"microPaymentClick(microPayment)"
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'VIEW',
                'class' => 'btn btn-primary btn-block btn-xs',
                'id' => 'pay-now'
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
        return array();
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

