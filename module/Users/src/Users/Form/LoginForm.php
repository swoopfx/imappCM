<?php
namespace Users\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;

/**
 *
 * @author swoopfx
 *        
 */
class LoginForm extends Form
{
    // TODO - Insert your code here
    
    /**
     */
    public function __construct()
    {
        parent::__construct('login_form');
        $this->addLoginForm();
    }

    protected function addLoginForm()
    {
        $this->add(array(
            'name' => 'login_field',
            'type' => 'Users\Form\Fieldset\LoginFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
    }
}

?>