<?php
namespace Transactions\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Transactions\Entity\ManualPayment;

/**
 * This class provides a form for the admin to manually enter a payment by a customer
 * behalf of the customer 
 * @author otaba
 *        
 */
class ManualPaymentFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new ManualPayment());
        $this->addFields();
    }
    
    private function addFields(){
        $this->add(array(
            "name"=>"datePaid",
            "type"=>"date",
            "options"=>array(
                "label"=>"Date Paid",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-9 col-xs-12",
                "value"=>date("Y-m-d")
                // "required"=>"required"
            ),
        ));
        
        $this->add(array(
            "name" => "paymentMode",
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Payment Mode',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\ManualPaymentMode',
                'property' => 'mode',
                // 'empty_option' => '-- Select Package Type --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-9 col-xs-12',
                'id' => 'payment_mode',
                'required' => 'required',
                
                // 'value' => 1
            )
        ));
        
        $this->add(array(
            "name" => "currency",
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Currency: ',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\Currency',
                'property' => 'title',
                // 'empty_option' => '-- Select Package Type --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-9 col-xs-12',
                'id' => 'currency',
                'required' => 'required'
                // 'value' => 1
            )
        ));
        
        $this->add(array(
            "name" => "amountPaid",
            "type" => "text",
            "options" => array(
                'label' => "Amount Paid",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "amount_paid",
                "class" => "form-control col-sm-9 col-md-9 col-xs-12",
                'required' => "required"
            )
        ));
        
        $this->add(array(
            "name" => "checkNumber",
            "type" => "text",
            "options" => array(
                'label' => "Cheque Number",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "id" => "check_number",
                "class" => "form-control col-sm-9 col-md-9 col-xs-12",
//                 'required' => "required"
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
        
        return array(
            "checkNumber"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            ),
            "amountPaid"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            ),
            "currency"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            ),
            "paymentMode"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            ),
            "datePaid"=>array(
                "allow_empty"=>true,
                "required"=>FALSE
            ),
        );
    }
    
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
    
   
}

