<?php
namespace SMS\Service;

// use CsnUser\Service\UserService;
use Zend\Http\Client;
use Zend\Http\Request;
use Zend\Json\Json;
use SMS\Entity\SMSAccount;
use Zend\Http\Response;
use Users\Entity\InsuranceBrokerRegistered;

/**
 *
 * @author swoopfx
 *        
 */
class SMSService
{

    const SMS_PRICE = 3;

    private $to;

    private $from;

    private $message;

    private $entityManager;

    private $smsBroker;

    private $smsAccount;

    private $broker;

    // jThis is instantiated at runtime for account setup
    private $brokerId;

    // This is instatiated by the factory
    private $motherBrokerId;

    private $userRoleId;

    private $months;

    private $centralBrokerId;

    private $generalServic;

    private $setUpPackage;

    private $smsUnits;

    const SETUP_CREDIT = 50;
    
//     public function 

    /**
     * This updates the sms account
     * @param int|string $brokerId
     * @return InsuranceBrokerRegistered
     */
    public function updateSmsAccount($brokerId = NULL)
    {
        $em = $this->entityManager;
        $_brokerId = NULL;
        $brokerEntity = NULL;
        if($brokerId == NULL){
           $_brokerId = $this->centralBrokerId;
        }
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $_brokerId);
        $avaialbleUnit = $brokerEntity->getSmsBroker()->getAvailableCredit();
        $updateUnits = $this->smsUnits;
        $finalUnit = $avaialbleUnit + $updateUnits;
        $smsAccount = $brokerEntity->getSmsBroker();
        $smsAccount->setAvailableCredit($finalUnit)->setUpdatedOn(new \DateTime());
        return $brokerEntity;
       
    }
    
    public function sendGeneralSms($to, $from = "IMAPP", $text = "Welcome On Board")
    {
        $number = $this->refinePhoneNumber($to);
        $this->send($number, $from, $text);
    }
    
    public function getSenderName()
    {
        /**
         * If sender doc has been made,
         * Send with compay alias
         * else send with IMAPP
         */
        return "IMAPP";
    }
    
    /**
     * This function sends an sms on behalf of the assigned broker 
     * It deducts the total amount of sms send on behalf of the boker from his account
     * and returns a serires of notification 
     * 
     * @param string $to
     * @param string $from
     * @param string $message
     */
    public function sendBrokerSms($to, $from = NULL, $message = NULL)
    {
        $em = $this->entityManager;
        $centralBrokerid = $this->centralBrokerId;
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $centralBrokerid);
        $smsAccount = $brokerEntity->getSmsBroker();
        $smsAvailableCredit = $smsAccount->getAvailableCredit();
        if ($smsAvailableCredit > 0) {
            if ($this->centralBrokerId != NULL) {
                $number = $this->refinePhoneNumber($to);
                if($from == NULL){
                    $sFrom = $this->getBrokerSmsAlias();
                }
                $response = $this->send($number, $sFrom, $message);
                // $response = new Response();
                if ($response->isSuccess()) {
                    $body = Json::decode($response->getBody());
                    // var_dump($body);
                    // $body = $response->getBody();
                    $statusGroupId = $body->messages[0]->status->groupId;
                    switch ($statusGroupId) {
                        case "1":
                        case "3":
                            
                            // deduct
                            $this->deductFromBrokerAccount($body->messages[0]->smsCount);
                            
                            $info['status'] = true;
                            $info['count'] = $body->messages[0]->smsCount;
                            break;
                            
                        default: // error
                            $info['status'] = false;
                            $info['message'] = "We could not send a message to the designated Phone number ";
                            break;
                    }
                }
            }
        }
    }

    public function SMSSetupAccountCreate()
    {
        $em = $this->entityManager;
        $smsBroker = $this->smsBroker;
        $smsAccount = $this->smsAccount;
        $broker = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->broker);
        
        $brokerName = $broker->getBrokerName();
        $smsAlias = substr($brokerName, 0, 11);
        $smsBroker->setBroker($broker);
        $smsBroker->setSms($smsAccount);
        $totalCredit = $this->smsUnits * $this->months;
        
        $smsAccount->setAvailableCredit($totalCredit);
        $smsAccount->setCreatedOn(new \DateTime());
        $smsAccount->setAlias($smsAlias);
        // var_dump("sms_problecm");
        try {
            $em->persist($smsAccount);
            $em->persist($smsBroker);
            $em->flush();
        } catch (\Exception $e) {
            return $e->getTraceAsString();
        }
    }

    public function createSMSAccount()
    {
        $em = $this->entityManager;
        ;
        $smsAccountEntity = new SMSAccount();
        $totalCredit = $this->smsUnits;
        $smsAccountEntity->setAlias("INS BROKER")
            ->setCreatedOn(new \DateTime())
            ->setAvailableCredit($this->smsUnits);
    }

    public function buySmsService()
    {
        $em = $this->entityManager;
    }

//     public function brokerSend()
//     {
//         $centraBrokerId = $this->centralBrokerId;
//         $info = array();
        
//         // echo $centraBrokerId;
//         if ($centraBrokerId != NULL) {
//             $this->from = "IMAPP"; // $this->getBrokerSmsAlias();
            
