<?php
namespace Transactions\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class BrokerFlutterwaveForm extends Form
{

    public function init()
    {
        $this->setAttributes(array(
            'action' => '',
            'method' => 'post',
            'class' => 'form-horizontal form-label-left'
        ));
        $this->addFeild();
        $this->addCommon();
    }

    private function addFeild()
    {
        $this->add(array(
            'name' => 'brokerFlutterwaveFieldset',
            'type' => 'Transactions\Form\Fieldset\BrokerFlutterwaveAccountFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
    }

    private function addCommon()
    {
        // $this->add(array(
        // 'name' => 'csrf',
        // 'type' => 'Zend\Form\Element\Csrf',
        // 'options' => array(
        // // 'csrf_options' => array(
        // // 'timeout' => 600
        // // )
        // )
        // ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'CREATE ACCOUNT',
                'class' => 'btn btn-success col-md-offset-6',
                'id' => 'pay-now',
                'style'=>"width: 100%"
            )
        ));
    }
}

