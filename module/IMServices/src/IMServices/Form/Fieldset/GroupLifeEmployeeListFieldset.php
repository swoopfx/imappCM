<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\GroupLifeEmployeeList;

/**
 *
 * @author otaba
 *        
 */
class GroupLifeEmployeeListFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;

    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new GroupLifeEmployeeList())->setHydrator($hydrator);
        
        $this->add(array(
            "name"=>"employeeName",
            "type"=>"text",
            "options"=>array(
                "label"=>"Employee Name",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"employeeName",
                "class"=>"form-control",
            ),
        ));
        
        $this->add(array(
            "name"=>"annualEmolument",
            "type"=>"text",
            "options"=>array(
                "label"=>"Total Annual Emolument",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"annualEmolument",
                "class"=>"form-control",
            ),
        ));
        
        
        
        $this->add(array(
            "name"=>"lifeAssuranceBenefit",
            "type"=>"text",
            "options"=>array(
                "label"=>"Life Assurance Benefit",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"lifeAssuranceBenefit",
                "class"=>"form-control",
            ),
        ));
        
        
        $this->add(array(
            "name"=>"beneficiary",
            "type"=>"text",
            "options"=>array(
                "label"=>"Beneficiary",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-4 col-sm-4 col-xs-12"
                ),
            ),
            "attributes"=>array(
                "id"=>"beneficiary",
                "class"=>"form-control",
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
            "beneficiary"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "lifeAssuranceBenefit"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "annualEmolument"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "employeeName"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
        );
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
}

