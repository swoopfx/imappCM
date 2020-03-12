<?php
namespace Users\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use GeneralServicer\Entity\BrokerBankAccount;
use Settings\Entity\NigeriaBanks;
use Zend\Form\Element\Number;

/**
 *
 * @author swoopfx
 *        
 */
class InsuranceBrokerBankAccountFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new BrokerBankAccount());
    }

    private function addFields()
    {
        $this->add(array(
            'name' => 'bankName',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Brokers Bank',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'empty_option' => '--- Select a your bank',
                'object_manager' => $this->entityManager,
                'target_class' => 'Settings\Entity\NigeriaBanks',
                'property' => 'bankName'
            ),
            'attributes' => array(
                'id' => 'form_status',
                'class' => 'form-control col-md-9 col-xs-12',
                
                'placeholder' => 'Unsaved'
            )
        ));
        $this->add(array(
            'name' => 'accountName',
            'type' => 'text',
            'options' => array(
                'label' => 'Name Of Account',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'account_name',
                'required' => 'required',
                'class' => 'form-control col-md-9 col-xs-12',
                'title' => 'Give a descriptive name to your Offer proposal',
                'placeholder' => 'Kolawole Enterprise Limited'
            )
        ));
        $this->add(array(
            'name' => 'bankAccountNo',
            'type' => 'Zend\Form\Element\Number',
            'options' => array(
                'label' => 'Name Of Offer',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'bank_account_no',
                'required' => 'required',
                'class' => 'form-control col-md-9 col-xs-12',
                'title' => 'Give a descriptive name to your Offer proposal',
                'placeholder' => 'E.g My Nissan SUV cover'
            )
        ));
        $this->add(array(
            'name' => 'swiftCode',
            'type' => 'text',
            'options' => array(
                'label' => 'Bank Swift Code',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'bank_account_no',
                'required' => 'required',
                'class' => 'form-control col-md-9 col-xs-12',
                'title' => 'Give a descriptive name to your Offer proposal',
                'placeholder' => 'E.g My Nissan SUV cover'
            )
        ));
        $this->add(array(
            'name' => 'sortCode',
            'type' => '',
            'options' => array(
                'label' => 'Bank Sort Code',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'bank_account_no',
                'required' => 'required',
                'class' => 'form-control col-md-9 col-xs-12',
                'title' => 'Give a descriptive name to your Offer proposal',
                'placeholder' => 'E.g My Nissan SUV cover'
            )
        ));
        $this->add(array(
            'name' => 'bankAddress',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Bank Sort Code',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'id' => 'bank_account_no',
                'required' => 'required',
                'class' => 'form-control col-md-9 col-xs-12',
                'title' => 'Give a descriptive name to your Offer proposal',
                'placeholder' => 'E.g My Nissan SUV cover'
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

