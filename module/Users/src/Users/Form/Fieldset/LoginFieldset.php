<?php
namespace Users\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

/**
 *
 * @author swoopfx
 *        
 */
class LoginFieldset extends Fieldset implements InputFilterProviderInterface
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
    private $entityManager;

    private $userEntity;

    public function __construct($name = null, $options = null)
    {
        parent::__construct('loginFieldset', $options = null);
        // TODO - Insert your code here
        
        $this->loginFields();
    }

    protected function addCommonFields()
    {
        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 600
                )
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Submit',
                'class' => 'btn btn-lg btn-login btn-block'
            )
        ));
    }

    protected function loginFields()
    {
        $this->add(array(
            'name' => 'usernameOrEmail',
            'type' => 'text',
            'options' => array(
                'label' => 'Username'
            ),
            'attributes' => array(
                'required' => true,
                'class' => 'form-control',
                'placeholder' => 'Username or Email'
            )
        ));
        
        $this->add(array(
            'name' => 'password',
            'type' => 'Zend\Form\Element\Password',
            'options' => array(
                'label' => 'Password'
            ),
            'attributes' => array(
                'required' => true,
                'type' => 'password',
                'placeholder' => 'Password'
            )
        ));
        
        $this->add(array(
            'name' => 'rememberme',
            'type' => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'label' => 'Remember me?'
            )
        ));
        $this->addCommonFields();
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     *
     */
    public function getInputFilterSpecification()
    {
        
        // TODO - Insert your code here
        return array(
            
            'usernameOrEmail' => array(
                'required' => true,
                'allow_empty' => false,
                'filters' => array(
                    array(
                        'name' => 'Zend\Filter\StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'Zend\Validator\StringLength',
                        'options' => array(
                            'min' => 5,
                            'max' => 256,
                            'messages' => array(
                                \Zend\Validator\StringLength::TOO_SHORT => 'Your Username is Invalid'
                            )
                        )
                    )
                )
            ),
            
            'password' => array(
                'required' => true,
                'allow_empty' => false,
                'filters' => array(
                    array(
                        'name' => 'Zend\Filter\StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'Zend\Validator\StringLength',
                        'options' => array(
                            'min' => 6,
                            'max' => 100,
                            'messages' => array(
                                // TODO - include messages for lesser amount of characters
                                \Zend\Validator\StringLength::TOO_SHORT => 'Your Password is invalid'
                            )
                            
                        )
                    ),
                    
                    array(
                        // TODO - completer the regular expression validator for the password
                        'name' => 'Zend\Validator\Regex',
                        'options' => array(
                            'pattern' => '/[0-9a-zA-Z\s\'.;-]+/',
                            'messages' => array(
                                \Zend\Validator\Regex::INVALID => 'Your password in invalid'
                            )
                        )
                    )
                )
                
            ),
            // End of password filter and validator
            
            'rememberme' => array(
                'required' => true,
                
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
                        'name' => 'InArray',
                        'options' => array(
                            'haystack' => array(
                                '0',
                                '1'
                            )
                        )
                    )
                )
            )
        );
    }
}

?>