<?php
namespace Messages\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Messages\Entity\Messages;

/**
 *
 * @author otaba
 *        
 */
class Massagefieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityMager;
    
    public function init(){
        $hydrator = new DoctrineObject($this->entityMager);
        $this->setHydrator($hydrator)->setObject(new Messages());
    }
    
    private function addFields(){
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
    {}
    
    public function setEntityManager($em){
        $this->entityMager = $em;
        return $this;
    }
}

