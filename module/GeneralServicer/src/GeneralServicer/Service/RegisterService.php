<?php
namespace GeneralServicer\Service;

use CsnUser\Service\UserService as UserCredentialsService;


/**
 *
 * @author swoopfx
 *        
 */
class RegisterService
{

    private $userEntity;

    private $entityManager;

    private $redirect;

    public function __construct()
    {}

    public function registerHydrate($data, $entity)
    {
        
            $entityManager = $this->entityManager;
            $user = $entity;
//             $user->setUsername($data['username']);

//             $user->setRole($data['role']);
//             $user->setEmail($data['email']);
//             $user->setQuestion($entityManager->find('CsnUser\Entity\Question', $data['question']));
//             $user->setAnswer($data['answer']);
             
            
            $user->setEmailConfirmed(false);
            $user->setLanguage($entityManager->find('CsnUser\Entity\Language', 1));
            $user->setRegistrationDate(new \DateTime());
            $user->setRegistrationToken(md5(uniqid(mt_rand(), true)));
            $user->setPassword(UserCredentialsService::encryptPassword($user->getPassword()));
            $user->setIsProfiled(FALSE);
            
            return $user;
    }
    
    // Begin Setters
    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        
        return $this;
    }

    public function setUserEntity($entity)
    {
        $this->userEntity = $entity;
        
        return $this;
    }

    public function setRedirect($rediret)
    {
        $this->redirect = $rediret;
        
        return $this;
    }
    
    // End Setters
}

