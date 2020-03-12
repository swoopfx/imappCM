<?php
namespace Customer\Service;

use CsnUser\Service\UserService;
use Users\Entity\InsuranceBrokerRegistered;
use Customer\Entity\Customer;
use CsnUser\Entity\User;
// use CsnUser\Service\RoleService;
use CsnUser\Service\StateService;
use Customer\Entity\CustomerBroker;
use GeneralServicer\Service\GeneralService;

/**
 *
 * @author swoopfx
 *        
 */
class CustomerService
{

    private $customerEntity;

    private $entityManager;

    private $userId;

    private $auth;

    private $broker;

    private $brokerId;

    // private $defaultPin = 1234;
    private $redirect;

    private $childBrokerId;

    private $childBroker;

    private $bcacb;

    private $customer;

    private $limit = 100;

    private $userRole;

    private $motherBroker;

    private $customerBrokerEntity;

    private $customerChildBrokerEntity;

    private $centralBrokerId;

    private $generalService;

    private $viewRender;

    private $smsService;

    private $mailService;

    private $mailer;

    private $flashMessenger;

    private $urlPulgin;

    private $urlViewHelper;

    private $brokerCustomerSession;

    const CUSTOMER_CATEGORY_IND = 2;

    const CUSTOMER_CATEGORY_ORG = 1;

    const CUSTOMER_ADMIN_BROKER = 1;

    const CUSTOMER_ADMIN_AGENT = 2;

    /**
     * This get all assigned child broker to the specific customer
     *
     * @param int $customerId
     * @return array()
     */
    public function getAssignedBroker($customerId)
    {
        $em = $this->entityManager;
        $customerEntity = $em->find("Customer\Entity\Customer", $customerId);
        return $customerEntity->getAssignedChildBroker();
    }

    public function hydrateCustomer($customerEntity)
    {
        $em = $this->entityManager;
        // $mailService = $this->mailService;
        $customerBrokerEntity = $this->customerBrokerEntity;
        // $childBroker = $this->childBroker;

        $pinCode = $this->pinCodeGenerator();
        // $customerBrokerEntity = new CustomerBroker();

        $userEntity = new User();
        $centralBrokerId = $this->centralBrokerId;
        $centralBroker = $em->find("Users\Entity\InsuranceBrokerRegistered", $centralBrokerId);

        $userRole = $this->userRole;
        switch ($userRole) {
            case UserService::USER_ROLE_BROKER:
            case UserService::USER_ROLE_BROKER_CHILD:
                $customerEntity->setAdministrator($em->find("Customer\Entity\CustomerAdministrator", CustomerService::CUSTOMER_ADMIN_BROKER));
                $customerBrokerEntity->setCustomer($customerEntity);
                $customerBrokerEntity->setBroker($em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId));
                if ($this->userRole == UserService::USER_ROLE_BROKER) {
                    $customerBrokerEntity->setBroker($em->find("Users\Entity\InsuranceBrokerRegistered", $this->brokerId));
                } else if ($this->userRole == UserService::USER_ROLE_BROKER_CHILD) {
                    /**
                     * As it is child broker,
                     * assign this broker to him
                     */
                    $count["1"] = "1";

                    // var_dump($this->generalService->getBrokerChildId());
                    foreach ($count as $childBroker) {
                        $customerEntity->addAssignedChildBroker($em->find("GeneralServicer\Entity\BrokerChild", $this->generalService->getBrokerChildId()));
                    }
                }

                $em->persist($customerBrokerEntity);
                break;
        }
        $userEntity->setUsername($customerEntity->getUser()
            ->getUsername());
        $userEntity->setEmail($customerEntity->getUser()
            ->getEmail());
        $userEntity->setPassword(UserService::encryptPassword($pinCode));
        $userEntity->setRegistrationDate(new \DateTime());
        $userEntity->setRole($em->find("CsnUser\Entity\HierarchicalRole", UserService::USER_ROLE_CUSTOMER));
        $userEntity->setState($em->find("CsnUser\Entity\State", StateService::STATE_ENABLED));
        $userEntity->setRegistrationToken(md5(uniqid(mt_rand(), true)));
        $userEntity->setEmailConfirmed(false);
        $userEntity->setLanguage($em->find("CsnUser\Entity\Language", GeneralService::LANGUAGE_ENGLISH));
        $userEntity->setProfiled(true);
        $userEntity->setEmailConfirmed(false);

