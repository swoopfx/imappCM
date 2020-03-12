<?php
namespace Transactions\Form;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Transactions\Entity\TransactionManualProcess;

/**
 *
 * @author otaba
 *        
 */
class TransactionManualProcessForm extends Form implements InputFilterProviderInterface
{

    private $entityManager;

    /**
     */
    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new TransactionManualProcess())
            ->setHydrator($hydrator)
            ->setAttributes(array(
            "method" => "POST",
                'class' => 'form-horizontal form-label-left',
                "novalidate"=>true,
                'data-ng-controller'=>"manualPayment",
                "data-parsley-validate"=>true
        ));
        $this->addFields();
        $this->addCommon();
    }

    private function addFields()
    {
        $this->add(array(
            "name" => "paymentMode",
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Select Payment Mode',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\PaymentMode',
                'property' => 'paymentMode',
                // 'empty_option' => '-- Select Package Type --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-9 col-xs-12',
                'id' => 'value_typer',
                'required' => 'required',
                'data-ng-model' => 'selectedService',
                'data-ng-change' => 'onPaymentChange(selectedService)'
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
                'id' => 'value_typer',
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
                "id" => "",
                "class" => "form-control col-sm-9 col-md-9 col-xs-12",
                'required' => "required"
            )
        ));
        
        $this->add(array(
            "name" => "bankDeposit",
            "type" => "Transactions\Form\Fieldset\PaymentBankDepositFieldset"
        ));
        
        $this->add(array(
            "name" => "cash",
            "type" => "Transactions\Form\Fieldset\PaymentCashFieldset"
        ));
        
        $this->add(array(
            "name" => "bankTransfer",
            "type" => "Transactions\Form\Fieldset\PaymentTransferFieldset"
        ));
    }

    public function addCommon()
    {
        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 600
                )
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'SEND NOTIFICATION',
                'class' => 'btn btn-lg btn-primary btn-block',
                'id' => 'pay-now'
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

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

