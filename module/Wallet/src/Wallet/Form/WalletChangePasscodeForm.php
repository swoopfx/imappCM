<?php
namespace Wallet\Form;

use Zend\Form\Form;

class WalletChangePasscodeForm extends Form
{

    public function init()
    {
        $this->setAttributes(array(
            "method" => "POST",
            "class" => "form-horizontal form-label-left"
        ));

        $this->add(array(
            "name" => "walletChangePasscodeFieldset",
            "type" => "Wallet\Form\Fieldset\WalletChangePasscodeFieldset",
            "options" => array(
                "use_as_base_fieldset" => true
            )
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Submit',
                'class' => 'btn btn-xs btn-primary btn-block'
            )
        ));
    }
}

