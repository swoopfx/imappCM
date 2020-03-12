<?php
namespace Customer\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Customer\Entity\Customer;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;
use DoctrineModule\Validator\UniqueObject;

/**
 *
 * @author swoopfx
 *        
 */
class CustomerFieldset extends Fieldset implements InputFilterProviderInterface
{

    protected $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)
            ->setObject(new Customer())
         ;
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            'name' => 'name',
            'type' => 'text',
            'options' => array(
                'label' => 'Name',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'customer_name',
                'required' => 'required',
                'class' => 'form-control',
                'title' => 'Provide your customers full name',
                'placeholder' => 'Customers Full Name e.g Segun Chukwuma Hamza'
            )
        ));
        
//         $this->add(array(
//             'name' => 'phone',
//             'type' => 'text',
//             'options' => array(
//                 'label' => 'Phone',
                
//             ),
//             'attributes' => array(
//                 'id' => 'customer_phone',
//                 'required' => 'required',
//                 'class' => 'form-control',
//                 'title' => 'Provide your phone number',
//                 'placeholder' => '+2347031232323'
//             )
//         ));
        
//         $this->add(array(
//             'name' => 'email',
//             'type' => 'Zend\Form\Element\Email',
//             'options' => array(
//                 'label' => 'Email',
//                 'label_attributes' => array(
//                     'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
//                 )
//             ),
//             'attributes' => array(
//                 'id' => 'customer_email',
//                 'required' => 'required',
//                 'class' => 'form-control',
//                 'title' => 'Customers Email',
//                 'placeholder' => 'ert@example.com'
//             )
//         ));

        $this->add(array(
            'name'=>'user',
            'type'=>'CsnUser\Form\Fieldset\UserBasicFieldset',
//             'options' => array(
//                 'label' => 'State:',
// //                 'label_attributes' => array(
// //                     'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
// //                 ),
//                 'object_manager' => $this->entityManager,
//                 'target_class' => 'Settings\Entity\Zone',
//                 'property' => 'zoneName',
//                 'empty_option' => '--- Select State/Region ---',
//                 'is_method' => true,
//                 'find_method' => array(
//                     'name' => 'findSpecificZone'
//                 )
//             ),
        ));
        
        $this->add(array(
            'name'=>'customerCategory',
            'type'=>'DoctrineModule\Form\Element\ObjectRadio',
            
            'options' => array(
                'label' => 'State:',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Customer\Entity\CustomerCategory',
                'property' => 'category',
                'empty_option' => '--- Select State/Region ---',
                'is_method' => true,
//                 'find_method' => array(
//                     'name' => 'findSpecificZone'
//                 )
            ),
            'attributes'=>array(
                //'data-ng-click' => "isDobF()"
            )
        ));
        
        $this->add(array(
            'name' => 'address1',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Address: ',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'customer_address1',
                'required' => 'required',
                'class' => 'form-control col-md-7 col-xs-12',
                
                'placeholder' => '123 Lane Avenue '
            )
        ));
        
        $this->add(array(
            'name' => 'address2',
            'type' => 'textarea',
            'options' => array(
                'label' => '  ',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'customer_address2',
                
                'class' => 'form-control col-md-7 col-xs-12',
                
                'placeholder' => 'Dolomit Avenue '
            )
        ));
        
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
                'id' => 'customer_city',
        
                'class' => 'form-control col-md-7 col-xs-12',
        
                'placeholder' => 'Ikeja'
            )
        ));
        
        $this->add(array(
            'name' => 'state',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'State:',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Zone',
                'property' => 'zoneName',
                'empty_option' => '--- Select State/Region ---',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findSpecificZone'
                )
            ),
            'attributes' => array(
                'id' => 'state',
                
                'class' => 'form-control col-md-7 col-xs-12',
                'placeholder' => 'Ikeja '
            )
        ));
        
        $this->add(array(
            'name' => 'country',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Country :',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'empty_option' => '--- Select a Country ---',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Country',
                'property' => 'countryName'
            ),
            'attributes' => array(
                'id' => 'country',
                'class' => 'form-control col-md-7 col-xs-12'
            )
        ));
        $this->add(array(
            'name' => 'dob',
            'type' => 'Zend\Form\Element\Date',
            'options' => array(
                'label' => 'DOB :',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-7 col-xs-12',
                
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
            'name' => array(
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
                        'name' => 'Zend\Validator\StringLength',
                        'options' => array(
                            'min' => 2,
                            'max' => 500,
                            'messages' => array(
                                StringLength::TOO_SHORT => 'Please insert the correct amount of digits',
                                StringLength::TOO_LONG => 'We belive this is too long a  name'
                            )
                        )
                    )
                )
            ),
//             'email' => array(
//                 'required' => true,
//                 'allow_empty' => false,
//                 'break_chain_on_failure' => true,
//                 'filters' => array(
//                     array(
//                         'name' => 'StripTags'
//                     ),
//                     array(
//                         'name' => 'StringTrim'
//                     )
//                 ),
//                 'validators' => array(
// //                     array(
// //                         'name' => 'Regex',
// //                         'options' => array(
// //                             'pattern' => '/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/',
// //                             'messages' => array(
// //                                 Regex::NOT_MATCH => 'Please provide a valid email address.'
// //                             )
// //                         ),
// //                         'break_chain_on_failure' => true
// //                     ),
                    
//                     array(
//                         'name' => 'DoctrineModule\Validator\UniqueObject',
//                         'options' => array(
//                             'use_context' => true,
//                             'object_repository' => $this->entityManager->getRepository('Customer\Entity\Customer'),
//                             'object_manager' => $this->entityManager,
//                             'fields' => 'email',
//                             'messages' => array(
//                                 UniqueObject::ERROR_OBJECT_NOT_UNIQUE => 'Someone else is registered with this email'
//                             )
//                         )
//                     ),
//                     array(
//                         'name' => 'Zend\Validator\StringLength',
//                         'options' => array(
//                             'messages' => array(),
//                             'min' => 3,
//                             'max' => 256,
//                             'messages' => array(
//                                 StringLength::TOO_SHORT => 'Wrong Email',
//                                 StringLength::TOO_LONG => 'We dont think this is a genuine email'
//                             )
//                         ),
                        
//                         array(
//                             'name' => 'EmailAddress',
                            
//                             'options' => array(
                                
//                                 'messages' => array(
//                                     EmailAddress::INVALID_FORMAT => 'Please check your email something is not right'
//                                 )
                                
//                             )
//                         )
//                     )
//                     // array (
//                     // 'name' => 'Regex',
//                     // 'options' => array(
//                     // 'messages' => array(
//                     // Regex::INVALID=>"Invalid Format",
//                     // )
//                     // ),
//                     // ),
                    
//                 )
                
//             ),
            'phone' => array(
                'required' => true,
                'allow_empty' => false,
                'break_chain_on_failure' => true,
                'validators' => array(
                    array(
                       
                        'name' => 'DoctrineModule\Validator\UniqueObject',
                        'options' => array(
                            'use_context' => true,
                            'object_repository' => $this->entityManager->getRepository('Customer\Entity\Customer'),
                            'object_manager' => $this->entityManager,
                            'fields' => 'phone',
                            'messages' => array(
                                UniqueObject::ERROR_OBJECT_NOT_UNIQUE => 'Someone else is registered with this phone number'
                            )
                        )
                    ),
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                NotEmpty::IS_EMPTY => 'Make Sure this field is not Empty'
                            )
                        )
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'min' => 3,
                            'max' => 45,
                            'messages' => array(
                                StringLength::TOO_SHORT => 'Please insert the correct amount of digits',
                                StringLength::TOO_LONG => 'We dont think this is a genuine phone number'
                            )
                        )
                    )
                )
            ),
            
            'dob' => array(
                'required' => false,
                'allow_empty' => true
            ),
            'country' => array(
                'required' => false,
                'allow_empty' => true
            )
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        
        return $this;
    }
}

