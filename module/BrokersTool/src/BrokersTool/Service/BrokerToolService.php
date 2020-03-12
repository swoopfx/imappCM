<?php
namespace BrokersTool\Service;

use CsnUser\Service\UserService;

/**
 *
 * @author swoopfx
 *        
 */
class BrokerToolService
{

    private $generalService;

    private $userEntity;

    private $brokerChildProfileEntity;

    private $brokerChildEntity;

    private $entityManager;

    private $mailService;

    private $controllerPluginManager;

    private $redirect;

    private $brokerId;

    private $urlViewHelper;

    private $centralBrokerId;

    private $smsService;

    public function __construct()
    {}

    public function hydrateAddStaff($userEntity, $data)
    {
        $em = $this->entityManager;

        $generalService = $this->generalService;
        // $mailService = $this->mailService;
        $smsService = $this->smsService;
        $urlViewHelper = $this->urlViewHelper;
        $unencryptePassword = $userEntity->getPassword();

        $userEntity->setEmailConfirmed(false);
        $userEntity->setRegistrationDate(new \DateTime());
        $userEntity->setRegistrationToken(md5(uniqid(mt_rand(), true)));
        $userEntity->setPassword(UserService::encryptPassword($userEntity->getPassword()));
        $userEntity->setProfiled(true);

        $userEntity->setRole($em->find("CsnUser\Entity\HierarchicalRole", UserService::USER_ROLE_BROKER_CHILD));
        $userEntity->setState($em->find("CsnUser\Entity\State", UserService::USER_STATE_ENABLED));

        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $generalService->getCentralBroker());
        $userEntity->getBrokerChild()->setBroker($brokerEntity);
        $userEntity->getBrokerChild()->setUser($userEntity);

        $userEntity->getBrokerChild()->setCreatedOn(new \DateTime());
        $userEntity->getBrokerChild()->setBrokerChildUid($this->brokerChildUid());
        $userEntity->getBrokerChild()->setFirstname($data->getBrokerChild()
            ->getFirstname());
        $userEntity->getBrokerChild()->setLastname($data->getBrokerChild()
            ->getLastname());

        // / begin Broker Profile Entity

        try {
            // Begin send email notification
//             $message = "Dear " . $userEntity->getBrokerChild()->getLastName() . " you have been registered on the company portal: your password is " . $unencryptePassword;
//             $messsage2 = "<br>Visit ".$this->urlViewHelper("user-index", array(), array( 'force_canonical' => true)). " to login to yor account";
            // var_dump($url);
            $fullLink = $urlViewHelper('user-register', array(
                'action' => 'confirm-email',
                'id' => $userEntity->getRegistrationToken()
            ), array(
                'force_canonical' => true
            ));


            $messagePointer = NULL;
            $template = NULL;

            $imapLogo = $urlViewHelper('welcome', array(), array(
            'force_canonical' => true
            )) . "images/logow.png";

            $var = [
                'logo' => $imapLogo,
                'confirmLink' => $fullLink
            ];

            $messagePointer['to'] = $userEntity->getEmail();
            $messagePointer['fromName'] = $brokerEntity->getCompanyName();
            $messagePointer['subject'] = "Welcome Aboard";

            $template['template'] = "general-user-confirm-email";
            $template['var'] = $var;

            // End Send email notification

            $em->persist($userEntity);

            $em->flush();

            // $smsService->brokerSend();
            $this->generalService->sendMails($messagePointer, $template);
            return $userEntity->getId();
        } catch (\Exception $e) {
            return NULL;
        }
    }

    public function brokerChildUid()
    {
        $const = "brkchild";
        $code = \uniqid($const) . $this->centralBrokerId;
        return $code;
    }

    /**
     * This function gets the registered Staff
     *
     * @return string
     */
    public function registeredStaff()
    {
        $em = $this->entityManager;
        $data = $em->getRepository("GeneralServicer\Entity\BrokerChild")->findBRokerChild($this->centralBrokerId);

        return $data;
    }

    /**
     * condition if the user can still register more saffs
     *
     * @return boolean
     */
    public function registeredStaffCondition()
    {
        $sub = $this->generalService->getSubscription();

        $maxEmployee = $sub->getPackage()->getMaxEmployee();
        $usedEmployee = $this->countRegisteredStaff();
        $result = $maxEmployee - $usedEmployee;
        if ($result <= 0) {
            return false; // meaning You have used up all avalibale spaces
        } else {
            return true; // you can stiill do more employees
        }
    }

    /**
     * This counts the registered Staffs
     *
     * @return number
     */
    private function countRegisteredStaff()
    {
        $data = $this->getRegisteredStaffs();
        $count = count($data);
        return $count;
    }

    public function getRegisteredStaffs()
    {
        $em = $this->entityManager;
        $broker = $this->brokerId;
        $criteria = array(
            'broker' => $broker
        );
        $order = array(
            'id' => 'DESC'
        );

        $limit = 500;
        $data = $em->getRepository('GeneralServicer\Entity\BrokerChild')->findBy($criteria, $order, $limit);
        return $data;
    }

    private function sendConfirmationNotification($to, $link)
    {
        $mail = $this->mailService;

        $mail->send(array(
            'to' => $to,
            'subject' => 'Confirmation Notification',
            'template' => 'mail/register/staff'
        ), array(
            'lastname' => '', // entter the lastname of the person being registered
            'broker' => '', // Broker Name Here
            'link' => $link
        )); // This is a lilink
    }

    public function setGeneralService($serv)
    {
        $this->generalService = $serv;
        return $this;
    }

    public function setUserEntity($entity)
    {
        $this->userEntity = $entity;
        return $this;
    }

    public function setBrokerChildProfileEntity($entity)
    {
        $this->brokerChildProfileEntity = $entity;
        return $this;
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setBrokerChildEntity($entity)
    {
        $this->brokerChildEntity = $entity;
        return $this;
    }

    public function setMailService($xserv)
    {
        $this->mailService = $xserv;
        return $this;
    }

    public function setControllerPluginManager($plugin)
    {
        $this->controllerPluginManager = $plugin;
        return $this;
    }

    public function setRedirect($redi)
    {
        $this->redirect = $redi;
        return $this;
    }

    public function setBrokerId($brokerId)
    {
        $this->brokerId = $brokerId;
        return $this;
    }

    public function setSmsService($xserv)
    {
        $this->smsService = $xserv;
        return $this;
    }

    public function setCentralBrokerId($id)
    {
        $this->centralBrokerId = $id;
        return $this;
    }
    /**
     * @param mixed $urlViewHelper
     */
    public function setUrlViewHelper($urlViewHelper)
    {
        $this->urlViewHelper = $urlViewHelper;
        return $this;
    }

}

