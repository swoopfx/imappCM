<?php
namespace GeneralServicer\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class UploadFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function init()
    {
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            'name' => 'file',
            'type' => 'Zend\Form\Element\File',
            'options' => array(
                'label' => 'Upload',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'doc-upload',
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                'multiple' => true
            )
        ));
        
        $this->add(array(
            'name' => 'upload',
            'type' => 'submit',
            'options' => array(
            ),
            'attributes' => array(
                'value' => 'Upload',
                'class' => 'btn btn-white paper-shadow relative'
            )
        ));
    }

    public function getInputFilterSpecification()
    {
        return array();
    }
}