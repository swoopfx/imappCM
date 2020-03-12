<?php
namespace Users\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Users\Entity\IndividualContact;
use Zend\Validator\Digits;
use Zend\Validator\StringLength;

/**
 *
 * @author swoopfx
 *        
 */
class UContactFieldset extends Fieldset implements InputFilterProviderInterface
{

    protected $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new IndividualContact());
        $this->addFields();
    }

    protected function addFields()
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
                'class' => 'form-control',
                'placeholder' => 'Address',
                'required' => 'required'
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
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                'placeholder' => 'Address'
            )
        )
        );
        
        $this->add(array(
            'name' => 'city',
            'type' => 'text',
            'options' => array(
                'label' => 'City',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                'placeholder' => 'City'
            )
        )
        );
        $this->add(array(
            'name' => 'postalCode',
            'type' => 'text',
            'options' => array(
                'label' => 'Postal Code',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                'placeholder' => '100111'
            )
        )
        );
        
        $this->add(array(
            'name' => 'phoneNumber1',
            'type' => 'text',
            'options' => array(
                'label' => 'Phone Number',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                'placeholder' => '08012121212',
                'required' => 'required'
            )
        ));
        
        $this->add(array(
            'name' => 'stateProvince',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'State',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Zone',
                'property' => 'zoneName',
                'empty_option' => '-- State --',
                // TODO - Include a streamline to Nigeria states
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(
                            'country' => 156
                        ),
                        'orderBy' => array(
                            'id' => 'ASC'
                        )
                    )
                ),
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12'
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
            'phoneNumber1' => array(
                'required' => true,
                'allow_empty' => false,
                'validators' => array(
                    array(
                        'name' => 'Digits',
                        'options' => array(
                            'min' => 7,
                            'max' => 11,
                            
                            'messages' => array(
                                Digits::NOT_DIGITS => 'Your Phone number must be numbers',
                                Digits::INVALID => 'Please Make sure it is more than 7 numbers',
                                StringLength::TOO_SHORT=> 'Please make sure your phone numberis up to 7 numbers',
                                
                            )
                        )
                    )
                )
            )
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

