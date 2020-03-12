<?php
namespace Claims\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

/**
 *
 * @author otaba
 *        
 */
class ClaimsPersonalAccidentFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function init(){
        
    }
    
    private function addFields(){
        $this->add(array(
            "name"=>""
        ));
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     *
     */
    public function getInputFilterSpecification()
    {}
}

