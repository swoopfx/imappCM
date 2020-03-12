<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\PublicLiabilityEmployeeDetails;

/**
 *
 * @author otaba
 *        
 */
class PublicLiabityEmployeeDetailsFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;

   public function init(){
       $hydrator = new DoctrineObject($this->entityManager);
       $this->setHydrator($hydrator)->setObject(new PublicLiabilityEmployeeDetails);
       
       $this->add(array(
           "name" => "noOfEmployees",
           "type" => "text",
           "options" => array(
               "label" => "No. of Employees",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes" => array(
               "class" => "form-control col-md-7 col-xs-12",
               "id" => "noOfEmployees"
           )
       ));
       
       $this->add(array(
           "name" => "natureOfWork",
           "type" => "textarea",
           "options" => array(
               "label" => "Nature Of Work",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes" => array(
               "class" => "form-control col-md-7 col-xs-12",
               "id" => "natureOfWork"
           )
       ));
       
       $this->add(array(
           "name" => "insuranceConnection",
           "type" => "textarea",
           "options" => array(
               "label" => "Connection With Insurance Company",
               "label_attributes" => array(
                   "class" => "control-label col-md-3 col-sm-3 col-xs-12"
               )
           ),
           "attributes" => array(
               "class" => "form-control col-md-7 col-xs-12",
               "id" => "insuranceConnection"
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
    /**
     * @return the $entityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @param field_type $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
    }

}

