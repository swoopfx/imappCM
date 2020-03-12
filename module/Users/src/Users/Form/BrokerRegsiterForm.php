<?php
namespace Users\Form;

use Zend\Form\Form;


/**
 *
 * @author swoopfx
 *        
 */
class BrokerRegsiterForm extends Form
{
    // TODO - Insert your code here
    
    /**
     */
    public function init()
    {
        //parent::__construct('broker_register_form');
        $this->setAttributes(array(
            'action'=>'/user/broker/register',
            'class'=>'',
            'enctype' => 'multipart/form-data',
            'method'=>'POST',
            'novalidate'=>true,
        ));
        $this->addCommon();
        $this->addFeilds();
    }
    
    private function addFeilds(){
        $this->add(array(
            'name' => 'broker_register_field',
            'type' => 'Users\Form\Fieldset\AgentRegisterFieldset',
            'options' => array(
                 'use_as_base_fieldset' => true
            )
        ));
    }
    
    private function addCommon(){
        
       
            $this->add(array(
                'name' => 'csrf',
                'type' => 'Zend\Form\Element\Csrf',
                'options' => array(
                                'csrf_options' => array(
                                        'timeout' => 600
                                    )
                )
            ));
        
            $this->add(array(
                'name' => 'submit',
                'type' => 'Zend\Form\Element\Submit',
                'attributes' => array(
                    'type' => 'submit',
                    'value' => 'Submit',
                    'class' => 'btn btn-lg btn-login btn-block'
                )
            ));
    }
}

?>