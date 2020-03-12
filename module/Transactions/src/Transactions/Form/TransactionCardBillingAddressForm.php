<?php
namespace Transactions\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class TransactionCardBillingAddressForm extends Form
{

    
    public function init(){
        $this->setAttributes(array(
            'method' => 'post',
            'class' => 'form-horizontal form-label-left'
        ));
        $this->addFeild();
    }
    
    private function addFeild(){
        $this->add(array(
            "name"=>"cardBillingFieldset",
            "type"=>"Transactions\Form\Fieldset\TransactionCardBillingAddress",
            "options"=>array(
                "use_as_base_fieldset"=>true
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'PROCESS PAYMENT',
                'class' => 'btn btn-primary btn-block btn-xs',
                'id' => 'pay-now'
            )
        ));
    }
}

