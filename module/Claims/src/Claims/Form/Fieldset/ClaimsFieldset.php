<?php
namespace Claims\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use IMServices\Service\IMService;
use Claims\Entity\CLaims;

/**
 *
 * @author swoopfx
 *        
 */
class ClaimsFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;
    
    private $serviceId;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new CLaims());
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            'name' => 'claimTopic',
            'type' => 'text',
            'options' => array(
                "label" => "Claims Topic",
                "label_attributes" => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                )
            ),
            'attributes' => array(
                'class' => "form-control col-xs-12",
                'required' => "required",
                "placeholder" => "My Nissan Almera Accident"
            )
        ));
        $this->add(array(
            'name' => 'claimInfo',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Describe the incident',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
//                 'ckeditor' => array(
//                     // add anny config you would normaly add via CKEDITOR.editorConfig
//                     'language' => 'en',
//                     'uiColor' => '#AADC6E'
//                 )
            ),
            'attributes' => array(
                'id' => 'descr',
                
                // 'style' => "display:none;",
                'placeholder' => 'Provide a detailed description of the incident',
                'class' => 'form-control col-sm-9 col-md-9 col-xs-12'
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
            "claimInfo" => array(
                "allow_empty" => true,
                "required" => false
            ),
            "claimTopic" => array(
                "allow_empty" => true,
                "required" => false
            ),
        );
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
   

}

