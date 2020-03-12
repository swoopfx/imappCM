<?php
namespace Transactions\Form;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class TransactionInvoiceProcessManualPaymentForm extends Form implements InputFilterProviderInterface
{

    public function init()
    {
        $this->setAttributes(array(
            "method" => "POST",
            "action"=>"dash",
            'class' => 'form-horizontal form-label-left'
        ));
       
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            "name" => "processCondition",
            "type" => "radio",
            'options' => array(
                "label" => "Process Condition",
                "label_attributes" => array(
                    "class" => "control-label "
                ),
                'value_options' => array(
                    '0' => 'Confirm Payment',
                    '1' => 'Reject Payment'
                )
            ),
            "attributes" => array(
                "class" => "",
                "checked" => 0,
                "required" => "required",
                "id"=>"optionsRadios2",
                //"name"=>"optionsRadios"
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'PROCESS PAYMENTS',
                'class' => 'btn btn-lg btn-primary bth-sm btn-block',
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
}

