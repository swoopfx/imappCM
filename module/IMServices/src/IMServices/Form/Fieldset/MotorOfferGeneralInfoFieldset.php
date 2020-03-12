<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\MotorOfferGeneralInfo;

/**
 *
 * @author swoopfx
 *        
 */
class MotorOfferGeneralInfoFieldset extends Fieldset implements InputFilterProviderInterface
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
    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new MotorOfferGeneralInfo());
        $this->addFields();
    }

    protected function addFields()
    {
        $this->add(array(
            
            'name' => 'isCarParked',
            'type' => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'label' => 'Would the car be parked',
                'checked_value' => TRUE,
                'unchecked_value' => FALSE
            ),
            'attributes' => array(
                'value' => FALSE
            )
        ));
        
        $this->add(array(
            'name' => 'isSoleOwner',
            'type' => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'label' => 'Are you the sole owner the the vehichle',
                'checked_value' => TRUE,
                'unchecked_value' => FALSE
            ),
            'attributes' => array(
                'value' => FALSE
            )
        ));
        $this->add(array(
            'name' => 'isCarHired',
            'type' => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'label' => 'Check if Vehicle is hired',
                'checked_value' => TRUE,
                'unchecked_value' => FALSE
            ),
            'attributes' => array(
                'value' => FALSE,
                'data-ng-click' => 'isHired()'
            )
        )
        );
        $this->add(array(
            'name' => 'financeCompany',
            'type' => 'text',
            'options' => array(
                'label' => "Please Provide name of Finance Company",
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-7 col-xs-12'
            )
        ));
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     *
     */
    public function getInputFilterSpecification()
    {
        return array();
    }
}

?>