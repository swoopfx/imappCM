<?php
namespace Users\Form;

use Zend\Form\Form;
use Users\Form\Fieldset\AgentRegisterFieldset;

/**
 *
 * @author swoopfx
 *        
 */
class AgentRegisterForm extends Form
{
    // TODO - Insert your code here
    
    /**
     */
    public function init()
    {
        //parent::__construct('agent_register_form');
        $this->setAttributes(array(
            'action'=>'/user/register',
            'method'=>'POST',
            'class'=>'',
            'data-ng-controller'=>'',
        ));
        $this->addFields();
        $this->addCommonFields();
        
    }
    
    private function addFields(){
        $this->add(array(
            'name' => 'agent_register_field',
            'type' => 'Users\Form\Fieldset\AgentRegisterFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
    }

    private function addCommonFields()
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
                'value' => 'Submit',
                'class' => 'btn btn-lg btn-login btn-block'
            )
        ));
    }
}

?>