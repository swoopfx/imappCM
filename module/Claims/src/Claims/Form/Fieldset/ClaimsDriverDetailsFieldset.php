<?php
namespace Claims\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Claims\Entity\ClaimsDriverDetails;

/**
 *
 * @author otaba
 *        
 */
class ClaimsDriverDetailsFieldset extends Fieldset implements InputFilterProviderInterface
{
    private $entityManager;

    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new ClaimsDriverDetails());
        $this->addFieldset();
    }
    
    
    private function addFieldset(){
        $this->add(array(
            "name"=>"driverName",
            "type"=>"text",
            "options"=>array(
                "label"=>"Drivers Name:",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
                )
            ),
            "attributes"=>array(
                "id"=>"driverName",
                "class"=>"form-control col-xs-12",
                "placholder"=>"Segun Hamzat",
            ),
        ));
        
        $this->add(array(
            
            "name"=>"driverAge",
            "type"=>"number",
            "options"=>array(
                "label"=>"Drivers Age",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "class"=>"form-control col-xs-12",
                "id"=>"driverAge",
                "min"=>16,
                "placeholder"=>"50"
            ),
        ));
        
        $this->add(array(
            "name"=>"drivingLicenceNo",
            "type"=>"text",
            "options"=>array(
                "label"=>"Driver Licence number",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
                )
            ),
            "attributes"=>array(
                "id"=>"drivingLicenceNo",
                "class"=>"form-control col-md-9 col-xs-12",
                "placeholder"=>"WER2345B54S1098"
            )
        ));
        
        $this->add(array(
            "name"=>"licenceIssueDate",
            "type"=>"date",
            "options"=>array(
                "label"=>"Licence Issue Date:",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
                ),
                //                 'format' => 'd-m-Y',
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-9 col-xs-12 ",
                "id"=>"licenceIssueDate",
//                 'min' => date("Y-m-d")-10,
//                 'max' => date("Y")+10
            )
        ));
        
        $this->add(array(
            "name"=>"licenceExpireDate",
            "type"=>"date",
            "options"=>array(
                "label"=>"Licence Expre Date",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12 ",
                ),
//                 'format' => 'd-m-Y',
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-9 col-xs-12 ",
//                 'min' => date("Y")-10,
//                 'max' => date("Y")+10
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
        return array(
            "licenceExpireDate"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "licenceIssueDate"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "drivingLicenceNo"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            "driverAge"=>array(
                "allow_empty"=>true,
                "required"=>false
            ),
            
            "driverName"=>array(
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

