<?php
namespace Users\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Users\Entity\InsuranceBrokerRegistered;

// use Zend\Validator\Uri;

// use Zend\Validator\File\FilesSize;
// use Zend\Validator\File\MimeType;
// use Zend\Validator\File\ImageSize;

/**
 *
 * @author swoopfx
 *        
 */
class BrokerSetUpDataFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new InsuranceBrokerRegistered());
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            'name' => 'companyLogo',
            'type' => 'hidden',
            'options' => array(),
            'attributes' => array(
                'id' => 'company-logo',
                'data-ng-model' => 'uploadid',
                'value' => "{{uploadid}}"
            )
        ));
        $this->add(array(
            'name' => 'brokerEmail',
            'type' => 'Zend\Form\Element\Email',
            'options' => array(
                'label' => 'Company Official Email',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                
                'class' => 'form-control col-sm-9 col-md-9 col-xs-12',
                'placeholder' => 'abc@xyz.com',
                'required' => 'required'
            )
        ));
        
        $this->add(array(
            'name' => 'brokerWebsite',
            // 'type' => 'Zend\Form\Element\Url',
            'type' => 'text',
            'options' => array(
                'label' => 'Company Website',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                
                'class' => 'form-control col-sm-9 col-md-9 col-xs-12 url',
                'placeholder' => 'http://abc.com'
            )
        ));
        $this->add(array(
            'name' => 'officialPhone',
            'type' => 'text',
            'options' => array(
                'label' => 'Company official Phone No.',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                
                'class' => 'form-control col-sm-9 col-md-9 col-xs-12 phone',
                'placeholder' => '+234-703-1212-1212',
                'id' => 'phone'
            )
        ));
        
        $this->add(array(
            'name' => 'idInduranceBoker',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Select Your Company',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'empty_option' => '---Select Your Company---',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\InsuranceBrokerAvailable',
                'property' => 'companyName'
            ),
            'attributes' => array(
                'id' => 'insurance-broker',
                'class' => 'form-control col-sm-9 col-md-9 col-xs-12',
                'value' => 30,
                'required' => 'required'
            )
        )); // Make a custom repo that will call al except the first id
        
        $this->add(array(
            'name' => 'brokerProfile',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Broker Company Profile',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            
            ),
            'attributes' => array(
                'id' => 'brokerProfile',
                // 'style' => "display:none;",
                'placeholder' => 'Provide a company profile. Your customers would see these information and evaluate you based on this ',
                'class' => 'form-control col-sm-9 col-md-9 col-xs-12'
            )
        ));
        
        $this->add(array(
            'name' => 'address1',
            'type' => 'text',
            'options' => array(
                'label' => 'Broker Address',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control  col-md-9 col-xs-12',
                'id' => 'address1',
                'required' => 'required'
            )
        ));
        
        $this->add(array(
            'name' => 'address2',
            'type' => 'text',
            'options' => array(
                'label' => ' ',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control  col-md-9 col-xs-12',
                'id' => 'address2'
            )
        ));
        $this->add(array(
            'name' => 'zipCode',
            'type' => 'text',
            'options' => array(
                'label' => 'Zip Code',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'zip_code'
            )
        ));
        
        $this->add(array(
            'name' => 'country',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Country',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Country',
                'property' => 'countryName',
                'empty_option' => '--- Select Country ---',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findAll',
                    'params' => array(
                        
                        'criteria' => array()
                    )
                )
            ),
            'attributes' => array(
                'id' => 'country_id',
                'class' => 'form-control',
                'value' => 156,
                'required' => 'required'
            )
        ));
        
        $this->add(array(
            'name' => 'state',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'State / Region /Province',
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
            // 'params' => array(
            
            // 'criteria' => array(
            // 'country' => ''
            // ), // this should be the id ogf the country selected above
            // // parameters to include in the
            // 'orderBy' => array(),
            // 'sort' => array()
            // )
            
            'attributes' => array(
                'class' => 'form-control',
                "id" => "state_id"
            )
        ));
        
        $this->add(array(
            'name' => 'subscription',
            'type' => 'Users\Form\Fieldset\BrokerPackageFieldset'
        ));
        
        $this->add(array(
            'name' => 'user',
            'type' => 'CsnUser\Form\Fieldset\UserBasicFieldset'
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
            // 'companyLogo' => array(
            // 'required' => false,
            // 'allow_empty' => true,
            // 'filters' => array(
            // array(
            // 'name' => 'Zend\Filter\File\LowerCase'
            // )
            // ),
            // 'validators' => array(
            
            // array(
            // 'name' => 'Zend\Validator\File\FilesSize',
            // 'options' => array(
            // 'max' => 2048,
            // 'messages' => array(
            // FilesSize::TOO_BIG => "The file should not be more than 2Mb"
            // )
            // )
            // ),
            // array(
            // 'name' => 'Zend\Validator\File\MimeType',
            // 'options' => array(
            // 'mimeType' => array(
            // 'image/jpg',
            // 'image/png'
            // ),
            // // 'application/pdf',
            // // 'application/msword',
            // // 'application/zip',
            // // 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            // 'messages' => array(
            // MimeType::FALSE_TYPE => "Only JPEG and PNG Files are allowed "
            // )
            // )
            
            // ),
            // array(
            // 'name' => 'Zend\Validator\File\ImageSize',
            // 'options' => array(
            // 'maxWidth' => 256,
            // 'maxHeight' => 256,
            // 'messages' => array(
            // ImageSize::HEIGHT_TOO_BIG => "The image should not be more than 256 Kilobytes in hiegt and width"
            // )
            // )
            // )
            // )
            // ),
            // 'rbaCode' => array(
            // 'required' => true,
            // 'allow_empty' => false,
            // 'filters' => array(),
            // 'validators' => array()
            // )
            
            'brokerProfile' => array(
                'required' => true,
                'allow_empty' => false,
                'filters' => array(
                    array(
                        'name' => 'Zend\Filter\StringTrim'
                    ),
                    array(
                        'name' => 'Zend\Filter\StripTags',
                        'options' => array(
                            'allow_tags' => array(
                                'body',
                                'p',
                                'b',
                                'br',
                                'strong',
                                'u',
                                'ul',
                                'li',
                                'a'
                            )
                        )
                    )
                )
            ),
            // 'brokerWebsite' => array(
            // 'required' => false,
            // 'allow_empty' => true,
            // 'filters' => array(
            // array(
            // 'name' => 'Zend\Filter\StringTrim'
            // ),
            // array(
            // 'name' => 'Zend\Filter\StripTags'
            // )
            // ),
            // 'validators' => array(
            // array(
            // 'name' => 'Zend\Validator\Uri',
            // 'options' => array(
            // 'allowRelative' => false
            // )
            // )
            // )
            // ),
            'address1' => array(
                'required' => true,
                'allow_empty' => false,
                'filters' => array(
                    array(
                        'name' => 'Zend\Filter\StringTrim'
                    ),
                    array(
                        'name' => 'Zend\Filter\StripTags'
                    )
                ),
                'validators' => array()
            ),
            'address2' => array(
                'required' => false,
                'allow_empty' => true,
                'filters' => array(
                    array(
                        'name' => 'Zend\Filter\StringTrim'
                    ),
                    array(
                        'name' => 'Zend\Filter\StripTags'
                    )
                ),
                'validators' => array()
            )
        );
    }

    // Begin Setters
    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        
        return $this;
    }
    
    // End Setters
}

