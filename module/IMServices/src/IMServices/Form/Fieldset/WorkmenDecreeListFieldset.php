<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\WorkmenDecreeList;

/**
 *
 * @author otaba
 *        
 */
class WorkmenDecreeListFieldset extends Fieldset implements InputFilterProviderInterface
{
    private $entityManager;

   public function init(){
       $hydrator = new DoctrineObject($this->entityManager);
       $this->setObject(new WorkmenDecreeList())->setHydrator($hydrator);
       
       $this->add(array(
           "name"=>"employeeCategoree",
           'type' => 'DoctrineModule\Form\Element\ObjectSelect',
           'options' => array(
               'label' => 'Employee Category',
               'label_attributes' => array(
                   'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
               ),
               'object_manager' => $this->entityManager,
               'target_class' => 'Settings\Entity\GroupLifeMemberClass',
               // 'empty_option' => '-- Select a Proposed Insurer --',
               'property' => 'class'
               
           ),
           'attributes' => array(
               'id' => 'employeeCategoree',
               'class' => 'form-control'
           )
       ));
       
       $this->add(array(
           
           "name"=>"numberOfEmployee",
           "type"=>"number",
           "options"=>array(
               "label"=>"Number of employees",
               "label_attributes"=>array(
                   "class"=>'control-label col-md-4 col-sm-4 col-xs-12'
               )
           ),
           "attributes"=>array(
               "id"=>"numberOfEmployee",
               "class"=>"form-control",
               "placeholder"=>0,
               "min"=>0
           )
       ));
       
       $this->add(array(
           
           "name"=>"cashCompensation",
           "type"=>"text",
           "options"=>array(
               "label"=>"Cash Compensation",
               "label_attributes"=>array(
                   "class"=>'control-label col-md-4 col-sm-4 col-xs-12'
               )
           ),
           "attributes"=>array(
               "id"=>"cashCompensation",
               "class"=>"form-control",
              
           )
       ));
       
       $this->add(array(
           
           "name"=>"otherCompensation",
           "type"=>"text",
           "options"=>array(
               "label"=>"Other Compensation",
               "label_attributes"=>array(
                   "class"=>'control-label col-md-4 col-sm-4 col-xs-12'
               )
           ),
           "attributes"=>array(
               "id"=>"otherCompensation",
               "class"=>"form-control",
               
           )
       ));
       
       $this->add(array(
           "name"=>"totalCompensation",
           "type"=>"text",
           "options"=>array(
               "label"=>"Total Compensation",
               "label_attributes"=>array(
                   "class"=>'control-label col-md-4 col-sm-4 col-xs-12'
               )
           ),
           "attributes"=>array(
               "id"=>"totalCompensation",
               "class"=>"form-control",
               
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

