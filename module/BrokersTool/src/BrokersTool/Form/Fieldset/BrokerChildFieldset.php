<?php
namespace BrokersTool\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use GeneralServicer\Entity\BrokerChild;

class BrokerChildFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new BrokerChild());
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            'name' => 'firstname',
            'type' => 'text',
            'options' => array(
                'label' => 'Staff First Name',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-sm-9 col-md-9 col-xs-12 ',
                'placeholder' => 'John',
                'id' => 'user_firstname',
                'required' => 'required'
            )
        ));
        
        $this->add(array(
            'name' => 'lastname',
            'type' => 'text',
            'options' => array(
                'label' => 'Staff LastName',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-sm-9 col-md-9 col-xs-12',
                'placeholder' => 'Doe',
                'id' => 'user_lastname',
                'required' => 'required'
            )
        ));
        
        $this->add(array(
            'name' => 'facebook',
            'type' => 'url',
            'options' => array(
                'label' => 'Facebook link',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-sm-9 col-md-9 col-xs-12',
                'placeholder' => 'http://facebook.com/xyz',
                'id' => 'facebook',
                //'required' => 'required'
            )
        ));
        
        $this->add(array(
            'name' => 'linkedIn',
            'type' => 'text',
            'options' => array(
                'label' => 'linkedIn link',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-sm-9 col-md-9 col-xs-12',
                'placeholder' => 'http://linkedin.com/xyz',
                'id' => 'linkedIn',
                //'required' => 'required'
            )
        ));
        
        $this->add(array(
            'name' => 'tweeter',
            'type' => 'text',
            'options' => array(
                'label' => 'Twitter link',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-sm-9 col-md-9 col-xs-12',
                'placeholder' => 'http://twitter.com/xyz',
                'id' => 'tweeter',
                //'required' => 'required'
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
            'firstname' => array(
                'required' => true,
                'allow_empty' => false,
                'filters'=>array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
            ),
            
            'lastname' => array(
                'required' => true,
                'allow_empty' => false,
                'validators' => array(),
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
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

