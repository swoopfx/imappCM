<?php
namespace Users\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Users\Entity\IndividualInfo;

/**
 *
 * @author swoopfx
 *        
 */
class UserProfileFieldset extends Fieldset implements InputFilterProviderInterface
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
    protected $auth;

    protected $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new IndividualInfo());
        $this->addProfile();
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
            'name' => 'firstname',
            'type' => 'text',
            'options' => array(
                'label' => 'Firstname',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'First Name',
                'required' => 'required'
            )
        )
        );
        
        $this->add(array(
            'name' => 'lastname',
            'type' => 'text',
            'options' => array(
                'label' => 'Lastname',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                
                // 'data-ng-click' => 'none',
                'placeholder' => 'Surname',
                'required' => 'required'
            )
        ));
        
        $this->add(array(
            'name' => 'othername',
            'type' => 'text',
            'options' => array(
                'label' => 'Other Names',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                'placeholder' => 'Other Name'
            )
            
        ));
        $this->add(array(
            'name' => 'dob',
            'type' => 'Zend\Form\Element\Date',
            'options' => array(
                'label' => 'Date Of Birth',
                'format' => 'Y-m-d',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'min' => '1900-01-01',
                'class' => 'form-control',
                'step' => '1'
            )
        )
        );
        
        $this->add(array(
            'name' => 'gender',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Gender',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Gender',
                'property' => 'gender',
                'empty_option' => '-- Gender --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            'name' => 'contact',
            'type' => 'Users\Form\Fieldset\UContactFieldset'
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            'firstname' => array(
                'required' => true,
                'allow_empty' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'Zend\Validator\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => 256
                        )
                    )
                )
            ),
            'lastname' => array(
                'required' => true,
                'allow_empty' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'Zend\Validator\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => 256
                        )
                    )
                )
            ),
            'othername' => array(
                'required' => false,
                'allow_empty' => true,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'Zend\Validator\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => 256
                        )
                    )
                )
            )
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
    }
}

?>