<?php
namespace Claims\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Claims\Entity\ClaimsCashInTransit;

/**
 *
 * @author otaba
 *        
 */
class ClaimsCashInTransitFiledset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;

   public function init(){
       $hydrator = new DoctrineObject($this->entityManager);
       $this->setHydrator($hydrator)->setObject(new ClaimsCashInTransit());
       
       $this->add(array(
           'name' => 'claims',
           'type' => 'Claims\Form\Fieldset\ClaimsFieldset'
       ));
   
       $this->add(array(
           "name"=>"lossDate",
           "type"=>"date",
           "options"=>array(
               "label"=>"Date of Loss",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"lossDate",
               "class"=>"form-control col-xs-12", 
               "required"=>"required",
           ),
       ));
       
       $this->add(array(
           "name"=>"lossByWhom",
           "type"=>"text",
           "options"=>array(
               "label"=>"Loss By Whom",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"lossByWhom",
               "class"=>"form-control col-xs-12",
               "required"=>"required",
           ),
       ));
       
       $this->add(array(
           "name"=>"isPolice",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Has notified the police",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"isPolice",
               "class"=>" col-xs-12",
//                "required"=>"required",
           ),
       ));
       
       
       $this->add(array(
           "name"=>"policeContactDate",
           "type"=>"date",
           "options"=>array(
               "label"=>"Date police was notified",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"policeContactDate",
               "class"=>"form-control col-xs-12",
//                "required"=>"required",
           ),
       ));
       
       $this->add(array(
           "name"=>"isPoliceReport",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Police report was issued",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"isPoliceReport",
               "class"=>"col-xs-12",
               "checked"=>true
           ),
       ));
       
       
       $this->add(array(
           "name"=>"policeStation",
           "type"=>"text",
           "options"=>array(
               "label"=>"Police Station location",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"policeStation",
               "class"=>"form-control col-xs-12",
//                "checked"=>true
           ),
       ));
       
       
       $this->add(array(
           "name"=>"recoveryStep",
           "type"=>"textarea",
           "options"=>array(
               "label"=>"Steps taken for recovery",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"recoveryStep",
               "class"=>"form-control col-xs-12",
               "checked"=>true
           ),
       ));
       
       
       $this->add(array(
           "name"=>"employeeInCharge",
           "type"=>"text",
           "options"=>array(
               "label"=>"Name of employee in charge",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"employeeInCharge",
               "class"=>"form-control col-xs-12",
               "checked"=>true
           ),
       ));
       
       $this->add(array(
           "name"=>"employeeServiceYears",
           "type"=>"number",
           "options"=>array(
               "label"=>"Number of years employee in service",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"employeeServiceYears",
               "class"=>"form-control col-xs-12",
               "min"=>1
//                "checked"=>true
           ),
       ));
       
       $this->add(array(
           "name"=>"isEmployeeInService",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Is employee still in service",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"isEmployeeInService",
               "class"=>"col-xs-12",
               //                "checked"=>true
           ),
       ));
       
       $this->add(array(
           "name"=>"employeeSalary",
           "type"=>"text",
           "options"=>array(
               "label"=>"Annual salary of employee",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"employeeSalary",
               "class"=>"form-control col-xs-12",
               //                "checked"=>true
           ),
       ));
       
       
       $this->add(array(
           "name"=>"isEmployeeInPreviousLoss",
           "type"=>"checkbox",
           "options"=>array(
               "label"=>"Is employee i previous loss",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"isEmployeeInPreviousLoss",
               "class"=>"col-xs-12",
               //                "checked"=>true
           ),
       ));
       
       $this->add(array(
           "name"=>"reasonDoubtEmployeeIntegrity",
           "type"=>"textarea",
           "options"=>array(
               "label"=>"Any reason to doubt employee integrity",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "id"=>"reasonDoubtEmployeeIntegrity",
               "class"=>"form-control col-xs-12",
               //                "checked"=>true
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
        return array(
            "reasonDoubtEmployeeIntegrity"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "isEmployeeInPreviousLoss"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
        );
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

