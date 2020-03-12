<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use DoctrineModule\Form\Element\ObjectSelect;
use IMServices\Entity\MotorOfferData;

/**
 *
 * @author swoopfx
 *        
 */
class MotorOfferDataFieldset extends Fieldset implements InputFilterProviderInterface
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
        $this->setHydrator($hydrator)->setObject(new MotorOfferData());
        $this->addFields();
        
        $this->addGeneralInfo();
    }

    protected function addFields()
    {
        $this->add(array(
            'name' => 'typeOfVehicle',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Type of Vehicle',
                
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\MotorType',
                'property' => 'motor',
                'empty_option' => '-- Motor Type--',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(
                            'useCategory' => 2
                        )
                    )
                    ,
                    'orderBy' => array(
                        'id' => 'ASC'
                    )
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-7 col-xs-12'
            )
        )
        );
        
        $this->add(array(
            'name' => 'extraPurposeOfUse',
            'type' => 'textarea', // TODO -alternatively use multicheckbox here
            'options' => array(
                'label' => 'Purpose Of Use ',
                
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'multiple' => 'multiple',
                'class' => 'form-control col-md-7 col-xs-12',
                'placeholder'=>'Provide a description of all its use'
            )
        )
        );
        
        /**
         * Tokumbo or new or Naija used
         */
        $this->add(array(
            'name' => 'vehicleValueType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Type of Vehicle',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\VehicleValueType',
                'property' => 'valueType',
                'empty_option' => '-- Vehicle Vlalue Type --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-7 col-xs-12'
            )
        ));
        
        $this->add(array(
            'name' => 'isLimitedToOnlyMe',
            'type' => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'label' => 'The insurance is limited to driving by me',
                'checked_value' => TRUE,
                'unchecked_value' => FALSE
            ),
            'attributes' => array(
                'value' => TRUE,
                'data-ng-click' => 'onlyMeDriv()'
            )
        ));
        
        $this->add(array(
            'name' => 'peopleDrivingCar',
            'type' => 'textarea',
            'options' => array(
                'label' => 'if not, who else will drive the car',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-7 col-xs-12',
                'placeholder' => 'Full names of people who would also drive the car '
            )
        ));
        
        $this->add(array(
            'name' => 'isUsageInNigeria',
            'type' => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'label' => 'Would only be use in Nigeria',
                'checked_value' => TRUE,
                'unchecked_value' => FALSE
            ),
            'attributes' => array(
                'value' => FALSE
            )
        ));
        
        $this->add(array(
            'name' => 'isGeneralInfo',
            'type' => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'label' => 'Extra Info',
                'checked_value' => TRUE,
                'unchecked_value' => FALSE
            ),
            'attributes' => array(
                'value' => false,
                'data-ng-click' => 'generalInfo()'
            )
        ));
    }

    protected function addGeneralInfo()
    {
        $this->add(array(
            'name' => 'comprehensive_general_info',
            'type' => 'IMServices\Form\Fieldset\MotorOfferGeneralInfoFieldset'
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
        return array();

        
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        
        return $this;
    }
}

?>