<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

/**
 *
 * @author otaba
 *        
 */
class GroupLifeBenficiaryFieldset extends Fieldset implements InputFilterProviderInterface
{
    private $entityManager;

   public function init(){
       
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
    
    private function setEntityManager($em){
        $this->entityManager = $em;
        return  $this;
    }
    
}

