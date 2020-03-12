<?php
namespace Transactions\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class ManualPaymentForm extends Form
{

    public function init(){
        $this->setAttributes(array(
            "method"=>"POST",
            'class' => 'form-horizontal form-label-left'
        ));
        $this->addField();
    }
    
    private function addField(){
        $this->add(array(
            "name"=>"manualPaymentFieldset",
            "type"=>"Transactions\Form\Fieldset\ManualPaymentFieldset",
            "options"=>array(
                "use_as_base_fieldset"=>true
            ),
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'PROCESS PAYMENT',
                'class' => 'btn btn-primary btn-block btn-xs',
                
            )
        ));
    }
}

