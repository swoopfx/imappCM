<?php
namespace Job\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Policy\Service\CoverNoteService;
use Policy\Service\PolicyService;
use GeneralServicer\Service\GeneralService;

/**
 *
 * @author otaba
 *        
 */
class PolicyjobController extends AbstractActionController
{

    private $entityManager;

    private $generalService;

    private $smsService;

    private $clientGeneralService;

    public function __construct()
    {}

    /**
     * This action notifies the broker of an expiring covernote and the date it expires
     * Indicating that the customer would be expecting a policy on or before the expired date
     *
     * @return mixed
     */
    public function jobCovernoteExpiringAction()
    {
        $em = $this->entityManager;
        
        $expiringCovernote = $em->getRepository("Policy\Entity\Policy")->findExpiringCoverNote();
        if (count($expiringCovernote) > 0) {
            foreach ($expiringCovernote as $coverNote){
                // Notify Broker of the expiring covernote 
                $pointer = "";
                $pointer['to'] = $coverNote->getCustomer()
                ->getCustomerBroker()
                ->getBroker()->getUser()->getEmail();
                $pointer['fromName'] = $coverNote->getCustomer()
                ->getCustomerBroker()
                ->getBroker()
                ->getCompanyName();
                $pointer['subject'] = "Expiring Covernote ";
                
                /*
                 * TODO define and design a templle email 
                 */
                $template = "";
                $template["var"] = array(
                    "logo" => GeneralService::getBrokerogoStatic($coverNote->getCustomer()
                        ->getCustomerBroker()
                        ->getBroker()),
                    "brokerName" => $coverNote
                    ->getCustomer()
                    ->getCustomerBroker()
                    ->getBroker()
                    ->getCompanyName(),
                   "coverNoteEntity"=>$coverNote
                );
                $template["template"] = ""; 
                
                $this->generalService->sendMails($pointer, $template);
                
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    /**
     * job-expire-cover-note
     * This function gets all CoverNote certificate and
     * Sees if the note is date has equal the todays dat if so ,
     * the status of the cover note is changed to expired and a mail is sent to
     * the broker indicating the cover note has expired
     *
     * @return mixed
     */
    public function jobExpireCoverNoteAction()
    {
        $em = $this->entityManager;
//         $generalService = $this->generalService;
        // $mailService = $generalService->getMailService();

        // Extract all covernote
        $allCoverNote = $em->getRepository("Policy\Entity\Policy")->findJobExpiredCoverNote();
        if (count($allCoverNote) > 0) {
            foreach ($allCoverNote as $coverNote) {
                $coverNote->setCoverStatus($em->find("Policy\Entity\CoverNoteStatus", CoverNoteService::COVERNOTE_STATUS_EXPIRED))
                    ->setDateUpdated(new \DateTime());

                $em->persist($coverNote);
                $em->flush();
                $childBrokers = $coverNote->getCustomer()->getAssignedChildBroker();

                /**
                 * Send email
                 */

                $childBrokerEmails = array();
                foreach ($childBrokers as $broker) {
                    $childBrokerEmails[] = $broker->getUser()->getEmail();
                }
                $template = array(
                    "var" => array(
                        "logo" => $this->url()->fromRoute('welcome', array(), array(
                            'force_canonical' => true
                        )) . "images/logow.png", // IMAPPs logo
                        "brokerName" => $coverNote->getCustomer()
                            ->getCustomerBroker()
                            ->getBroker()
                            ->getCompanyName(),
                        "coveruid" => $coverNote->getCoverUid()
                    ),
                    "template" => "general-broker-expired-covernote-notify-mail"
                );
                $messagePointers = array(
                    "to" => $coverNote->getCustomer()
                        ->getCustomerBroker()
                        ->getBroker()
                        ->getUser()
                        ->getEmail(),
                    "fromName" => "IMAPP CM",
                    "subject" => "Expired CoverNote"
                );

                $this->generalService->sendMails($messagePointers, $template, "", $childBrokerEmails);

                // foreach ($childBrokers as $broker) {
                // $template = array(
                // "var" => array(
                // "logo" => $this->url()->fromRoute('welcome', array(), array(
                // 'force_canonical' => true
                // )) . "images/logow.png", // IMAPPs logo
                // "brokerName" => $coverNote->getCustomer()
                // ->getCustomerBroker()
                // ->getBroker()
                // ->getCompanyName(),
                // "coveruid" => $coverNote->getCoverUid()
                // ),
                // "template" => "general-broker-expired-covernote-notify-mail"
                // );
                // $messagePointers = array(
                // "to" => $broker->getUser()->getEmail(),
                // "fromName" => "IMAPP CM",
                // "subject" => "Expired CoverNote"
                // );
                // $this->generalService->sendMails($messagePointers, $template);
                // }
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    /**
     * job-policy-renewal-notify
     *
     * This action notifies the customer of the renewal of his policy
     * Sixrty days to the expiration and thirty days to expiration
     *
     * @return mixed
     */
    public function jobPolicyRenewalNotifyAction()
    { //
        $em = $this->entityManager;
        $policys = $em->getRepository("Policy\Entity\Policy")->findRenewablePolicy();
        if (count($policys) > 0) {
            foreach ($policys as $policy) {
                $coverNote = $policy->getCoverNote();
                $childBrokers = $coverNote->getCustomer()->getAssignedChildBroker();
                // $accountManager = "Ezekiel";
                if (count($childBrokers) > 0) {
                    $accountManager = $childBrokers[0];
                }
                $template = array(
                    "var" => array(
                        "logo" => GeneralService::getBrokerogoStatic($coverNote->getCustomer()
                            ->getCustomerBroker()
                            ->getBroker()), // brokerLogo
                        "brokerName" => $coverNote->getCustomer()
                            ->getCustomerBroker()
                            ->getBroker()
                            ->getCompanyName(),
                        "policy" => $policy,
                        "accountManager" => $accountManager
                    ),
                    "template" => "general-customer-policy-renewal-notify" // TODO design this template as it is empty
                );
                $messagePointers = array(
                    "to" => $coverNote->getCustomer()
                        ->getUser()
                        ->getEmail(),
                    "fromName" => $coverNote->getCustomer()
                        ->getCustomerBroker()
                        ->getBroker()
                        ->getCompanyName(),
                    "subject" => "Expiring Policy"
                );
                $this->generalService->sendMails($messagePointers, $template);
                $message = "Dear " . $coverNote->getCustomer()->getName() . " your policy " . $policy->getPolicyCode() . " is about to expire, please visit board to renew";
                $this->smsService->setCentralBrokerId($coverNote->getCustomer()
                    ->getCustomerBroker()
                    ->getBroker()
                    ->getId())
                    ->sendBrokerSms($coverNote->getCustomer()
                    ->getUser()
                    ->getUsername(), "IMAPP", $message);
            /**
             * Send sms notification toeach customer
             */
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    /**
     * job-change-expired-policy-status
     * This action changes the status of expired policy and notifies the customer that the siad policy has expired
     *
     * @return mixed
     */
    public function jobChangeExpiredPolicyStatusAction()
    {
        $em = $this->entityManager;
        // $generalService = $this->generalService;
        $policys = $em->getRepository("Policy\Entity\Policy")->findZeroDayExpirePolicy();
        if (count($policys) > 0) {
            foreach ($policys as $policy) {
                $policy->setPolicyStatus($em->find("Policy\Entity\PolicyStatus", PolicyService::POLICY_STATUS_INACTIVE))
                    ->setUpdatedOn(new \DateTime());

                $em->persist($policy);
                $em->flush();

                // Send mail to customer
                /*
                 * TODO define and create email template design
                 */
                $pointers = "";
                $pointers['to'] = $policy->getCoverNote()
                    ->getCustomer()
                    ->getUser()
                    ->getEmail();
                $pointers["fromName"] = $policy->getCoverNote()
                    ->getCustomer()
                    ->getCustomerBroker()
                    ->getBroker()
                    ->getBrokerName();
                $pointers['subject'] = "Expired Policy";

                $template = "";
                $template["var"] = array(
                    "logo" => GeneralService::getBrokerogoStatic($policy->getCoverNote()->getCustomer()
                        ->getCustomerBroker()
                        ->getBroker()),
                    "brokerName" => $policy->getCoverNote()
                        ->getCustomer()
                        ->getCustomerBroker()
                        ->getBroker()
                        ->getCompanyName(),
                    "policy" => $policy
                );
                $template["template"] = "";

                $this->generalService->sendMails($pointers, $template);
            }
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setGeneralService($xserv)
    {
        $this->generalService = $xserv;
        return $this;
    }

    public function setSmsService($xserv)
    {
        $this->smsService = $xserv;
        return $this;
    }

    public function setClientGeneralService($xserv)
    {
        $this->clientGeneralService = $xserv;
        return $this;
    }
}

