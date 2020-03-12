<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\WorkmenCompensationSubContractorsList;

/**
 *
 * @author otaba
 *        
 */
class WorkmenContractorsListFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);

        $this->setHydrator($hydrator)->setObject(new WorkmenCompensationSubContractorsList());
        
        $this->add(array(
            "name"=>"contractorName",
            "type"=>"text",
            "options"=>array(
                "label" => "Contractor Name ",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "id"=>"contractorName",
                "placeholder"=>"Hadejaz Limited"
            )
        ));
        
        $this->add(array(
            "name"=>"natureOfWork",
            "type"=>"text",
            "options"=>array(
                "label" => "Nature of Work",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "id"=>"natureOfWork",
                "placeholder"=>"Cleaning Service"
            )
        ));
        
        $this->add(array(
            "name"=>"contractAmount",
            "type"=>"text",
            "options"=>array(
                "label" => "Contract Amount",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
                "id"=>"contractAmount",
                "placeholder"=>"300000"
            )
        ));
        
//         $this->add(array(
//             "name"=>"contractorName",
//             "type"=>"text",
//             "options"=>array(
//                 "label" => "Bond Value Required",
//                 "label_attributes" => array(
//                     "class" => "control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes"=>array(
//                 "class"=>"form-control col-md-7 col-sm-7 col-xs-12",
//                 "id"=>"contractorName",
//                 "placeholder"=>"Hadejaz Limited"
//             )
//         ));
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     *
     */
    public function getInputFilterSpecification()
    {
        
        // TODO - Insert your code here
    }
    /**
     * @param field_type $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

}

