<?php
namespace Users\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

/**
 * This class defines the feilddset of Organisational Profile
 * 
 * @author swoopfx
 *        
 */
class OProfileFieldset extends Fieldset implements InputFilterProviderInterface
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
    public function __construct($name = null, $options = null)
    {
        parent::__construct($name = null, $options = null);
        // TODO - Insert your code here
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     *
     */
    protected function addProfile()
    {
        $this->add(array(
            'name' => 'company_name',
            'type' => 'text',
            'options' => array(
                'label' => 'Organisation Name'
            ),
            'attributes' => array(
                'class' => 'free'
            )
        ));
        
        $this->add(array(
            'name' => 'company_desc',
            'type' => 'textarea',
            'options' => array()

            ,
            'attributes' => array(
                'class' => 'id'
            )
        ));
    }

    public function getInputFilterSpecification()
    {
        
        // TODO - Insert your code here
    }
}

?>