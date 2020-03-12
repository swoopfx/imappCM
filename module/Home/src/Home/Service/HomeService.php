<?php
namespace Home\Service;

use CsnUser\Service\UserService;
use function GuzzleHttp\json_encode;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;
use Doctrine\Common\EventManager;
use Chatkit\Chatkit;

/**
 *
 * @author swoopfx
 *        
 */
class HomeService 
{
    
    private $eventManager;

    private $generalService;

    private $pluginManager;
    
    private $stanadarJson = array(
        "data"=>"standard"
    );
    
    
    public function chat(){
        $push = new Chatkit($options);
//         $push->createRoomRole($options)
    }

    public function dashboard()
    {
        $generalService = $this->generalService;
        $UserRole = $generalService->getUserRoleId();
        switch ($UserRole) {
            case UserService::USER_ROLE_BROKER:
                $data = array();
                $count = array();
                $data['stats'] = $count;
                // get BrokerData
                
                return $data;
                break;
            
            case UserService::USER_ROLE_BROKER_CHILD:
                $data = array();
                // get Broker Child data
                return $data;
                break;
        }
    }

    private function getBrokerActiveProposal()
    {
        $em = $this->generalService->getEntityManager();
        $broker = $this->generalService->getBrokerId();
        $criteria = array(
            'broker' => $broker
        );
        $order = array(
            'id' => 'DESC'
        );
        $limit = 20;
        $data = $em->getRepository('Proposal\Entity\ProposalBroker')->findBy($criteria, $order, $limit);
        return $data;
    }

    private function getBrokerInvoice()
    {
        $em = $this->generalService->getEntityManager();
        $broker = $this->generalService->getBrokerId();
        $criteria = array(
            'broker' => $broker
        );
        $order = array(
            'id' => 'DESC'
        );
        $limit = 20;
        $data = $em->getRepository('Transactions\Entity\BrokerCustomerInvoice')->findBy($criteria, $order, $limit);
        return $data;
    }

    private function getBrokerPolicy()
    {
        $em = $this->generalService->getEntityManager();
        $broker = $this->generalService->getBrokerId();
        $criteria = array(
            'broker' => $broker
        );
        $order = array(
            'id' => 'DESC'
        );
        $limit = 20;
        $data = $em->getRepository('Policy\Entity\PolicyBroker')->findBy($criteria, $order, $limit);
        return $data;
    }

    private function getBrokerChildProposal()
    {
        $em = $this->generalService->getEntityManager();
        $broker = $this->generalService->getChildBrokerId();
        $criteria = array(
            'brokerChild' => $broker
        );
        $order = array(
            'id' => 'DESC'
        );
        $limit = 20;
        $data = $em->getRepository('Proposal\Entity\BrokerChildProposal')->findBy($criteria, $order, $limit);
        return $data;
    }

    private function getBrokerChildPolicy()
    {
        $em = $this->generalService->getEntityManager();
        $broker = $this->generalService->getChildBrokerId();
        $criteria = array(
            'brokerChild' => $broker
        );
        $order = array(
            'id' => 'DESC'
        );
        $limit = 20;
        $data = $em->getRepository('Policy\Entity\PolicyChildBroker')->findBy($criteria, $order, $limit);
        return $data;
    }

    private function getBrokerChildInvoice()
    {
        $em = $this->generalService->getEntityManager;
    }

    public function brokerAccountDetailsCondition()
    {
        $url = $this->getUrl();
        
        if ($this->isBrokerBankAccountDetails() == FALSE) {
            return " <li>
                            <p><a href='/settings/broker-bank-account' class='btn btn-danger' >Setup Company Bank Account</a> </p>
                          </li>";
        }
    }
    
    public function flutterAccountCondition(){
        $url = $this->getUrl();
        
        if ($this->isFlutterwaveAccount() == FALSE) {
            return " <li>
                            <p><a href='/broker-tool/brokerflutterwave' class='btn btn-danger'>Setup Online Payment Gateway</a> </p>
                          </li>";
        }
    }
    
