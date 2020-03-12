<?php
namespace Users\Form;

use Zend\Form\View\Helper\Form;

/**
 *
 * @author otaba
 *        
 */
class BrokerSetupDataPremiumForm extends Form
{

    public function init(){
        $this->setAttributes(array(
            'name' => 'broker_setup_form',
            'action' => '/user/broker/setup-data',
            'method' => 'POST',
            
            'class' => 'form-horizontal form-label-left',
            //'novalidate'=>false,
        ));
        $this->addField();
        $this->addCommon();
    }
    
    private function addFeild(){
        $this->add(array(
            'name'=>'broker_setup_data',
            'type'=>'Users\Form\Fieldset\BrokerSetUpDataFieldset',
            'options'=>array(
                'use_as_base_fieldset' => true
            ),
        )
            );
    }
    
    private function addCommon(){
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
                'value' => 'Set Up',
                'class' => 'btn btn-success',
                'id' => 'create-object'
            )
        ));
    }
    
    
}

