<?php
namespace Settings\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Settings\Entity\GeneralStatus;

/**
 *
 * @author swoopfx
 *        
 */
class GeneralStatusFieldset extends Fieldset implements InputFilterProviderInterface
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
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new GeneralStatus());
        
        $this->add(array(
            'name' => 'status',
            'type' => 'text',
            'options' => array(
                'label' => 'General Ststus'
            ),
            'attributes' => array(
                'required' => 'required',
                'class' => 'form-control'
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
        return array(
            'status' => array(
                'required' => true,
                'allow_empty' => false,
                'filters' => array(),
                'validators' => array()
            )
        );
    }
}

?>