    public function staffRegisterCondition()
    {
        $url = $this->getUrl();
    
        if ($this->isStaffReigistered() == FALSE) {
            return " <li>
                            <p><a data-json='".json_encode($this->stanadarJson)."' data-href='/broker-tool/registerstaffmodal' class='btn btn-danger ajax_element' id='btn2'>Register A Staff</a> </p>
                          </li>";
            
        }
    }
    
    
    public function uploadLogoCondition(){
        $em = $this->generalService->getEntityManager();
       $centralBrokerId = $this->generalService->getCentralBroker();
       $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $centralBrokerId);
       if($brokerEntity->getCompanyLogo() == NULL){
           $link = "<li>
                            <p><a data-json='".json_encode($this->stanadarJson)."' data-href='/broker-tool/changelogo' class='btn btn-danger ajax_element' id='btn2'>Upload Company Logo</a>
</p>
                          </li>";
           return $link;
       }
      
    }
    
    public function ceoProfileCondition(){
        $em = $this->generalService->getEntityManager();
        $centralBrokerId = $this->generalService->getCentralBroker();
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $centralBrokerId);
        if($brokerEntity->getCeo() == NULL){
            $link = "<li>
                            <p><a  href='/settings/profile' class='btn btn-danger' >Update CEO profile</a>
</p>
                          </li>";
            return $link;
        }
        
    }
    
    private function isUploadLogo(){
        $em = $this->generalService->getEntityManager();
        $centralBrokerId = $this->generalService->getCentralBroker();
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $centralBrokerId);
        if($brokerEntity->getCompanyLogo() == NULL){
            return false;
        }else{
            return true;
        }
    }
    
    // use this function to fill the sms alias
    public function fillSMSAlias()
    {}

    private function isBrokerBankAccountDetails()
    {
        $brokerId = $this->generalService->getBrokerId();
        $em = $this->generalService->getEntityManager();
       
        $data = $em->find("Users\Entity\InsuranceBrokerRegistered", $brokerId);
//         $data = $em->getRepository("Users\Entity\BrokerBankAccount")->findOneBy($criteria);

        if($data != NULL){
            if ($data->getBrokerBankAccount() == NULL) {
            return FALSE;
        } else {
            return TRUE;
         }
        }
    }
    
    private function isCeoProfile(){
        $brokerId = $this->generalService->getBrokerId();
        $em = $this->generalService->getEntityManager();
        
        $data = $em->find("Users\Entity\InsuranceBrokerRegistered", $brokerId);
        if($data!= NULL){
            if($data->getCeo() == NULL){
                return FALSE;
            }else{
                    return TRUE;
                }
        }
    }
    
    private function isFlutterwaveAccount(){
        $brokerId = $this->generalService->getBrokerId();
        $em = $this->generalService->getEntityManager();
        $criteria = array(
            'broker' => $brokerId
        );
        $data = $em->getRepository("Transactions\Entity\BrokerFlutterwaveAccount")->findOneBy($criteria);
        if ($data == NULL) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function isStaffReigistered()
    {
        $brokerId = $this->generalService->getBrokerId();
        $em = $this->generalService->getEntityManager();
        $criteria = array(
            'broker' => $brokerId
        );
        $data = $em->getRepository("GeneralServicer\Entity\BrokerChild")->findOneBy($criteria);
        if ($data == NULL) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function isNotificatioReady(){
        $isStaff = $this->isStaffReigistered();
        $isAccount = $this->isBrokerBankAccountDetails();
        $isFlutterAccount = $this->isFlutterwaveAccount();
        $isCeo = $this->isCeoProfile();
        $isUploadLogo = $this->isUploadLogo();
        if ($isAccount == TRUE && $isCeo == TRUE && $isStaff == TRUE ){ //&& $isFlutterAccount == TRUE
            return TRUE;
        }
        else{
            return False;
        }
    }

    private function getUrl()
    {
        $urll = $this->pluginManager->get('url');
        return $urll;
    }

    public function setGeneralService($serve)
    {
        $this->generalService = $serve;
        return $this;
    }

    public function setPluginManager($pm)
    {
        $this->pluginManager = $pm;
        return $this;
    }
//     public function setEventManager(EventManagerInterface $eventManager)
//     {
//         $eventManager->setIdentifiers(array(__CLASS__, get_class($this)));
//         $this->eventManager = $eventManager;
//         return $this;
//     }

//     public function getEventManager()
//     {
//         if(!$this->eventManager){
// //             $this->eventManager = new EventManager(__CLASS__);

//              $this->setEventManager(new EventManager());
//         }
        
//         return $this->eventManager;
//     }
    
//     public function doSomething(){
// //         $hr = com
// //         $this->getEventManager()->trigger(__FUNCTION__, $this, $params);
//     }

}

?>