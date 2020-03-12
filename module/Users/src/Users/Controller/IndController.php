<?php
namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mail\Message;

/**
 * IndController
 *
 * @author
 *
 * @version
 *
 */
class IndController extends AbstractActionController
{

    private $entityManager;

    private $translate;

    private $options;

    private $mail;

    private $profileForm;

    private $indEntity;

    private $inContactEntity;

    private $errorPage;

    public function indexAction()
    {
        $view = new ViewModel();
        return $view;
    }

    public function setProfileAction()
    {
        $profileForm = $this->profileForm;
        $indEntity = $this->indEntity;
        
        $profileForm->bind($indEntity);
        
        $this->redirectPlugin()->redirectToLogout();
        if ($this->getRequest()->isPost()) {
            $profileForm->setData($this->getRequest()
                ->getPost());
            
            if ($profileForm->isValid()) {
                try {
                    
                    $entityManager = $this->entityManager;
                    $indEntity->setCreatedOn(new \DateTime());
                    $indEntity->setUser($entityManager->find('CsnUser\Entity\User', $this->identity()
                        ->getId()));
                    $indEntity->getContact()->setCreatedDate(new \DateTime());
                    $entityManager->persist($indEntity);
                    
                    // Change Conditions
                    $this->changeConditions();
                    
                    // Send Mail
                    $this->sendEmail($this->identity()
                        ->getEmail(), 'Profile Completed', 'Your Profile has successfully updated');
                    $entityManager->flush();
                    
                    // Make redirection
                    $this->redirect()->toRoute('dashboard');
                } catch (\Exception $e) {
                    return $this->errorPage->createErrorView('Something went wrong when trying to create your profile please try again later .', $e);
                    // $this->options->getDisplayExceptions(),
                    // $this->options->getNavMenu()
                }
            
            /**
             * If persist is suuccessful change isProfile to true where user id = id
             */
            } else {
                echo "There was a problem No validation ";
            }
        }
        $view = new ViewModel(array(
            'profileForm' => $profileForm
        ));
        return $view;
    }

    private function changeConditions()
    {
        $entityManager = $this->entityManager;
        $user = $this->identity();
        $user->setIsProfiled(TRUE);
        $user->setRole($entityManager->find('CsnUser\Entity\Role', 10));
        
        $entityManager->flush();
    /**
     * This changes the conditions of the user entity
     * Is Profiled is converted to true ,
     * users role is upfated from user setup = 4 to user = 10
     */
    }

    private function sendMail($to = '', $subject = '', $messageText = '')
    {
        $transport = $this->mail;
        $message = new Message();
        
        $message->addTo($to)
            ->addFrom($this->options->getSenderEmailAdress())
            ->setSubject($subject)
            ->setBody($messageText);
        
        $transport->send($message);
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        
        return $this;
    }

    public function setOptions($op)
    {
        $this->options = $op;
        
        return $this;
    }

    public function setProfileForm($form)
    {
        $this->profileForm = $form;
        
        return $this;
    }

    public function setIndInfo($info)
    {
        $this->indEntity = $info;
        return $this;
    }

    public function setContactInfo($info)
    {
        $this->inContactEntity = $info;
        return $this;
    }

    public function setErrorPage($error)
    {
        $this->errorPage = $error;
        return $this;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
        return $this;
    }
}