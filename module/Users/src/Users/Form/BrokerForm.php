<?php
namespace Users\Form;

use Zend\Form\View\Helper\Form;

/**
 *
 * @author swoopfx
 *        
 */
class BrokerForm extends Form
{
    // TODO - Insert your code here
    
    /**
     */
    public function __construct()
    {
        parent::__construct('broker_profile_form');
        
        $this->addProfile();
        $this->add(array(
            'name' => 'submit_profile',
            'type' => 'submit',
            'attributes' => array(
                'value' => 'Submit Profile'
            )
        ));
    }

    protected function addProfile()
    {
        $this->add(array(
            'name' => 'broker_profile_form',
            'type' => 'Users\Form\Feildset\BrokerProfileFielset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
    }
}

?>