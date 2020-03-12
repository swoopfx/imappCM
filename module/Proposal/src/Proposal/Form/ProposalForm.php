<?php
namespace Proposal\Form;

use Zend\Form\Form;

/**
 *
 * @author swoopfx
 *        
 */
class ProposalForm extends Form
{

    
    
    public function init(){
        $this->setAttributes(array(
            //'action'=>'/proposal/create',
            'method'=>'POST',
            "data-ng-controller"=>"proposalForm",
            'class' => 'form-horizontal form-label-left',
            "autocomplete"=>"off"
           
            
        ));
        $this->addFeilds();
        $this->addCommon();
       
        
    }
    
    private function addFeilds(){
        $this->add(array(
            'name'=>'proposalFieldset',
            'type'=>'Proposal\Form\Fieldset\ProposalFieldset',
            'options'=>array(
                'use_as_base_fieldset'=>true
            ),
        ));
    }
    
    
    private function addCommon()
    {
        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
            'options' => array(
                 
            )
        ));
        $this->add(array(
            'name' => 'reset',
            'type' => 'Zend\Form\Element',
            'options' => array()
    
            ,
            'attributes' => array(
                'class' => 'btn btn-success',
                'value' => 'Reset',
                'id' => 'reset'
            )
        ));
    
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Submit',
                'class' => 'btn btn-lg btn-primary btn-block'
            )
        ));
    }
}

