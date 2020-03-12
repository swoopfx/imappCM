<?php
namespace Object\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use Object\Entity\ObjectOthers;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

/**
 *
 * @author otaba
 *        
 */
class ObjectOthersFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;

   public function init(){
       $hydrator = new DoctrineObject($this->entityManager);
       $this->setHydrator($hydrator)->setObject(new ObjectOthers());
       
       return $this->addFields();
   }
   
   
   private function addFields(){
       $this->add(array(
           "name"=>"name",
           "type"=>"text",
           "options"=>array(
               "label"=>"Property Name",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-7 col-xs-12",
               "placeholder"=>"",
               "required"=>"required",
           )
       ));
       
       $this->add(array(
           "name"=>"objectType",
           "type"=>"text",
           "options"=>array(
               "label"=>"Property Type",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-7 col-xs-12",
               "placeholder"=>"Agricultural Property",
               "required"=>"required",
           )
       ));
       
       $this->add(array(
           "name"=>"description",
           "type"=>"textarea",
           "options"=>array(
               "label"=>" Description of Property",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-7 col-xs-12",
              // "placeholder"=>"Agricultural Property",
              // "required"=>"required",
           )
       ));
       
//        $this->add(array(
//            "name"=>"objectType",
//            "type"=>"text",
//            "options"=>array(
//                "label"=>"Property Type",
//                "label_attributes"=>array(
//                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
//                )
//            ),
//            "attributes"=>array(
//                "class"=>"form-control col-md-7 col-xs-12",
//                "placeholder"=>"Agricultural Property",
//                //"required"=>"required",
//            )
//        ));
       
       $this->add(array(
           "name"=>"infoDefnition1",
           "type"=>"text",
           "options"=>array(
               "label"=>"Unique Definition",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-7 col-xs-12",
               "placeholder"=>"Chasis Number",
               // "required"=>"required",
           )
       ));
       
       $this->add(array(
           "name"=>"information1",
           "type"=>"text",
           "options"=>array(
               "label"=>"Unique Value",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-7 col-xs-12",
               "placeholder"=>"234X567OI",
               // "required"=>"required",
           )
       ));
       
       $this->add(array(
           "name"=>"infoDefnition2",
           "type"=>"text",
           "options"=>array(
               "label"=>"Unique Definition",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-7 col-xs-12",
               // "placeholder"=>"Agricultural Property",
               // "required"=>"required",
           )
       ));
       
       $this->add(array(
           "name"=>"information2",
           "type"=>"text",
           "options"=>array(
               "label"=>"Unique Value",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-7 col-xs-12",
               // "placeholder"=>"Agricultural Property",
               // "required"=>"required",
           )
       ));
       
       $this->add(array(
           "name"=>"infoDefnition3",
           "type"=>"text",
           "options"=>array(
               "label"=>"Unique Definition",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-7 col-xs-12",
               // "placeholder"=>"Agricultural Property",
               // "required"=>"required",
           )
       ));
       
       $this->add(array(
           "name"=>"information3",
           "type"=>"text",
           "options"=>array(
               "label"=>"Unique Value",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-7 col-xs-12",
               // "placeholder"=>"Agricultural Property",
               // "required"=>"required",
           )
       ));
       
       $this->add(array(
           "name"=>"infoDefnition4",
           "type"=>"text",
           "options"=>array(
               "label"=>"Unique Definition",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-7 col-xs-12",
               // "placeholder"=>"Agricultural Property",
               // "required"=>"required",
           )
       ));
       
       $this->add(array(
           "name"=>"information4",
           "type"=>"text",
           "options"=>array(
               "label"=>"Unique Value",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-7 col-xs-12",
               // "placeholder"=>"Agricultural Property",
               // "required"=>"required",
           )
       ));
       
       
       $this->add(array(
           "name"=>"infoDefnition5",
           "type"=>"text",
           "options"=>array(
               "label"=>"Unique Definition",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-7 col-xs-12",
               // "placeholder"=>"Agricultural Property",
               // "required"=>"required",
           )
       ));
       
       $this->add(array(
           "name"=>"information5",
           "type"=>"text",
           "options"=>array(
               "label"=>"Unique Value",
               "label_attributes"=>array(
                   "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
               )
           ),
           "attributes"=>array(
               "class"=>"form-control col-md-7 col-xs-12",
               // "placeholder"=>"Agricultural Property",
               // "required"=>"required",
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

