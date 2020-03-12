<?php
namespace Customer\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class CustomerPaymentForm extends Form
{

    public function init()
    {
        $this->setAttributes(array(
            "method" => "POST"
        
        ));
    }

    private function addField()
    {
        $this->add(array(
            "name" => "paymentFieldset",
            "type" => "Transactions\Form\Fieldset\UserCardPaymentFieldset",
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
    }
}

