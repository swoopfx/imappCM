<?php
namespace Packages\Form\Fieldset;

use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Packages\Entity\FeaturedPackages;
use Zend\InputFilter\InputFilterProviderInterface;

/**
 *
 * @author otaba
 *        
 */
class FeaturedPackagesFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $entityManager;
    
    private $centralBrokerId;

    public function init()
    {
        $hydrator = new DoctrineObject($this->entityManager);
        $this->setHydrator($hydrator)->setObject(new FeaturedPackages());
        $this->addFields();
    }

    private function addFields()
    {
        $this->add(array(
            'name' => 'package1',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Package Slide 1',
                'object_manager' => $this->entityManager,
                'target_class' => 'Packages\Entity\Packages',
                'property' => 'packageName',
                'empty_option' => '-- Select Package --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                
                ),
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(
                            'broker' => $this->centralBrokerId
                        )
                    ),
                    'orderBy' => array(
                        'id' => 'DESC'
                    )
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-9 col-xs-12',
                'id' => 'package_typer',
                 'required' => 'required' ,
            
            )
        ));
        
        $this->add(array(
            'name' => 'package2',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Package Slide 2',
                'object_manager' => $this->entityManager,
                'target_class' => 'Packages\Entity\Packages',
                'property' => 'packageName',
                'empty_option' => '-- Select Package --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                
                ),
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(
                            'broker' => $this->centralBrokerId
                        )
                    ),
                    'orderBy' => array(
                        'id' => 'DESC'
                    )
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-9 col-xs-12',
                'id' => 'package_typer'
                // 'required' => 'required' ,
            
            )
        ));
        
        $this->add(array(
            'name' => 'package3',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Package Slide 3',
                'object_manager' => $this->entityManager,
                'target_class' => 'Packages\Entity\Packages',
                'property' => 'packageName',
                'empty_option' => '-- Select Package --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                
                ),
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(
                            'broker' => $this->centralBrokerId
                        )
                    ),
                    'orderBy' => array(
                        'id' => 'DESC'
                    )
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-9 col-xs-12',
                'id' => 'package_typer'
              
            
            )
        ));
        
        $this->add(array(
            'name' => 'package4',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Package Type 4',
                'object_manager' => $this->entityManager,
                'target_class' => 'Packages\Entity\Packages',
                'property' => 'packageName',
                'empty_option' => '-- Select Package --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                
                ),
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(
                            'broker' => $this->centralBrokerId
                        )
                    ),
                    'orderBy' => array(
                        'id' => 'DESC'
                    )
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-9 col-xs-12',
                'id' => 'package_typer'
               
            
            )
        ));
        
        $this->add(array(
            'name' => 'package5',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Package Type 5',
                'object_manager' => $this->entityManager,
                'target_class' => 'Packages\Entity\Packages',
                'property' => 'packageName',
                'empty_option' => '-- Select Package --',
                'label_attributes' => array(
                    'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
                
                ),
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(
                            'broker' => $this->centralBrokerId
                        )
                    ),
                    'orderBy' => array(
                        'id' => 'DESC'
                    )
                )
            ),
            'attributes' => array(
                'class' => 'form-control col-md-9 col-xs-12',
                'id' => 'package_typer'
                
            
            )
        ));
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
    
    public function setCentralBrokerId($broker){
        $this->centralBrokerId = $broker;
        return $this;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array();
    }
}

