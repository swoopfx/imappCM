<?php
namespace Transactions\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class CardBillingForm extends Form
{

    public function init()
    {
        $this->setAttributes(array(
            "method" => "POST",
            "action" => "",
            "class" => "form-horizontal form-label-left"
        ));
    }

    private function addFeilds()
    {
        $this->add(array(
            "name" => "cardBillingFieldset",
            "type" => "Transactions\Form\Fieldset\CardBillingFieldset",
            "options" => array(
                "use_as_base_fieldset" => true
            
            )
        
        ));
    }
}

