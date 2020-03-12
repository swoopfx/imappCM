<?php
namespace Proposal\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

/**
 *
 * @author swoopfx
 *        
 */
class SelectCustomerFieldset extends Fieldset implements InputFilterProviderInterface
{

   public function init(){
       $this->addFields();
   }
   
   
   private function addFields(){
       $this->add(array(
           'name'=>'customer',
           'type'=>'',
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

