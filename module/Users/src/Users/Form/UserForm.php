<?php
namespace Users\Form;

use Zend\Form\View\Helper\Form;
use Users\Form\Fieldset\UserProfileFieldset;

/**
 * This class defines the objects for the Users Profile
 * 
 * @author swoopfx
 *        
 */
class UserForm extends Form
{
    // TODO - Insert your code here
    
    /**
     */
    public function __construct()
    {
        parent::__construct('user_profle');
        $this->addProfile();
    }

    protected function addProfile()
    {
        $this->add(array(
            'name' => 'user_profile_form',
            'type' => 'Users\Form\Fieldset\UserProfileFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => array(
                'value' => 'Submit Profile'
            )
        ));
    }
}

?>