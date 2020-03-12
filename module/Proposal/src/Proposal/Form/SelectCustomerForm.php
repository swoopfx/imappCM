<?php
namespace Proposal\Form;

use Zend\Form\Form;

/**
 *
 * @author swoopfx
 *        
 */
class SelectCustomerForm extends Form
{

    protected $entityManager;

    protected $broker;

    protected $userId;

    protected $auth;

    protected $customer;

//     public function __construct()
//     {}

    public function init()
    {
        $this->setAttributes(array(
            'action' => '/proposal/select-cutomer',
            'method' => 'POST',
            'data-ng-controller' => 'selectCustomerController',
            'class' => 'form-horizontal form-label-left',
            'enctype' => 'multipart/form-data'
        ));
        $this->addCommon();
        $this->addFeilds();
        $this->addSelection();
    }

    private function addSelection()
    {
        $this->add(array(
            'name' => 'selectCustomer',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Registered Customer',
                'object_manager' => $this->entityManager,
                'target_class' => 'Customer\Entity\Customer',
                'property' => 'name',
                'empty_option' => '-- Select a Customer --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                ),
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(
                            'broker' => $this->broker
                        )
                    ),
                    'orderBy' => array(
                        'id' => 'DESC'
                    )
                )
            ),
            'attributes'=>array(
                'data-ng-change'=>'showCustomerDetails(ser)',
                'class' => 'form-control',
            ),
        ));
    }

    private function addCommon()
    {
        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
            'options' => array()
        )
        );
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
    
    // Begin Setter
    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        
        return $this;
    }

    public function setBroker($broker)
    {
        $this->broker = $broker;
        return $this;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
        
        return $this;
    }

    public function setAuth($auth)
    {
        $this->auth = $auth;
        
        return $this;
    }

    public function setCutomer($customer)
    {
        $this->customer = $customer;
        
        return $this;
    }
    
    // End Setter
}

