<?php
namespace Transactions\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use Zend\Form\Element\Hidden;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Transactions\Entity\UserCard;

class UserCardPaymentFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new UserCard())->setHydrator($hydrator);
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            'name' => 'save_cc',
            'type' => 'checkbox',
            'options' => array(
                'label' => '.',
                'use_hidden_element' => true,
                'checked_value' => true,
                'unchecked_value' => false
                // 'label_attributes'=>array(
                // 'class'=>'control-label col-md-3 col-sm-3 col-xs-12',
                // )
            ),
            'attributes' => array(
                'id' => 'save_cc',
                "value" => false
                // 'class'=>'form-control col-sm-8 col-md-8 col-xs-12 col-md-offset-2',
                // 'placeholder' => 'John Doe',
                // 'required' => 'required'
            
            )
        ));
        
        $this->add(array(
            'name' => 'cc_name',
            'type' => 'text',
            'options' => array(
                'label' => 'Name On Card :'
                // 'label_attributes'=>array(
                // 'class'=>'control-label col-md-3 col-sm-3 col-xs-12',
                // )
            ),
            'attributes' => array(
                'id' => 'name',
                // 'class'=>'form-control col-sm-8 col-md-8 col-xs-12 col-md-offset-2',
                // 'placeholder' => 'John Doe',
                'required' => 'required'
            
            )
        ));
        $this->add(array(
            'name' => 'cc_number',
            'text' => 'text',
            'options' => array(
                'label' => 'Card Number :'
                // 'label_attributes'=>array(
                // 'class'=>'control-label col-md-3 col-sm-3 col-xs-12'
                // ),
            ),
            'attributes' => array(
                // 'class'=>'form-control col-sm-8 col-md-8 col-xs-12 col-md-offset-2',
                'id' => 'number',
                // 'placeholder' => 'Card Number',
                'required' => 'required'
            
            )
        ));
        
        $this->add(array(
            'name' => 'cc_cvc',
            'type' => 'text',
            'options' => array(
                'label' => 'CVV Code:'
                // 'label_attributes'=>array(
                // 'class'=>'control-label col-md-3 col-sm-3 col-xs-12'
                // )
            ),
            'attributes' => array(
                // 'class'=>'form-control col-sm-8 col-md-5 col-xs-12 col-md-offset-2',
                'id' => 'cvc',
                'required' => 'required',
                'placeholder' => '123',
                'minlength' => "3",
                'maxlength' => "4"
            )
        
        ));
        $this->add(array(
            'name' => 'amount',
            'type' => 'hidden'
        
        ));
        
        $this->add(array(
            'name' => 'currency',
            'type' => 'Zend\Form\Element\Hidden'
        
        ));
        
        $this->add(array(
            'name' => 'country',
            'type' => 'Zend\Form\Element\Hidden'
        ));
        
        $this->add(array(
            'name' => 'invoice',
            'type' => 'Zend\Form\Element\Hidden'
        ));
        
//         $this->add(array(
//             'name' => 'cc_pin',
//             'type' => 'password',
//             'options' => array(
//                 'label' => 'Card Pin :'
//                 // 'label_attributes'=>array(
//                 // 'class'=>'control-label col-md-3 col-sm-3 col-xs-12'
//                 // )
//             ),
//             'attributes' => array(
//                 // 'class'=>'form-control col-sm-8 col-md-8 col-xs-12 col-md-offset-2',
//                 'id' => 'pin',
                
//                 'minlength' => "3",
//                 'maxlength' => "4"
//                 // 'required' => 'required',
//                 // "placeholder" => "Card Pin"
//             )
//         ));
        
        $this->add(array(
            'name' => 'cc_month',
            'type' => 'text',
            'options' => array(
                'label' => 'Expiry Date :'
                // 'label_attributes'=>array(
                // 'class'=>'control-label col-md-3 col-sm-3 col-xs-12'
                // )
            ),
            'attributes' => array(
                // 'class'=>'form-control col-sm-8 col-md-8 col-xs-12 col-md-offset-2',
                'id' => 'cc_month',
                'required' => 'required',
                'placeholder' => 'MM',
                'minlength' => "2",
                'maxlength' => "2"
            )
        ));
        
        $this->add(array(
            'name' => 'cc_year',
            'type' => 'text',
            'options' => array(
                'label' => 'Expiry Date :'
                // 'label_attributes'=>array(
                // 'class'=>'control-label col-md-3 col-sm-3 col-xs-12'
                // )
            ),
            'attributes' => array(
                // 'class'=>'form-control col-sm-8 col-md-8 col-xs-12 col-md-offset-2',
                'id' => 'expiry',
                'required' => 'required',
                'placeholder' => 'YY',
                'minlength' => "2",
                'maxlength' => "2"
            )
        ));
        
        // $this->add(array(
        // 'name'=>'expiry',
        // 'type'=>'Zend\Form\Element\MonthSelect',
        // 'options'=>array(
        // 'label'=>'Expiry Date :',
        // 'label_attributes'=>array(
        // 'class'=>'control-label col-md-3 col-sm-3 col-xs-12'
        // ),
        // "month_attributes"=>array(
        // 'class'=>'form-control col-sm-2 col-md-2 col-xs-2 col-md-offset-2',
        // 'id'=>'expiry',
        // "style"=>"width: 30%; ",
        // ),
        // "year_attributes"=>array(
        // 'class'=>'form-control col-sm-2 col-md-2 col-xs-2 col-md-offset-2',
        // 'id'=>'expiry',
        // "style"=>"width: 30%;",
        // ),
        // 'min_year' => date('Y'),
        // 'max_year'=>date("Y")+10,
        // ),
        // 'attributes'=>array(
        // //'class'=>'form-control col-sm-12 col-md-12 col-xs-12 ',
        
        // 'id'=>'expiry',
        // 'required'=>'required',
        // 'placeholder'=>'MM/YY'
        // ),
        // ));
        
        // $this->add(array(
        // 'name'=>'expirydate',
        // 'type'=>'Zend\Form\Element\MonthSelect',
        // 'options'=>array(
        // 'label' => ' Card Expiry Date :',
        
        // 'create_empty_option' => true,
        // 'min_year' => date('Y'),
        // 'max_year' => date('Y') + 10,
        // 'month_element'=> new Select('month'),
        // 'label_attributes' => array(
        // 'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
        // ),
        // 'month_attributes' => array(
        // 'placeholder' => 'Month',
        // 'style' => 'width: 40%',
        // 'class' => 'form-control col-md-3 col-xs-12',
        // 'empty_option' => '-- Month --'
        // ),
        // 'year_attributes' => array(
        // 'create_empty_option' => true,
        // 'placeholder' => 'Year',
        // 'style' => 'width: 40%',
        // 'class' => 'form-control col-md-3 col-sm-3 col-xs-12',
        // 'empty_option' => '-- Year --'
        // ),
        // ),
        // 'attributes'=>array(
        // 'required'=>'required',
        // 'class'=>'form-control col-sm-6 col-md-6 col-xs-12',
        // ),
        
        // ));
    }

    public function getInputFilterSpecification()
    {
        return array();
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

