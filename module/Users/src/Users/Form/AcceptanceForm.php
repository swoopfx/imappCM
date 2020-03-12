<?php
namespace Users\Form;

use Zend\Form\Form;
use Users\Form\Fieldset\AcceptanceFieldset;

/**
 *
 * @author swoopfx
 *        
 */
class AcceptanceForm extends Form
{

    /**
     */
    public function __construct()
    {
        $acceptanceForm = new AcceptanceFieldset();
        $acceptanceForm->setName('acceptance_fieldset');
        $acceptanceForm->setUseAsBaseFieldset(true);
        $this->add($acceptanceForm);
    }
}

?>