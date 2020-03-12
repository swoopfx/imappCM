<?php
namespace Transactions\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Transactions\Entity\PaymentTransfer;

/**
 *
 * @author otaba
 *        
 */
class PaymentTransferFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;
    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new PaymentTransfer())->setHydrator($hydrator);
        $this->addFields();
        
    }
    
    private function addFields(){
        $this->add(array(
            "name" => "bank",
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Transfered To',
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
                //'required' => 'required'
                // 'value' => 1
            )
        ));
        
        $this->add(array(
            "name"=>"transferFrom",
            "type"=>"text",
            "options"=>array(
                "label"=>"Transfered By",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
                ),
            ),
            "attributes"=>array(
                "class"=>"form-control col-sm-9 col-md-9 col-xs-12",
                //"required"=>"required",
                "placeholder"=>"ZUBAI INTRENATINAL LIMITED"
            )
        ));
        
        $this->add(array(
            "name"=>"transferDate",
            "type"=>"date",
            "options"=>array(
                "label"=>"Date of Transfer",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-sm-9 col-md-9 col-xs-12",
                //"required"=>"required"
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
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

