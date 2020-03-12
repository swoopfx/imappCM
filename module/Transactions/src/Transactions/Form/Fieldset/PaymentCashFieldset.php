<?php
namespace Transactions\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Transactions\Entity\PaymentCash;

/**
 *
 * @author otaba
 *        
 */
class PaymentCashFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;
    
    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new PaymentCash())->setHydrator($hydrator);
        $this->addFieldset();
    }
    
    private function addFieldset(){
         $this->add(array(
            "name"=>"collectedBy",
            "type"=>"text",
            "options"=>array(
                "label"=>"Funds Collected By",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-9 col-xs-12",
                //"required"=>"required"
            ),
        ));
        
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
               // "required"=>"required"
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

