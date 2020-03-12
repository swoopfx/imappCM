<?php
namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * This Controller handles all informatioon , setup , proifile
 * and general configuration of theb agents on the system
 *
 * @author swoopfx
 *        
 */
class AgentController extends AbstractActionController
{

    private $entityManager;

    private $setUpInfoForm;
    
    private $setUpDataForm;

    public function __construct()
    {}
    
    // public function onDispatch(\Zend\Mvc\MvcEvent $e)
    // {
    
    // $response = parent::onDispatch($e);
    // $this->layout()->setTemplate('layout/welcome.phtml');
    // return $response;
    // }
    public function setupAction()
    {
        // $this->redirectPlugin()->redirectToLogout();
        $em = $this->entityManager;
        // If this user has already started the process,
        // Redirect to edit action
        // If user is not logged in and point to login page
        // if user is setup grant access to the setup service
        // Else throw an exception
        $setUpForm = $this->setUpInfoForm;
        $setUpInfo = $em->find('Settings\Entity\Terms', 4);
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            $data = $request->getPost();
            $setUpForm->setData($data);
            if ($setUpForm->isValid()) {
                if ($request->getPost('acceptance') == 1) {
                    $this->redirect()->toRoute('user_agent', array(
                        'action' => 'setup-data'
                    ));
                }
            }
        }
        $view = new ViewModel(array(
            'setUpForm' => $setUpForm,
            'info' => $setUpInfo
        ));
        $this->layout('layout/layout.phtml');
        return $view;
    }

    public function setupDataAction()
    {
        // $this->redirectPlugin()->redirectToLogout();
        $this->layout('layout/layout.phtml');
        $em = $this->entityManager;
        $setUpDataForm = $this->setUpDataForm;
        $view = new ViewModel(array(
            'setpDataForm'=>$setUpDataForm
        ));
        
        return $view;
    }

    
    // Begin Setter
    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setSetUpInfoForm($form)
    {
        $this->setUpInfoForm = $form;
        
        return $this;
    }
    
    public function setSetUpDataForm ($form){
        $this->setUpDataForm = $form ;
        
        return $this;
    }
    
    // End  Setters
}

?>