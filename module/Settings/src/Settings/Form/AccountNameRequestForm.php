<?php
namespace Settings\Form;

use Zend\Form\Form;

/**
 *
 * @author otaba
 *        
 */
class AccountNameRequestForm extends Form
{

    private $entityManager;

    public function init()
    {
        $this->setAttributes(array(
            "class" => "form-horizontal form-label-left ",
            'id' => "accountRequestForm",
          
            //'action' => "accountName",
            //'data-ajax-loader' => "myLoader"
        ));
        $this->addCommon();
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            'name' => 'bankName',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => "Bank Name",
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\NigeriaBanks',
                'property' => 'bankName',
                'empty_option' => '-- Select Your Bank --'
            ),
            'attributes' => array(
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                'required' => 'required'
            )
        ));
        
        $this->add(array(
            'name' => 'bankAccountNo',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Bank Account Number (NUBAN) ',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
                'id' => 'accountno',
                'placeholder' => '0001989898',
                'required' => 'required'
            )
        
        ));
    }
    
    private function addCommon()
    {
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Get Account Name',
                'class' => 'btn btn-success',
                'id' => 'ajaxStart',
                "style"=>"width: 50%",
               // "onclick"=>"this.disabled = true"
            )
        ));
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

