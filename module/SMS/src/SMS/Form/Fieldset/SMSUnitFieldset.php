<?php
namespace SMS\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

/**
 * This fieldset get The number of SMS
 * @author swoopfx
 *        
 */
class SMSUnitFieldset extends Fieldset implements InputFilterProviderInterface
{

   public function init(){
       $this->addFields();
   }
   
   public function addFields(){
       $this->add(array(
           'name'=>'smsUnit',
           'type'=>'number',
           'options'=>array(
               'label'=>'SMS UNITS',
               'label_attributes'=>array(
                   'class'=>'control-label col-md-3 col-sm-3 col-xs-12'
               )
           ),
           'attributes'=>array(
               'class'=>'form-control col-sm-9 col-md-9 col-xs-12',
               'id'=>'sms_unit',
               'min'=>2000,
               'step'=>500,
               'required'=>'required',
               'value'=>2000,
               "data-ng-model"=>"topup",
               "data-ng-change"=>"onChangeSmsUnit(smsUnit)"
           ),
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

