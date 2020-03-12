<?php
namespace IMServices\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Entity\BuglarySafeDetails;

/**
 *
 * @author otaba
 *        
 */
class BuglarySafeDetailsFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new BuglarySafeDetails())->setHydrator($hydrator);
        
        $this->add(array(
            "name"=>"productName",
            "type"=>"text",
            "options"=>array(
                "label"=>"Product Name",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"productName",
                "class"=> "form-control col-md-7 col-xs-12",
                "placeholder"=>"Required"
            ),
        ));
        
        $this->add(array(
            "name"=>"maker",
            "type"=>"text",
            "options"=>array(
                "label"=>"Make",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"maker",
                "class"=> "form-control col-md-7 col-xs-12",
                "placeholder"=>"Mitsubisihi"
            ),
        ));
        
        
        $this->add(array(
            "name"=>"model",
            "type"=>"text",
            "options"=>array(
                "label"=>"Model",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"model",
                "class"=> "form-control col-md-7 col-xs-12",
                "placeholder"=>"if Applicable"
            ),
        ));
        
        
        $this->add(array(
            "name"=>"cost",
            "type"=>"text",
            "options"=>array(
                "label"=>"Product Price",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"cost",
                "class"=> "form-control col-md-7 col-xs-12",
                "placeholder"=>"Required"
            ),
        ));
        
//         $this->add(array(
//             "name"=>"model",
//             "type"=>"text",
//             "options"=>array(
//                 "label"=>"Model",
//                 "label_attributes" => array(
//                     "class" => "control-label col-md-3 col-sm-3 col-xs-12"
//                 )
//             ),
//             "attributes"=>array(
//                 "id"=>"model",
//                 "class"=> "form-control col-md-7 col-xs-12",
//                 "placeholder"=>"Required"
//             ),
//         ));
        
        $this->add(array(
            "name"=>"size",
            "type"=>"text",
            "options"=>array(
                "label"=>"Product Size",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes"=>array(
                "id"=>"size",
                "class"=> "form-control col-md-7 col-xs-12",
                "placeholder"=>"Required"
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
        return array();
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

