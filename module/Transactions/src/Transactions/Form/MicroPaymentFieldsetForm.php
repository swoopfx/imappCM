<?php
namespace Transactions\Form;

use Zend\Form\Form;

/**
 * This class calls a micropayment fieldset compared to the alternative MicroPaymentForm 
 * 
 * @author otaba
 *        
 */
class MicroPaymentFieldsetForm extends Form
{

    
    
    public function init(){
        
    }
    
    private function addField(){
        $this->add(array(
            "name"=>"microPAymentFieldset",
            "type"=>"Transactions\Form\Fieldset\MicroPaymentFieldset",
            "options"=>array(
                "use_as_base_fieldset"=>true
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'GENERATE',
                'class' => 'btn btn-primary btn-block btn-xs',
                'id' => 'generate-micro'
            )
        ));
    }
}

