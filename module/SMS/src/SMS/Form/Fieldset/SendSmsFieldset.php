<?php
namespace SMS\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

/**
 *
 * @author otaba
 *        
 */
class SendSmsFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManage;

    public function init()
    {
        $this->addField();
    }

    private function addField()
    {
        
        $this->add(array(
            'name'=>"smsType",
            'type'=>"select",
            'options'=>array(
                'label'=>'SMS Type',
                'label_attributes'=>array(
                    'class'=>'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'atrributes'=>array(
                'value_options'=>array(
                    '0'=>"Send TO One Customer",
                    '1'=>"Send To Many Customers",
                    "2"=>"Send To One Phone Number",
                    "3"=>"Send To Many Phone Numbers"
                )
            ),
            
        ));
        /**
         * This selects the customers for
         */
        $this->add(array(
            'name' => 'customer',
            'type' => 'text',
            'options' => array(
                'label' => 'Customers',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array()
        ));
        
        $this->add(array(
            'name' => 'onePhoneNumber',
            'type' => 'text',
            'options' => array(
                'label' => 'Single Phone Number',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array()
        ));
        
        $this->add(array(
            'name'=>'manyPhoneNumbers',
            'type'=>'textarea',
            'options'=>array(),
            'attributes'=>array(),
        ));
        
        $this->add(array(
            'name' => 'smsMessages',
            'type' => 'textarea',
            'options' => array(
                'label' => 'SMS Messages',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array()
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
    
    public function setEntityManager($ekm){
        $this->entityManage = $ekm;
        return $this;
    }
}

