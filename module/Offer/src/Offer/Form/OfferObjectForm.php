<?php
namespace Offer\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use DoctrineModule\Form\Element\ObjectMultiCheckbox;

/**
 *
 * @author swoopfx
 *        
 */
class OfferObjectForm extends Form
{

    protected $entityManager;
    
    protected $userId;

    public function init()
    {
        $this->setAttributes(array(
            'action' => '/offer/offer-object',
            'method' => 'POST',
            'class' => 'form-horizontal form-label-left',
            'enctype' => 'multipart/form-data',
            'data-ng-controller' => "offerInfoController",
            'novalidate' => true
        ))->setInputFilter(new InputFilter());
        
        $this->addCommon();
        $this->gatherObjectForm();
        $this->selectedObject();
        // $this->uploader();
    }

   

    private function selectedObject()
    {
        $this->add(array(
            'name' => 'objects',
            'type' => 'DoctrineModule\Form\Element\ObjectMultiCheckbox',
            'attributes' => array(
                'class' => 'flat'
            ),
            'options' => array(
                'target_class'   => 'Object\Entity\Object',
                'object_manager'=>$this->entityManager,
                'property'=>'objectName',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(
                            'user' => $this->userId
                        ),
                         
                    ),
                    'orderBy' => array(
                        'id' => 'DESC'
                    )
                )
            )
            
        ));
    }

    private function selectedDocument()
    {}
    
    // private function uploader(){
    // $this->add(array(
    // 'name'=>'multiple-uploader',
    // 'type'=>'ZF2FileUploadExamples\Form\MultiHtml5Upload'
    // ));
    // }
    private function addCommon()
    {
        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 600
                )
            )
        ));
        $this->add(array(
            'name' => 'reset',
            'type' => 'Zend\Form\Element',
            'options' => array(),
            
            'attributes' => array(
                'class' => 'btn btn-primary',
                'value' => 'Reset',
                'id' => 'reset'
            )
        ));
        
        $this->add(array(
            'name' => 'next',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Next',
                'class' => 'btn btn-success'
            )
        )
        );
    }

    protected function gatherObjectForm()
    {
        $this->add(array(
            'type' => 'Object\Form\Fieldset\ObjectFieldset',
            'name' => 'objectFieldset'
        ));
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        
        return $this;
    }
    
    public function setUserId($id){
        $this->auth = $id;
        if ($this->auth->hasIdentity()) {
            $this->userId = $this->auth->getIdentity()->getId();
             
        }
        
        
        return $this;
    }
}

