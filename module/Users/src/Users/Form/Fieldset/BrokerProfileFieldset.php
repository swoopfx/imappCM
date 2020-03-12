<?php
namespace Users\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

/**
 *
 * @author swoopfx
 *        
 */
class BrokerProfileFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

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
        $this->addProfileFields();
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     *
     */
    protected function addProfileFields()
    {
        $this->add(array(
            'name' => 'company_name',
            'type' => 'text',
            'options' => array(
                'label' => 'Company Name'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            'name' => 'company_profile',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Company Profile'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        )
        );
        
        $this->add(array(
            'name' => 'company_logo',
            'type' => 'text',
            'options' => array(
                'label' => 'Upload Company Logo'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        )
        );
        
        $this->add(array(
            'name' => 'company_intro',
            'type' => 'Zend\Form\Element\Textarea',
            'options' => array(
                'label' => 'Company Introduction'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        )
        );
        
        $this->add(array(
            'name' => 'company_address',
            'type' => 'text',
            'options' => array(
                'label' => 'Broker Address'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        )
        );
        
        $this->add(array(
            'name' => 'company_phone',
            'type' => 'text',
            'options' => array(
                'label' => 'Company Phone Number'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        )
        );
        
        $this->add(array(
            'name' => 'company_email',
            'type' => 'Zend\Form\Element\Email',
            'options' => array(
                'label' => 'Company Email'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        )
        );
        
        $this->add(array(
            'name' => 'company_website',
            'type' => 'url',
            'options' => array(
                'label' => 'Company Profile'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        )
        );
    }

    public function getInputFilterSpecification()
    {
        
        // TODO - Insert your code here
    }
}

?>