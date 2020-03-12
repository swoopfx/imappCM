<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\EmployerLiabilityDetails;

/**
 *
 * @author otaba
 *        
 */
class EmployeeLiabilityDEtailsFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;
   
    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new EmployerLiabilityDetails());
        
        $this->add(array(
            "name"=>"employeeDescription",
            "type"=>"text",
            "options"=>array(
                "label"=>"Employee Category/Description",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
                    
                )
            ),
            "attributes"=>array(
                "id"=>"employeeDescription",
                "class"=>"form-control col-md-6 col-xs-12",
                "placeholder"=>"Admin, Executive"
            )
        ));
        
        $this->add(array(
            "name"=>"numbersOfEmployee",
            "type"=>"text",
            "options"=>array(
                "label"=>"Number Of Employee",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
                    
                )
            ),
            "attributes"=>array(
                "id"=>"numbersOfEmployee",
                "class"=>"form-control col-md-6 col-xs-12"
            )
        ));
        
        $this->add(array(
            "name"=>"estimatedPeriodWage",
            "type"=>"text",
            "options"=>array(
                "label"=>"Estimated Wage for Period",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
                    
                )
            ),
            "attributes"=>array(
                "id"=>"estimatedPeriodWage",
                "class"=>"form-control col-md-6 col-xs-12"
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
        $this->entityManager = $em ;
        return $this;
    }
}

