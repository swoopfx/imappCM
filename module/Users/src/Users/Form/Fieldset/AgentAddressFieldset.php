<?php
namespace Users\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Users\Entity\AgentAddress;

/**
 *
 * @author swoopfx
 *        
 */
class AgentAddressFieldset extends Fieldset implements InputFilterProviderInterface
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
    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new AgentAddress());
        $this->addFields();
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     *
     */
    public function getInputFilterSpecification()
    {
        return array()

        ;
    }

    private function addFields()
    {
        $this->add(array(
            'name' => 'address1',
            'type' => 'text',
            'options' => array(
                'label' => 'Address',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'address2',
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12'
            )
        ));
        
        $this->add(array(
            'name' => 'address2',
            'type' => 'text',
            'options' => array(
                'label' => 'Address (ext)',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'address2',
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12'
            )
        ));
        
        $this->add(array(
            'name' => 'email',
            'type' => 'Zend\Form\Element\Email',
            'options' => array(
                'label' => 'Relative address email',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                // 'required' => 'required',
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12'
            )
        ));
        $this->add(array(
            'name' => 'country',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Country of operation',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Country',
                'property' => 'countryName',
                'empty_option' => '-- Select Country --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'required' => 'required',
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12'
            )
        ));
        $this->add(array(
            'name' => 'state',
            'type' => 'text',
            'options' => array(
                'label' => 'State',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12'
            )
            
        ));
        
        $this->addAgentPhone();
    }

    private function addAgentPhone()
    {
        $this->add(array(
            'name' => 'agent_telephone',
            'type' => 'Users\Form\Fieldset\AgentTelephoneFieldset'
        ));
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

/**
 *
 * @author swoopfx
 *        
 */
class UContactFieldset extends Fieldset implements InputFilterProviderInterface
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
?>