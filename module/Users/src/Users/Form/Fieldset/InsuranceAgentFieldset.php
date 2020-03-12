<?php
namespace Users\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Users\Entity\InsuranceAgent;
use Zend\Form\Element\Date;
use GeneralServicer\Form\Fieldset\DocumentFieldset;

/**
 *
 * @author swoopfx
 *        
 */
class InsuranceAgentFieldset extends Fieldset implements InputFilterProviderInterface
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
        $this->setHydrator($hydrator)->setObject(new InsuranceAgent());
        $this->addFields();
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

    private function addFields()
    {
        $this->add(array(
            'name' => 'agentName',
            'type' => 'text',
            'options' => array(
                'label' => 'Agents Name',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                'placeholder' => 'Enter full name or company name',
                'required' => 'required'
            )
            
        ));
        $this->add(array(
            'name' => 'agentProfile',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Agents Profile',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                'placeholder' => 'Provide a brief description of you and/or your company',
                'required' => 'required'
            )
        ));
        
        $this->agentAddress();
        
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
                'data-ng-bind' => '',
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                'id' => '',
                'required' => 'required',
                'placeholder' => 'A01454567'
            )
        ));
        $this->add(array(
            'name' => 'identityType',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Type Of Identification',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\IdentityType',
                'property' => 'identityType',
                
                'empty_option' => '-- Select Identification Type --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12'
            )
        ));
        
        $this->add(array(
            'name' => 'issuanceDate',
            'type' => 'Zend\Form\Element\Date',
            'options' => array(
                'label' => 'Issue Date',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'format' => 'Y-m-d'
            ),
            'attributes' => array(
                'min' => '2000-01-01',
                'step' => '1'
            )
            
        ));
        
        $this->add(array(
            'name' => 'expiryDate',
            'type' => 'Zend\Form\Element\Date',
            'options' => array(
                'label' => 'Expire Date',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'format' => 'Y-m-d'
            ),
            'attributes' => array(
                'min' => '2000-01-01',
                'step' => '1'
            )
            
        ));
        
        $this->agentBankAccount();
        $this->agentDocument();
    }

    private function agentAddress()
    {
        $this->add(array(
            'name' => 'agent_address_fieldset',
            'type' => 'Users\Form\Fieldset\AgentAddressFieldset'
        ));
    }

    private function agentDocument()
    {
        $this->add(array(
            'name' => 'agents_verify_doc',
            'type' => 'GeneralServicer\Form\Fieldset\DocumentFieldset'
        ));
    }

    private function agentBankAccount()
    {
        $this->add(array(
            'name' => 'agent_bank_account',
            'type' => 'Users\Form\Fieldset\AgentBankAccountFieldset'
        ));
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

?>