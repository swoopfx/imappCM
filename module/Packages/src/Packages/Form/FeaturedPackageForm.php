<?php
namespace Packages\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class FeaturedPackageForm extends Form
{

    public function init()
    {
        $this->setAttributes(array(
            "method" => "POST",
            "class" => "form-horizontal form-label-left"
        ));
        $this->addFields();
        $this->addCommon();
    }

    private function addFields()
    {
        $this->add(array(
            "name" => "featuredPackageFieldset",
            "type" => "Packages\Form\Fieldset\FeaturedPackagesFieldset",
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
    }

    private function addCommon()
    {
        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
            'options' => array()
        ));
        $this->add(array(
            'name' => 'reset',
            'type' => 'Zend\Form\Element',
            'options' => array(),
            
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
                // 'type' => 'submit',
                'value' => 'Update Packages',
                'class' => 'btn btn-primary btn-block'
            
            )
        ));
    }
}

