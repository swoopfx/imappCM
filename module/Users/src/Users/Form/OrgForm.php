<?php
namespace Users\Form;

use Zend\Form\View\Helper\Form;

/**
 *
 * @author swoopfx
 *        
 */
class OrgForm extends Form
{

    /**
     */
    public function __construct()
    {
        $this->addProfile();
    }

    protected function addProfile()
    {
        $this->add(array(
            'name' => 'org_profile_form',
            'type' => 'Users\Form\Fieldset\OProfileFieldset',
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