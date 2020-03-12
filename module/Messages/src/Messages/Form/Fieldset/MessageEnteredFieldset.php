<?php
namespace Messages\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Messages\Entity\MessageEntered;

/**
 *
 * @author otaba
 *        
 */
class MessageEnteredFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;

   public function init(){
       $hydrator = new DoctrineObject($this->entityManager);
       $this->setHydrator($hydrator)->setObject(new MessageEntered());
       $this->addField();
   }
   
   
   private function addField(){
       $this->add(array(
           "name"=>"messageText",
           "type"=>"text",
           "options"=>array(
               "label"=>"Message",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
               ),
           ),
           "attributes"=>array(
               "class"=>"form-control",
               "id"=>"message_text",
               "required"=>"required"
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

