<?php
namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 *
 * @author swoopfx
 *        
 */
class IndexController extends AbstractActionController
{

    private $options;

    private $authProcess;

    private $loginForm;

    private $userEntity;

    public function __construct()
    {}

    public function indexAction()
    {}

    public function loginAction()
    {
        $user = $this->identity();
        if ($user) {
            return $this->redirect()->toRoute($this->options->getLoginRedirectRoute());
        }
        $request = $this->getRequest();
        $params = $this->params();
        if ($request->isPost()) {
            $result = $this->authProcess->processLogin($request, $this->loginForm, $params);
            if ($result['authResult'] == true) {
                return $this->redirect()->toRoute($this->options->getLoginRedirectRoute());
            } else {
                $view = new ViewModel(array(
                    'error' => $result['error'],
                    'form' => $result['form'],
                    'messages' => $result['message'],
                    'navMenu' => $result['navMenu']
                )
                );
                return $view;
            }
        }
        
        $view = new ViewModel(array(
            'error' => $result['error'],
            'form' => $result['form'],
            'messages' => $result['message'],
            'navMenu' => $result['navMenu']
        ));
        return $view;
    }

    public function setOptions($opt)
    {
        $this->options = $opt;
    }

    public function setAuthProcess($ap)
    {
        $this->authProcess = $ap;
    }

    public function setLoginForm($form)
    {
        $this->loginForm = $form;
    }

    public function setUserEntity($ue)
    {
        $this->userEntity = $ue;
    }
}

?>