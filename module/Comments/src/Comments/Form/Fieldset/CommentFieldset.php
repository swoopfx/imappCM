<?php
namespace Comments\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Comments\Entity\Comments;

class CommentFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    private $entityManager;
    

    public function init(){
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setObject(new Comments())->setHydrator($hydrator);
        
        $this->add(array(
            "name"=>"topic",
            "type"=>"text",
            "options"=>array(
                "label"=>"Comment",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
                ),
            ),
            "attributes"=>array(
                "id"=>"topic",
                "class"=>"form-control col-xs-12",
                "placeholder"=>"Comment Topic"
            )
        ));
        
        $this->add(array(
            "name"=>"comment",
            "type"=>"textarea", 
            "options"=>array(
                "label"=>"Comment",
                "label_attributes"=>array(
                    "class"=>"control-label col-md-3 col-sm-3 col-xs-12",
                ),
            ),
            "attributes"=>array(
                "id"=>"comment",
                "class"=>"form-control col-xs-12",
                "placeholder"=>"Comment"
            )
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            "topic"=>array(
                "allow_empty"=>true,
                "required"=>false,
            ),
            "comment"=>array(
                "allow_empty"=>true,
                "required"=>false,
            )
        );
    }
    /**
     * @param mixed $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

}

