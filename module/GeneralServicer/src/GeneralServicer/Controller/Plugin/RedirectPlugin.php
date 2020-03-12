<?php
namespace GeneralServicer\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

/**
 * This redirect based on the users authentication level
 *
 * @author swoopfx
 *        
 */
class RedirectPlugin extends AbstractPlugin
{

    protected $pluginManager;

    protected $redirect;

    protected $options;

    protected $auth;

    protected $setupRedirection;

    private $flash;

    private $id;

    private $entity;

    private $entityManager;

    public function redirectCondition()
    {
        
        $this->redirectToLogout();
        $authIdentity = $this->auth->hasIdentity(); // return boolean
       if($authIdentity == true){
       	 $isProfiled = $this->auth->getIdentity()->getProfiled();
        if ($this->auth->hasIdentity() && $isProfiled == false) {
            $this->setupRedirection->setupRedirect();
        }
       }
        
    }

    public function redirectToLogout()
    {
        if (! $this->auth->hasIdentity()) {
           
            $this->redirect->toRoute('logout');
        }
    }

   
    public function idStatusRedirection($id, $entity)
    {
        $this->noIdRedirrection($id);
        $this->nullIdRedirection($id, $entity);
        
    }

    private function noIdRedirrection($id)
    {
        if ($id == NULL) {
            $this->flash->addErrorMessage("Editable value not selected");
           return  $this->redirect->toRoute("dashboard");
        }
    }

    private function nullIdRedirection($id, $entity)
    {
        $em = $this->entityManager;
        if ($id != NULL) {
            $data = $em->find($entity, $id);
            if ($data == NULL) {
                $this->flash->addErrorMessage("The information you request does not exist in our record");
               return  $this->redirect->toRoute("dashboard");
            }
        }
    }

    public function setOptions($op)
    {
        $this->options = $op;
        
        return $this;
    }

    public function setRedirect($red)
    {
        $this->redirect = $red;
        return $this;
    }

    public function setAuth($auth)
    {
        $this->auth = $auth;
        
        return $this;
    }

    public function setUpRedirect($red)
    {
        $this->setupRedirection = $red;
        return $this;
    }

    public function setFlash($flash)
    {
        $this->flash = $flash;
        return $this;
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

?>