        $customerEntity->setCreatedOn(new \DateTime('NOW'));
        $customerEntity->setUser($userEntity)->setIsHidden(FALSE);

        $customerEntity->setAccountId($this->generateCustomerCode());

        // $brokerLogo = "";
        // $var = array();

        // var_dump($this->urlPulgin("client_login", array(
        // "brokerid" => "12333"
        // ), array(
        // 'force_canonical' => true
        // )));

        // // send SMS notification of passcode
        // // Begin sms
        // $message = "You have been registered on " . $centralBroker->getCompanyName() . " portal with Username: " . $userEntity->getUsername() . " Pin: " . $pinCode;

        $em->persist($userEntity);
        $em->persist($customerEntity);
        $em->flush();
        // return $pinCode;
        // return $customerEntity;
        return array(
            "customerEntity" => $customerEntity,
            "pinCode" => $pinCode
        );
        // } catch (\Exception $e) {
        // // echo $e->getTraceAsString();
        // $this->flashMessenger->addErrorMessage("!!OOpps something went wrong pease contact administrator");
        // }
    }

    public function isBrokerAssigned()
    {
        $bool = FALSE;

        return $bool;
    }

    public function getAllAssingedBroker()
    {
        $em = $this->entityManager;
        $data = $em->getRepository()->findBy();
        return $data;
    }

    public function getLatestCustomers()
    {
        $em = $this->entityManager;
        $this->getBroker();
        $criteria = array(
            "broker" => $this->broker
        );
        $order = array(
            'id' => 'DESC'
        );
        $limit = 30;
        $data = $em->getRepository("Customer\Entity\CustomerBroker")->findBy($criteria, $order, $limit);
        return $data;
    }

    public function getTotalCustomers()
    {
        $em = $this->entityManager;

        $this->getBroker();
        $criteria = array(
            "broker" => $this->broker
        );
        $order = array(
            'id' => 'DESC'
        );
        $limit = 30000;
        $data = $em->getRepository("Customer\Entity\CustomerBroker")->findBy($criteria, $order, $limit);
        return $data;
    }

    /**
     * This calls Proposals for a spcific Customer
     */
    public function getSpecificCustomerProposals()
    {
        $data = NULL;
        $em = $this->entityManager;
        $criteria = array(
            'customer' => $this->customer,
            "isActive" => TRUE
        );
        $order = array(
            'id' => 'DESC'
        );
        $limit = $this->limit;
        $data = $em->getRepository('Proposal\Entity\Proposal')->findBy($criteria, $order, $limit);
        return $data;
    }

    /**
     * This calls Proposals for a spcific Customer
     */
    public function getSpecificCustomerOffers()
    {
        $data = NULL;
        $em = $this->entityManager;
        $criteria = array(
            'customer' => $this->customer,
            'isPolicized' => false
        );
        $order = array(
            'id' => 'DESC'
        );
        $limit = $this->limit;
        $data = $em->getRepository('Offer\Entity\Offer')->findBy($criteria, $order, $limit);
        return $data;
    }

    /**
     * This calls all the claims for a specific Customer
     *
     * @return Object
     */
    public function getSpecificCustomerClaims()
    {
        $data = NULL;
        $em = $this->entityManager;
        $criteria = array(
            'customer' => $this->customer,
            "isSettled" => FALSE,
            "isHidden" => FALSE
        );
        $order = array(
            'id' => 'DESC'
        );
        $limit = $this->limit;
        $data = $em->getRepository('Claims\Entity\Claims')->findBy($criteria, $order, $limit);
        return $data;
    }

    public function getSpecificCustomerPolicy()
    {
        $data = NULL;
        $em = $this->entityManager;
        $criteria = array(
            'customer' => $this->customer
        );
        $order = array(
            'id' => 'DESC'
        );
        $limit = 20;
        $data = $em->getRepository('Policy\Entity\Policy')->findBy($criteria, $order, $limit);
        return $data;
    }

    /**
     * This sets the customer
     *
     * @param integer $customer
     * @return \Customer\Service\CustomerService
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * This returns a limit of brokers customer
     *
     * @return object
     */
    public function getLatestBrokerCustomer()
    {
        $em = $this->entityManager;
        $data = $em->getRepository()->findBy();
        return $data;
    }

    /**
     * This gets the users customer based on his userole
     *
     * @return object
     */
    public function getMyCustomer()
    {
        if ($this->auth->hasIdentity()) {
            switch ($this->userRole) {
                case UserService::USER_ROLE_BROKER:
                    return $this->getBrokerCustomer();
                    break;

                case UserService::USER_ROLE_BROKER_CHILD:
                    return $this->getChildBrokerCustomer();
                    break;
            }
        }
    }

    /**
     * This gets all customers registered to the mother broker
     * used internally
     *
     * @return object
     */
    private function getBrokerCustomer()
    {
        if ($this->auth->hasIdentity()) {

            $em = $this->entityManager;
            $data = $em->getRepository('Customer\Entity\Customer')->findBrokerCustomers($this->brokerId);
            return $data;
        }
    }

    /**
     * This returns all customer assigned to a child broker
     * used internally
     *
     * @return object
     */
    private function getChildBrokerCustomer()
    {
        if ($this->auth->hasIdentity()) {

            $em = $this->entityManager;

            $data = $em->getRepository('Customer\Entity\Customer')->findAllChildBrokerCustomer($this->centralBrokerId);
            return $data;
        }
    }

    /**
     * This function gets The customers of the mother Broker Provided the
     * user accessing the information is a child broker
     *
     * @return Customer
     */
    public function getMotherBrokerCustomers()
    {
        $em = $this->entityManager;
        if ($this->userRole == UserService::USER_ROLE_BROKER_CHILD) {
            $broker = $this->getMotherBroker();
            $criteria = array(
                'broker' => $broker->getId()
            );
            $order = array(
                'id' => 'DESC'
            );
            $limit = 10000;
            $data = $em->getRepository('Customer\Entity\CustomerBroker')->findBy($criteria, $order, $limit);
            return $data->getCustomer();
        }
    }

    /**
     * This function gets The motherbroker provided the broker
     * accessing information is the Child Broker
     *
     * @return InsuranceBrokerRegistered
     */
    // private function getMotherBroker()
    // {
    // $em = $this->entityManager;
    // if ($this->userRole == UserService::USER_ROLE_BROKER_CHILD) {
    // $criteria = array(
    // 'user' => $this->userId
    // );
    // $order = array(
    // 'id' => 'DESC'
    // );
    // $limit = 100;
    // $data = $em->getRepository('GeneralServicer\Entity\BrokerChild')->findBy($criteria, $order, $limit);
    // return $data->getBroker();
    // }
    // }

    /**
     * This is the child broker Asscoated to a customer
     */
    public function getCustomerAssginedChildBroker($customer)
    {
        $em = $this->entityManager;

        $data = $em->getRepository('Customer\Entity\Customer')->findAllAssignedChildBroker($customer, $this->centralBrokerId);

        return $data;
    }

    public function getBrokerCustomerSession()
    {
        return $this->brokerCustomerSession;
    }

    public function generateCustomerCode()
    {
        $const = "cus";
        if ($this->userId != NULL) {
            $id = $this->userId;
        } else {
            $id == 00;
        }
        $code = \uniqid($const) . $id;
        return $code;
    }

    // private function setBroker($entity)
    // {
    // $em = $this->entityManager;
    // $childBroker = $this->getChildBroker();
    // if (count($childBroker) != 0) {
    // $entity->setBroker($em->find("Users\Entity\InsuranceBrokerRegistered", $childBroker[0]));
    // $entity->setChildBroker($em->find("GeneralServicer\Entity\BrokerChild", $childBroker[1]));
    // } else {
    // $entity->setBroker($em->find("Users\Entity\InsuranceBrokerRegistered", $this->getBroker()));
    // }
    // }
    private function setAgent($entity)
    {
        $em = $this->entityManager;
        $childAgent = $this->getChildAgent();
        if (count($childAgent) != 0) {
            $entity->setAgent($em->find("Users\Entity\InsuranceAgent", $childAgent[0]));
            $entity->setChildAgent($em->find("GeneralServicer\Entity\AgentChild", $childAgent[1]));
        } else {
            $entity->setAgent($em->find("Users\Entity\InsuranceAgent", $this->getBroker()));
        }
    }

    // protected function getBroker()
    // {
    // $childBroker = $this->getChildBroker();
    // if ($childBroker != NULL) {
    // $this->broker = $childBroker->getBroker()->getId();
    // } else {
    // $em = $this->entityManager;
    // $broker = $em->getRepository('Users\Entity\InsuranceBrokerRegistered')->findOneBy(array(
    // 'user' => $this->userId
    // ));
    // $this->broker = $broker->getId();
    // return $broker->getId();
    // }
    // }

    // protected function getChildBroker()
    // {
    // $em = $this->entityManager;
    // $broker = $em->getRepository("GeneralServicer\Entity\BrokerChild")->findOneBy(array(
    // 'user' => $this->userId
    // ));
    // if ($broker != NULL) {
    // $this->childBroker = $broker->getId();
    // }

    // return $broker;
    // }

    // protected function getAgent()
    // {
    // // $childBroker = $this->getChildBroker();
    // // if($childBroker[0] != NULL ){
    // // return $childBroker;
    // // }else{
    // $em = $this->entityManager;
    // $broker = $em->getRepository('Users\Entity\InsuranceAgent')->findOneBy(array(
    // 'user' => $this->userId
    // ));
    // return $broker->getId();
    // // }
    // }

    // private function getChildAgent()
    // {
    // $em = $this->entityManager;
    // $broker = $em->getRepository('GeneralServicer\Entity\AgentChild')->findOneBy(array(
    // 'user' => $this->userId
    // ));
    // $broker[0] = $broker->getAgent()->getId();
    // $broker[1] = $broker->getId();

    // return $broker;
    // }
    public function pinCodeGenerator()
    {
        $i = 0; // counter
        $pin = ""; // our default pin is blank.
        while ($i < 4) {
            // generate a random number between 0 and 9.
            $pin .= mt_rand(0, 9);
            $i ++;
        }
        return $pin;
    }

    // Begin Setters
    public function setEntityManager($em)
    {
        $this->entityManager = $em;

        return $this;
    }

    public function setUserId($id)
    {
        $this->userId = $id;
        return $this;
    }

    public function setCustomerEntity($entity)
    {
        $this->customerEntity = $entity;

        return $this;
    }

    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;

        return $this;
    }

    public function setBrokerCustomerAssignedChildBroker($entity)
    {
        $this->bcacb = $entity;
        return $this;
    }

    public function setUserRole($role)
    {
        $this->userRole = $role;
        return $this;
    }

    public function setBrokerId($brokerId)
    {
        $this->brokerId = $brokerId;
        return $this;
    }

    public function setBrokerChild($child)
    {
        $this->childBroker = $child;
        return $this;
    }

    public function setChildBrokerId($child)
    {
        $this->childBrokerId = $child;
        return $this;
    }

    public function setMotherBroker($mother)
    {
        $this->motherBroker = $mother;
        return $this;
    }

    public function setAuth($auth)
    {
        $this->auth = $auth;
        return $this;
    }

    public function setCustomerBrokerEntity($entity)
    {
        $this->customerBrokerEntity = $entity;
        return $this;
    }

    public function setCustomerChildBrokerEntity($entity)
    {
        $this->customerChildBrokerEntity = $entity;
        return $this;
    }

    public function setCentralBrokerId($id)
    {
        $this->centralBrokerId = $id;
        return $this;
    }

    public function setGeneralService($xser)
    {
        $this->generalService = $xser;
        return $this;
    }

    public function setViewRender($xserv)
    {
        $this->viewRender = $xserv;
        return $this;
    }

    public function setSmsService($xserv)
    {
        $this->smsService = $xserv;
        return $this;
    }

    public function setMailService($xserv)
    {
        $this->mailService = $xserv;
        return $this;
    }

    public function setFlash($flash)
    {
        $this->flashMessenger = $flash;
        return $this;
    }

    public function setMailer($mail)
    {
        $this->mailer = $mail;
        return $this;
    }

    public function setBrokerCustomerSession($broker)
    {
        $this->brokerCustomerSession = $broker;
        return $this;
    }

    public function setUrlPlugin($plugin)
    {
        $this->urlPulgin = $plugin;
        return $this;
    }

    public function setUrlViewhelper($view)
    {
        $this->urlViewHelper = $view;
        return $this;
    }
    // End Setters
}

