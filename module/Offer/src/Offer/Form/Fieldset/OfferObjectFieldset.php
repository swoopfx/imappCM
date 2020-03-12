<?php
namespace Offer\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

/**
 *
 * @author swoopfx
 *        
 */
class OfferObjectFieldset extends Fieldset implements InputFilterProviderInterface
{

    /**
     *
     * @param null|int|string $name
     *            Optional name for the element
     *            
     * @param array $options
     *            Optional options for the element
     *            
     */
    public function init()
    {
        $this->addFields();
    }
    
    private function addFields(){
        $this->add(array(
            'name'=>'objectss',
            'type'=>'checkbox',
            
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

