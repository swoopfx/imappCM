<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\PerformanceBond;

/**
 *
 * @author otaba
 *        
 */
class PerformanceBondFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;

    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new PerformanceBond())->setHydrator($hydrator);
        
        $this->add(array(
            "name"=>"advancedBondFieldset",
            "type"=>"IMServices\Form\Fieldset\AdvancedPaymentBondFieldset",
            
        ));
        
        $this->add(array(
            "name"=>""
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

