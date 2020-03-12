<?php
namespace Users\Form;

use Zend\Form\Form;

/**
 * This form is used to deine the setup of the agent
 *
 * @author swoopfx
 *        
 */
class AgentSetupForm extends Form
{

    protected $entityManager;

    /**
     */
    public function init()
    {
        $this->setAttributes(array(
            'name' => 'agentsetupForm',
            'action' => '',
            'method' => 'post',
            'enctype' => 'multipart/form-data',
            'class' => 'form-horizontal form-label-left'
        ));
        $this->agentProfile();
        $this->setUpacceptCheck();
        $this->addCommon();
        $this->agentPackages();
    }

    private function addCommon()
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
            'name' => 'reset',
            'type' => 'Zend\Form\Element',
            'options' => array(),
            
            'attributes' => array(
                'class' => 'btn btn-primary',
                'value' => 'Reset',
                'id' => 'reset'
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Create',
                'class' => 'btn btn-success',
                'id' => 'create-object'
            )
        ));
    }

    private function setUpacceptCheck()
    {
        $this->add(array(
            'name' => 'acceptance',
            'type' => 'Users\Form\Fieldset\AcceptanceFieldset'
        ));
    }

    private function agentProfile()
    {
        $this->add(array(
            'name' => 'agent_profile',
            'type' => 'Users\Form\Fieldset\InsuranceAgentFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
    }

    private function agentPackages()
    {
        $this->add(array(
            'name' => 'agent_packages',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Available Packages',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Packages',
                'property' => 'packageName',
                'empty_option' => '-- Select a Package --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                // 'is_method'=>true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(
                            'packageCategory' => 2
                        )
                    )
                    
                )
            ),
            'attributes' => array(
                'required' => 'required',
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                'data-ng-change' => 'selectPackages(packageId)'
            )
        ));
    }
}

?>