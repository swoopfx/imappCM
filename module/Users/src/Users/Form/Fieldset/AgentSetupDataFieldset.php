<?php
namespace Users\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Users\Entity\InsuranceAgent;

/**
 *
 * @author swoopfx
 *        
 */
class AgentSetupDataFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrate = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrate)->setObject(new InsuranceAgent());
        $this->addFieldset();
    }

    public function addFieldset()
    {
        $this->add(array(
            'name' => 'agentName',
            'type' => 'text',
            'options' => array(
                'label' => 'Agent Name',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-7 col-xs-12',
                'placeholder' => 'Unsaved'
            )
        ));
        
        $this->add(array(
            'name' => 'agentProfile',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Agent Profile'
            ),
            'attributes' => array(
                'placeholder' => 'Provide a well detailed profile for your customers and prospective to read through. This would stand a a description of who you are ',
                'class'=>'form-control col-md-7 col-xs-12',
                
            )
        ));
        
        $this->add(array(
            'name' => 'identityType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Identity Type',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'empty_option' => '-- Select an Identity Type --',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Insurer',
                'property' => 'identityType'
            ),
            'attributes' => array(
                'class' => 'form-control col-md-7 col-xs-12'
            )
        ));
        
        $this->add(array(
            'name' => 'identificationNo',
            'type' => 'text',
            'options' => array(
                'label' => 'Identification Number',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-7 col-xs-12',
                'required' => 'required'
            )
        ));
        $this->add(array(
            'name' => 'issuanceDate',
            'type' => 'date',
            'options' => array(
                'label' => 'Date Of Issue',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-7 col-xs-12',
                'required' => 'required',
                'id' => ''
            )
        ));
        
        $this->add(array(
            'name' => 'expiryDate',
            'type' => 'date',
            'options' => array(
                'label' => 'Expiry Date',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-7 col-xs-12',
                'required' => 'required',
                'id' => ''
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
            'agentName'=>array(
                'required'=>true,
                'allow_empty'=>false,
                'filters'=>array(),
                'validators'=>array(),
            ),
        );
    }
    
    // Begin Setters
    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
    // End Setter
}

