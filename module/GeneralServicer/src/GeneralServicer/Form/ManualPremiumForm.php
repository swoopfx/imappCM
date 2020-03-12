<?php
namespace GeneralServicer\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class ManualPremiumForm extends Form
{

    public function init()
    {
        $this->setAttributes(array(
            "method" => "POST",
            "action" => "",
            "class" => "form-horizontal form-label-left"
        
        ));
        $this->addField();
    }

    private function addField()
    {
        $this->add(array(
            "name" => "manualPremiumFieldset",
            "type" => "GeneralServicer\Form\Fieldset\ManualPremiumFieldset",
            "options" => array(
                "use_as_base_fieldset" => true
            )
        ));
        
        $this->add(array(
            "name" => "submit",
            "type" => "submit",
            "options" => array(),
            'attributes' => array(
                'value' => 'Generate',
                "class" => "btn btn-block btn-success"
            )
        ));
    }
}

