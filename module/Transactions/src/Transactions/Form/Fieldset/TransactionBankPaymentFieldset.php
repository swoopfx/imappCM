<?php
namespace Transactions\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use Zend\Form\Element\DateSelect;

/**
 *
 * @author otaba
 *        
 */
class TransactionBankPaymentFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;

    public function init(){
       $this->addField();
    }
    
    private function addField(){
        $this->add(array(
            "name"=>"bank",
            "type"=>"DoctrineModule\Form\Element\ObjectSelect",
            "options"=>array(
                'label' => 'My Bank',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\NigeriaBanks',
                'property' => 'bankName',
                // 'empty_option' => '-- Select Package Type --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(
                            "isBank" => TRUE,
                            
                        )
                    )
                )
            ),
            "attributes"=>array(
                'class' => 'form-control col-md-9 col-xs-12',
                'id' => 'bank',
                "required"=>"required",
                
            ),
        ));
        
        $this->add(array(
            "name"=>"accNumber",
            "type"=>"number",
            'options'=>array(
                "label"=>"My Account Number",
//                 "label_attributes"=>array(
//                     'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
//                 )
            ),
            "attributes"=>array(
                //'class' => 'form-control col-md-9 col-xs-12',
                'id' => 'acc_number',
//                 'min' => "10",
//                 'max' => "10",
                "required"=>"required",
            ),
        ));
        
        $this->add(array(
            "name"=>"passcode_d", // passcode day
            "type"=>"text",
            "options"=>array(
                "label"=>"Date Of Birth",
                "label_attributes"=>array(
                    'class' => "control-label col-md-3 col-sm-3 col-xs-12"
                ),
            ),
            "attributes"=>array(
                'class' => 'form-control col-md-12 col-xs-12 col-sm-12',
                'id' => 'passcode_d',
                'placeholder' => 'DD',
                'minlength' => "2",
                'maxlength' => "2"
            ),
            
        ));
        
        $this->add(array(
            "name"=>"passcode_m", // passcode month
            "type"=>"text",
            "options"=>array(
                "label"=>"Date Of Birth",
                "label_attributes"=>array(
                    'class' => "control-label col-md-3 col-sm-3 col-xs-12"
                ),
            ),
            "attributes"=>array(
                'class' => 'form-control col-md-12 col-xs-12 col-sm-12',
                'id' => 'passcode_m',
                'placeholder' => 'MM',
                'minlength' => "2",
                'maxlength' => "2"
            ),
            
        ));
        
        $this->add(array(
            "name"=>"passcode_y", // passcode Year
            "type"=>"DateSelect",
           
            "options"=>array(
                "label"=>"Date Of Birth",
                "label_attributes"=>array(
                    'class' => "control-label col-md-3 col-sm-3 col-xs-12"
                ),
            ),
            "attributes"=>array(
                'class' => 'form-control col-md-12 col-xs-12 col-sm-12',
                'id' => 'passcode_d',
                'placeholder' => 'YYYY',
                'minlength' => "4",
                'maxlength' => "4"
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
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

