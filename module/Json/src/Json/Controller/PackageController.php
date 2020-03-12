<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Json for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Json\Controller;


use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class PackageController extends AbstractRestfulController
{
    
    private $entityManager;
    
   public function get($id){
       $em = $this->entityManager;
       //$id = $this->params()->fromPost('packageId', NULL);
       $data = $em->find('Settings\Entity\Packages', $id);
       $view = new JsonModel(array(
            'packageName'=>$data->getPackageName(),
            'packageCat'=>$data->getPackageCategory()->getPackageCat(),
            'desc'=>$data->getPackageDesc(),
            'employee'=>$data->getMaxEmployee(),
            'price'=>$data->getPrice(),
            
       ));
       return $view;
   }
   
   public function getList(){
       $view = new JsonModel();
       return $view;
   }
   
   public function create($data){
       
   }

   public function update($id, $data){
       
   }
   
   public function setEntityManager($em){
       $this->entityManager = $em ;
       return $this;
   }
}
