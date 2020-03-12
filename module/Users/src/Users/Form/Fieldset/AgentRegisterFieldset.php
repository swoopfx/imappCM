<?php
namespace Users\Form\Fieldset;

/**
 * This class is being registration form agents
 */
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use Zend\Validator\EmailAddress;
use Zend\Validator\StringLength;
use Zend\Validator\Regex;
use Zend\Validator\Identical;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use CsnUser\Entity\User;
use Zend\Filter\StripTags;
use DoctrineModule\Validator\NoObjectExists;

/**
 *
 * @author swoopfx
 *        
 */
class AgentRegisterFieldset extends Fieldset implements InputFilterProviderInterface
{

    /**
     *
     * @var ModuleOptions
     */
    protected $options;

    /**
     *
     * @var Doctrine\ORM\EntityManager
     */
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
        $this->setHydrator($hydrator)->setObject(new User());
        
        $this->addFields();
    }

    protected function addFields()
    {
        
        $this->add(array(
            'name'=>'role',
            'type'=>'hidden',
           
            
        ));
        $this->add(array(
            'name' => 'username',
            'type' => 'text',
            'options' => array(
                'label' => 'Agents Username',
                'label_attributes' => array(
                    'class'=>'',
                )
            ),
            
            
            'attributes' => array(
                'required' => 'required',
                'class' => 'form-control',
                'placeholder' => 'Username',
                
            )
            
        ));
        $this->add(array(
            'name' => 'email',
            'type' => 'Zend\Form\Element\Email',
            'options' => array(
                'label' => 'Agents Email'
            ),
            'attributes' => array(
                'required' => true,
                'type' => 'Zend\Form\Element\Email',
                'class' => 'form-control',
                'placeholder' => "abc@xyz.com"
            )
        ));
        
        $this->add(array(
            'name' => 'password',
            'type' => 'Zend\Form\Element\Password',
            'options' => array(
                'label' => 'Agents Password'
            ),
            'attributes' => array(
                'required' => true,
                'type' => 'password',
                'class' => 'form-control',
                'placeholder' => 'Password'
            )
        ));
        
        $this->add(array(
            'name' => 'passwordVerify',
            'type' => 'Zend\Form\Element\Password',
            'attributes' => array(
                'required' => true,
                'type' => 'password',
                'placeholder' => 'Confirm Password',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Confirm Password'
            )
        ));
        
        $this->add(array(
            'name' => 'question',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect', // must be a drop down list of information
            'options' => array(
                'label' => 'Security Question',
                'object_manager' => $this->entityManager,
                'target_class' => 'CsnUser\Entity\Question',
                'property' => 'question',
                'empty_option' => 'Security Question'
            ),
            'attributes' => array(
                'required' => true,
                
                'class' => 'form-control'
            )
        )
        );
        
        $this->add(array(
            'name' => 'answer',
            'type' => 'text',
            'options' => array(
                'label' => 'Security Answer'
            ),
            'attributes' => array(
                'required' => true,
                'class' => 'form-control',
                'placeholder' => 'Answer to Security Question'
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
            'username' => array(
                
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
                'validators' => array(
                    array(
                    
                        'name'=>'DoctrineModule\Validator\NoObjectExists',
                        'options'=>array(
                            'use_context'=>true,
                            'object_repository'=>$this->entityManager->getRepository('Csnuser\Entity\User'),
                            'object_manager'=>$this->entityManager,
                            'fields'=>'username',
                            'messages'=>array(
                               NoObjectExists::ERROR_OBJECT_FOUND =>'Someone else is registered with this Username',
                            )
                        )
                    ),
                    array(
                        'name' => 'Zend\Validator\StringLength',
                        'options' => array(
                            'min' => 5,
                            'max' => 256
                        )
                        // 'encoding'=>Utf8::
                        
                    )
                )
            ),
            // end of username filter
            
            'email' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'Zend\Filter\StringTrim'
                    )
                ),
                'validators' => array(
                    array (
                        'name' => 'Regex',
                        'options' => array(
                            'pattern'=>'/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/',
                            'messages' => array(
                                Regex::NOT_MATCH    => 'Please provide a valid email address.',
                            ),
                        ),
                        'break_chain_on_failure' => true
                    ),
                    array(
                    
                        'name'=>'DoctrineModule\Validator\NoObjectExists',
                        'options'=>array(
                            'use_context'=>true,
                            'object_repository'=>$this->entityManager->getRepository('Csnuser\Entity\User'),
                            'object_manager'=>$this->entityManager,
                            'fields'=>'email',
                            'messages'=>array(
                                NoObjectExists::ERROR_OBJECT_FOUND =>'Someone else is registered with this Email',
                            )
                        )
                    ),
                    array(
                        'name' => 'Zend\Validator\StringLength',
                        'options' => array(
                            'messages' => array(),
                            'min' => 3,
                            'max' => 256
                        ),
                        
                        array(
                            'name' => 'EmailAddress',
                            // Enter optiions for this validator here
                            'options' => array(
                                'messages' => array(
                                    EmailAddress::INVALID_FORMAT => 'Please check your email something is not right'
                                )
                            )
                            
                        )
                    )
                )
            ), // End of email validator
            'password' => array(
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
                        'name' => 'StringLength',
                        'options' => array(
                            'min' => 6,
                            'max' => 25,
                            'encoding' => 'UTF-8',
                            'messages' => array(
                                StringLength::TOO_SHORT => 'Your Password is too short'
                            )
                        )
                    ),
                    array(
                        'name' => 'Zend\Validator\Regex',
                        
                        'options' => array(
                            'pattern' => '/^[a-zA-Z0-9 &-_\.,@#$%]/',
                            'messages' => array(
                                Regex::INVALID => 'Your Passowrd is invalid',
                                Regex::NOT_MATCH => 'Your password must contain at least /n a lowercase an uppercase and either of these characters &-_\.,@#$%'
                            )
                        )
                    )
                )
            ), // End of password
            
            'passwordVerify' => array(
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
                        'name' => 'Zend\Validator\Identical',
                        
                        'options' => array(
                            'token' => 'password',
                            'messages' => array(
                                Identical::NOT_SAME => 'The password do not match'
                            )
                        )
                        
                    )
                )
            ),
            'answer' => array(
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
                        'name' => 'StringLength',
                        'options' => array(
                            'min' => 1,
                            
                            'messages' => array(
                                StringLength::TOO_SHORT => 'Your Security answer cannot be empty '
                            )
                        )
                    )
                )
            )
        )
        ;
    }

   

    /**
     * get entityManager
     *
     * @return Doctrine\ORM\EntityManager
     */
    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

?>