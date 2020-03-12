<?php
namespace Users\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

/**
 *This creates the interface for broker logo upload 
 * @author swoopfx
 *        
 */
class BrokerLogoUploadFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function init(){
        $this->addField();
    }
    
    private function addField(){
        $this->add(array(
            'name'=>'photoimg',
            'type'=>'file',
            'options'=>array(
                'label'=>'Logo Upload',
                'label_attributes'=>array(
                    'class'=>'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'attributes'=>array(
                    'class'=>'btn btn-default col-sm-9 col-md-9 col-xs-12',
                    'data-ng-model'=>'logo',
                    'id'=>'photoimg'
                ),
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

