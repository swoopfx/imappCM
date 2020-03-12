<?php
namespace Settings\Form;

use Zend\Form\Form;

/**
 *
 * @author swoopfx
 *        
 */
class RenewAccountForm extends Form
{
    // TODO - Insert your code here
    public function init()
    {
        $this->setAttributes(array(
            'method'=>'POST',
            'action'=>'',
            'class' => 'form-horizontal form-label-left',
            'data-ng-controller'=>"renewController"
        ));
        
       $this->addFieldset();
       $this->addCommon();
        
    }
    
    private function addFieldset(){
        $this->add(array(
            'name'=>'subscription',
            'type'=>'Users\Form\Fieldset\BrokerSetupPackagePremiumFieldset',
            'options'=>array(
                'use_as_base_feildset'=>true
            )
        ));
        
        $this->add(array(
            'name'=>'card_payment',
            'type'=>'Transactions\Form\Fieldset\UserCardPaymentFieldset'
        ));
        
        $this->add(array(
            'name'=>'totalAmount',
            'type'=>'hidden',
            'attributes'=>array(
                'data-ng-model'=>'totalamount',
                'id'=>'totalamount'
            ),
        ));
    }
    
    private function addCommon()
    {
        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
            'options' => array(
            //                 'csrf_options' => array(
                //                     'timeout' => 600
                //                 )
            )
        ));
    
    
    
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'RENEW SUBSCRIPTION',
                'class' => 'btn btn-success',
                'id' => 'create-object'
            )
        ));
    }
}

