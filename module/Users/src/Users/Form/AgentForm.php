<?php
namespace Users\Form;

use Zend\Form\Form;

/**
 *
 * @author swoopfx
 *        
 */
class AgentForm extends Form
{

    /**
     */
    public function init()
    {
        parent::__construct('agent_profile_form');
        $this->setAttributes(array(
            'action'=>'',
            'method'=>'POST',
            'class'=>'',
            'enctype' => 'multipart/form-data'
        ));
        $this->addProfile();
        
        $this->addCommon();
    }

    protected function addProfile()
    {
        $this->add(array(
            'name' => 'agent_profile_form',
            'type' => 'Users\Form\Fieldset\BrokerProfileFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
    }
    
    protected function addCommon(){
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
            'name' => 'reset',
            'type' => 'Zend\Form\Element',
            'options' => array()
        
            ,
            'attributes' => array(
                'class' => 'btn btn-primary',
                'value' => 'Reset',
                'id' => 'reset'
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