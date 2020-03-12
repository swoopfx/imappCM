<?php
namespace Home\Form;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Home\Entity\Activate;
use Zend\Validator\StringLength;

/**
 *
 * @author otaba
 *        
 */
class ActivateLoginForm extends Form implements InputFilterProviderInterface
{

    private $entityManager;

    /**
     */
   

    public function init()
    {
        $hydrate = new DoctrineObject($this->entityManager);
        $this->setObject(new Activate())->setHydrator($hydrate);
        $this->setAttributes(array(
            "method" => "POST",
            "action" => "/activation/vate"
        ));
       
        $this->addFieldas();
      
    }

   

    private function addFieldas()
    {
        $this->add(array(
            "name" => "details",
            "type" => "text",
            "options" => array(
                "label" => "Username:",
                "label_attributes" => array(
                    "class" => "control-label col-md-3 col-sm-3 col-xs-12"
                )
            ),
            "attributes" => array(
                'class' => "form-control col-md-8 col-sm-8 col-xs-12",
                "required" => "required"
            )
        
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                // 'type' => 'submit',
                'value' => 'LOGIN',
                'class' => 'btn'
            
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
            'details' => array(
                'required' => true,
                'allow_empty' => false,
                'filters' => array(
                    array(
                        'name' => 'Zend\Filter\StringTrim'
                    ),
                    array(
                        'name' => 'StripTags'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'Zend\Validator\StringLength',
                        'options' => array(
                            'min' => 2,
                            'max' => 500,
                            'messages' => array(
                                StringLength::TOO_SHORT => 'Please insert the correct amount of digits',
                                StringLength::TOO_LONG => 'We belive this is too long a  name'
                            )
                        )
                    )
                )
            )
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

