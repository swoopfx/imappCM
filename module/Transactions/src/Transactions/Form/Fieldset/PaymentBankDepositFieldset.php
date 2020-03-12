<?php
namespace Transactions\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Transactions\Entity\PaymentBankDeposit;

/**
 *
 * @author otaba
 *        
 */
class PaymentBankDepositFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new PaymentBankDeposit())->setHydrator($hydrator);
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            "name" => "bank",
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Bank Paid To',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\NigeriaBanks',
                'property' => 'bankName',
                // 'empty_option' => '-- Select Package Type --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-9 col-xs-12',
                'id' => 'value_typer',
               // 'required' => 'required'
                // 'value' => 1
            )
        ));
        
//         $this->add(array(
//             "name" => "amountPaid",
//             "type" => "text",
//             "options" => array(
//                 "label" => "Amount Paid",
//                 "label_attributes" => array(
//                     "class" => "control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes" => array(
//                 "required" => "required",
//                 "class" => "",
//                 "id" => "",
//                 "required" => "required"
            
//             )
//         ));
        
        $this->add(array(
            "name" => "depositDate",
            "type" => "date",
            "options" => array(
                "label" => "Deposit Date",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                "class" => "form-control col-md-9 col-xs-12",
                //'min' => date("Y-m-d") - 10,
                //'max' => date("Y-m-d") + 10,
               // "required" => "required"
            )
        ));
        $this->add(array(
            "name" => "depositorName",
            "type" => "text",
            "options" => array(
                "label" => "Depositors Name ",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            
            ),
            "attributes" => array(
                "class" => "form-control col-md-9 col-xs-12",
                //"required" => "required"
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
    
    public function setEnityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

