<?php
namespace Users\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use Zend\Form\Annotation\Type;

/**
 * This class defines the fieldset for organisational conatct details
 * 
 * @author swoopfx
 *        
 */
class OContactFieldset extends Fieldset implements InputFilterProviderInterface
{

    protected $entityManager;

    /**
     *
     * @param null|int|string $name
     *            Optional name for the element
     *            
     * @param array $options
     *            Optional options for the element
     *            
     */
    public function __construct($em, $name = null, $options = null)
    {
        parent::__construct($name = null, $options = null);
        $this->entityManager = $em;
    }

    protected function addProfile()
    {
        $this->add(array(
            'name' => 'company_address1',
            'type' => 'text',
            'options' => array(),
            'attributes' => array()
        ));
        
        $this->add(array(
            'name' => 'company_address2',
            'type' => 'text',
            'options' => array(
                'label' => ''
            ),
            'attributes' => array(
                'class' => ''
            )
        ));
        
        $this->add(array(
            'name' => 'country',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Country',
                'property' => 'country',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'getCountry'
                )
            )
        ));
        
        $this->add(array(
            'name' => 'state',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\State',
                'property' => 'state',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'getState'
                )
            )
        ));
        
        $this->add(array(
            'name' => 'city',
            'type' => 'text',
            'options' => array(
                'label' => 'City'
            ),
            'attributes' => array(
                'class' => 'he'
            )
        ));
        
        $this->add(array(
            'name' => 'postal_code',
            'type' => 'text',
            'options' => array(
                'label' => 'Postal Code'
            ),
            'attributes' => array(
                'class' => 'none'
            )
        ));
        
        $this->add(array(
            'name' => 'phone1',
            'type' => 'text', // TODO -include the regex condition in the filter to be numbers and +
            'options' => array(
                'label' => 'Phone Number'
            )
            ,
            'attributes' => array(
                'class' => 'fx'
            )
        ));
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     *
     */
    public function getInputFilterSpecification()
    {
        
        // TODO - Insert your code here
    }
}

?>