//             $response = $this->send();
            
//             if ($response->isSuccess()) {
//                 $body = Json::decode($response->getBody());
//                 // var_dump($body);
//                 // $body = $response->getBody();
//                 $statusGroupId = $body->messages[0]->status->groupId;
//                 switch ($statusGroupId) {
//                     case "1":
//                     case "3":
                        
//                         // deduct
//                         $this->deductFromBrokerAccount($body->messages[0]->smsCount);
//                         $info['status'] = true;
//                         $info['count'] = $body->messages[0]->smsCount;
//                         break;
                    
//                     default: // error
//                         $info['status'] = false;
//                         $info['message'] = "We could not send a message to the designated Phone number ";
//                         break;
//                 }
//             } elseif ($response->isClientError()) {
//                 $info['status'] = false;
//                 $info['message'] = "We could not send a message to the designated Phone number ";
//             } else {
//                 $info['status'] = false;
//                 $info['message'] = "We could not send a message to the designated Phone number ";
//             }
//         }
        
//         return $info;
//     }

    private function deductFromBrokerAccount($count)
    {
        $em = $this->entityManager;
        $centralBrokerid = $this->centralBrokerId;
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $centralBrokerid);
        $smsAccount = $brokerEntity->getSmsBroker();
        $smsAvailableCredit = $smsAccount->getAvailableCredit();
        
        $balance = $smsAvailableCredit - $count;
        
        $smsAccount->setAvailableCredit($balance)->setUpdatedOn(new \DateTime());
        
        try {
            $em->persist($smsAccount);
            $em->flush();
        } catch (\Exception $e) {
            // flash message
        }
        // if ($$brokerSmsAccount != NULL){
        
        // }
    /**
     * Get the cetral broker SMS account
     */
    }

    public function send($to, $from, $message)
    {
        $endPoint = "http://api.infobip.com/sms/1/text/single";
        // $adapter = "Zend\Http\Client\Adapter\Curl";
        $client = new Client();
        $client->setUri($endPoint);
        // $client->setAdapter($adapter);
        // $client->getRequest()->getHeader()->addHeaders();
        
        $client->setHeaders(array(
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic SS1NYW5hZ2VyOk9sdXdhc2V1bjFA'
        ));
        $client->setMethod(Request::METHOD_POST);
        $to = $this->refinePhoneNumber($to);
        $param = array(
            'from' => $from,
            'to' => $to,
            'text' => $message
        );
        $client->setRawBody(Json::encode($param));
        
        return $client->send();
    }

   

    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * This is used when the broker or child broker makes a n activity that requires
     */
    private function getBrokerSmsAlias()
    {
        $smsBroker = $this->smsBroker;
        return $smsBroker->getSms()->getAlias();
    }

    public function getBrokerSMSCredit()
    {
        $em = $this->entityManager;
        $criteria = array(
            "broker" => $this->centralBrokerId
        );
        
        $data = $em->getRepository("SMS\Entity\SMSAccount")->findOneBy($criteria);
        
        return $data;
    }

    private function getMotherBrokerCredit()
    {
        $em = $this->entityManager;
        $criteria = array(
            "broker" => $this->motherBrokerId
        );
        $data = $em->getRepository("SMS\Entity\SMSBroker")->findOneBy($criteria);
        return $data;
    }

    /**
     * This is used a immediate runtoime
     *
     * @param string $brokerId            
     * @return \SMS\Service\SMSService
     */
    public function setBroker($brokerId)
    {
        $this->broker = $brokerId;
        return $this;
    }

    public function getSetupPackage($pack)
    {
        switch ($pack) {
            case "1":
                $this->setUpPackage = 1;
                break;
            
            case "2":
                $this->setUpPackage = 1.2;
                break;
            case "3":
                $this->setUpPackage = 1.5;
                break;
        }
    }

    public function getAvailableCredit()
    {
        $em = $this->entityManager;
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);
        return $brokerEntity->getSmsBroker()->getAvailableCredit();
    }

    public function refinePhoneNumber($number)
    {
        $subString = substr($number, 0, 4);
        $strlength = strlen($number);
        $replaced = NULL;
        if ($subString != "+234" && $strlength == 11) {
            $replaced = substr_replace($number, "+234", 0, 1);
        } else {
            $replaced = $number;
        }
        
        return $replaced;
    }

  

    public function setMonth($mth)
    {
        $this->months = $mth;
        return $this;
    }

    public function setUnits($units)
    {
        $this->smsUnits = $units;
        return $this;
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setSmsBroker($sms)
    {
        $this->smsBroker = $sms;
        return $this;
    }

    public function setSmsAccount($sms)
    {
        $this->smsAccount = $sms;
        return $this;
    }

    public function setBrokerId($id)
    {
        $this->brokerId = $id;
        return $this;
    }

    public function setMotherBrokerId($id)
    {
        $this->motherBrokerId = $id;
        return $this;
    }

    public function setUserRoleId($id)
    {
        $this->userRoleId = $id;
        return $this;
    }

    public function setCentralBrokerId($central)
    {
        $this->centralBrokerId = $central;
        return $this;
    }

    public function setGeneralService($xserv)
    {
        $this->generalServic = $xserv;
        return $this;
    }
}

