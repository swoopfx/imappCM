<?php
namespace GeneralServicer\Form;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class UploadForm extends Form implements InputFilterProviderInterface
{

    public function init()
    {
        $this->setAttributes(array(
            "method" => "POST",
            "action" => "/proposal/upload",
            "id" => "fileupload",
//             "class"=>"ajax_element",
//             "data-ajax-loader"=>"myLoader"
        ));
        $this->uploadField();
    }

    private function uploadField()
    {
        $this->add(array(
            "name" => "file",
            "type" => "file",
            "options" => array(),
            "attributes" => array(
                "multiple" => true,
                "required"=>"required",
                "id"=>"file"
            )
        ));
        
        $this->add(array(
            'name' => 'upload',
            'type' => 'submit',
            'options' => array(),
            'attributes' => array(
                'value' => 'UPLOAD',
                "id" => "btnSubmit",
                "class" => "btn btn-block btn-xs btn-primary btnSubmit"
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
        return array();
    }
}

