<?php
namespace Users\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Users\Entity\AgentTelephone;
use Zend\Validator\StringLength;

/**
 *
 * @author swoopfx
 *        
 */
class AgentTelephoneFieldset extends Fieldset implements InputFilterProviderInterface
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
        $this->setHydrator($hydrator)->setObject(new AgentTelephone());
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
        return array(
            'agentTelephone' => array(
                'required' => true,
                'allow_empty' => false,
                'filters' => array(
                    array(
                        'name' => 'Zend\Filter\StringTrim'
                    ),
                    array(
                        'name' => 'StripTags'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'min' => 6,
                            'max' => 11,
                            'messages' => array(
                                StringLength::TOO_SHORT => "Your phone number should be more than 6 number",
                                StringLength::TOO_LONG => "Are you sure your phone numbers are correct it is more than 11 numbers"
                            )
                        )
                    )
                )
            )
            
        );
    }

    protected function addFields()
    {
        $this->add(array(
            'name' => 'agentTelephone',
            'type' => 'text',
            'options' => array(
                'label' => 'Agents Telephone Number',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                'placeholder' => '2347034343434'
            )
        ));
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

?>