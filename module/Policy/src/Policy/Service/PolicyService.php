<?php
namespace Policy\Service;

use CsnUser\Service\UserService;
use Offer\Service\OfferService;
use GeneralServicer\Service\GeneralService;
use Policy\Entity\Policy;
use Doctrine\ORM\EntityManager;
use Transactions\Entity\Invoice;
use GeneralServicer\Service\CurrencyService;
use Transactions\Service\InvoiceService;
use Transactions\Entity\MicroPayment;
use Transactions\Service\TransactionService;
use Transactions\Entity\Transaction;
use Policy\Entity\PolicyHook;
use Object\Entity\Object;
use Policy\Entity\CoverNote;
use ZfcBase\EventManager\EventProvider;
use GeneralServicer\Service\TriggerService;

/**
 *
 * @author swoopfx
 *        
 */
class PolicyService extends EventProvider
{

    /**
     *
     * @var EntityManager
     */
    private $entityManager;

    private $centralBrokerId;

    private $policySession;

    private $customerId;

    private $urlViewHelper;

    /**
     *
     * @var InvoiceService
     */
    private $invoiceService;

    const POLICY_STATUS_PENDING = 3;

    const POLICY_STATUS_ACTIVE = 1;

    const POLICY_STATUS_INACTIVE = 2;

    // also as EXPIRED
    const POLICY_STATUS_SUSPENDED = 4;

    // const POLICY_STATUS_EXPIRED = 2;
    const POLICY_STATUS_ISSUED_BUT_PENDING = 7;

    const POLICY_STATUS_ISSUED_AND_VALID = 5;

    const POLICY_STATUS_PROCESSING = 6;

    const POLICY_ACTIVITY_CREATED = 10;

    const POLICY_COVER_DURATION_YEAR = 1;

    const POLICY_COVER_DURATION_HALF_YEAR = 20;

    const POLICY_COVER_DURATION_QUATER_YEAR = 30;

    const POLICY_COVER_DURATION_MONTHLY = 40;

    const POLICY_COVER_DURATION_TERMED = 100;

    const POLICY_HOOK_STATUS_INITIATED = 10;

    const POLICY_HOOK_STATUS_SETTLED = 100;

    /**
     *
     * @var GeneralService
     */
    private $generalServie;

    // Begin Polcy Entity Details
    private $policyExpirationDate;

    private $policyPremium;

    private $policyPremiumChangeReason;

    private $policyInvoice;

    /**
     * This functio gets the list of uncompleted policy hook un attended to
     *
     * @param string $policyId
     * @return array
     */
    public function getPolicyHookRenewable($policyId)
    {
        $em = $this->entityManager;

        $hooks = $em->getRepository("Policy\Entity\PolicyHook")->findBy(array(
            "policy" => $policyId,
            "policyHookStatus" => PolicyService::POLICY_HOOK_STATUS_INITIATED
        ));

       
        return $hooks;
    }

    /**
     *
     * @param array|mixed $data
     * @param Policy $entity
     * @param
     *            EntityManager
     * @return mixed
     */
    public function renewpolicy($data, Policy $entity, $em = NULL)
    {
        // check if the policy is paid for
        // if so, call the
        try {

            $em = $this->calculatePolicyExpiration($data, $entity, $em);
            $em = $this->processchangepremium($data, $entity, $em);

            /**
             * if premium is changed
             * change the value of the prmiumon the covernote
             */

            $em = $this->processInvoice($data, $entity, $em);

            if ($data["isPaid"] == FALSE) {
                $em = $this->policyhook($data, $entity, $em);
            }

            // $renewalDuration = $data["renewDuration"];
            // switch ($renewalDuration){
            // case PolicyService::POLICY_COVER_DURATION_YEAR:
            // $policyExpireDate = $entity->getEndDate();

            // $newPolicyExpireDate;
            // break;
            // }
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }

        $em->persist($entity);
        return $em;
    }

    /**
     * This function calculates and sets the expiration date of the policy
     *
     * @param array $data
     * @param Policy $entity
     * @param EntityManager $em
     */
    private function calculatePolicyExpiration($data, Policy $entity, EntityManager $em)
    {
        $newExpirationDate = NULL;

        if ($data["specificDate"] == TRUE) {
            $this->policyExpirationDate = new \DateTime($data["selectDate"]);
        } else {
            // calculate the amount of
            $policyEndDate = clone $entity->getEndDate();
            if ($data["renewDuration"] == PolicyService::POLICY_COVER_DURATION_YEAR) {
                $addMonths = "P12M";
                $interval = new \DateInterval($addMonths);
                $newExpirationDate = $policyEndDate->add($interval);
            } elseif ($data["renewDuration"] == PolicyService::POLICY_COVER_DURATION_QUATER_YEAR) {
                $addMonths = "P3M";
                $interval = new \DateInterval($addMonths);
                $newExpirationDate = $policyEndDate->add($interval);
            } elseif ($data["renewDuration"] == PolicyService::POLICY_COVER_DURATION_HALF_YEAR) {
                $addMonths = "P3M";
                $interval = new \DateInterval($addMonths);
                $newExpirationDate = $policyEndDate->add($interval);
            } elseif ($data["renewDuration"] == PolicyService::POLICY_COVER_DURATION_MONTHLY) {
                $addMonths = "P1M";
                $interval = new \DateInterval($addMonths);
                $newExpirationDate = $policyEndDate->add($interval);
            }

            $this->policyExpirationDate = $newExpirationDate;
            if ($data["isPaid"]) {
                // $entity->setEndDate($$this->policyExpirationDate);
            }
        }

        $em->persist($entity);
        return $em;
    }

    /**
     *
     * @param array $data
     * @param Policy $entity
     * @param EntityManager $em
     * @return EntityManager
     */
    private function policyhook($data, Policy $entity, $em)
    {
        $policyHookEntity = new PolicyHook();
        $brokerId = $this->generalServie->getCentralBroker();
        $broker = $em->find("Users\Entity\InsuranceBrokerRegistered", $brokerId);

        $policyHookEntity->setCreatedon(new \DateTime())
            ->setHookId(PolicyService::getPolicyHookId())
            ->setInvoice($this->policyInvoice)
            ->setPolicyEndDate($this->policyExpirationDate)
            ->setPolicy($entity)
            ->setPolicyHookStatus($em->find("Policy\Entity\PolicyHookStatus", PolicyService::POLICY_HOOK_STATUS_INITIATED))
            ->setNewPremium(CurrencyService::cleanInputValueStatic($this->policyPremium))
            ->setReasonForChange($this->policyPremiumChangeReason);

        // $policyHookEntity
        // var_dump($this->policyPremium);

        $mailParam = array(
            "messagePointers" => array(
                "to" => $entity->getCoverNote()
                    ->getCustomer()
                    ->getUser()
                    ->getEmail(),
                "fromName" => $broker->getBrokerName(),
                "subject" => "Policy renewal Initiated"
            ),
            "template" => array(
                "template" => "general-mail-default",
                "var" => array(
                    "logo" => $this->generalServie->getBrokerAbsoluteLogo(),
                    "message" => "A renewal for policy " . $entity->getPolicyCode() . " has been initiated, please login to your portal to finalize by paying for this renewal",
                    // "message" => "Your claim title {$claimsEntity->getClaimTopic()} funds has been disbursed",
                    "title" => "Policy Renewal Initiated"
                )
            )
        );

        $this->getEventManager()->trigger(TriggerService::TRIGGER_POLICY_RENEWED_MAIL, $this, $mailParam);

        // $param = array(
        // "hook" => $policyHookEntity,
        // "policy" => $entity,
        // "user" => $this->generalServie->getUserId(),
        // "broker" => $this->generalServie->getBroker()
        // );
        // $this->getEventManager()->trigger(TriggerService::TRIGGER_POLICY_RENEWED_POLICY_HOOK, $this, $mailParam);

        $em->persist($policyHookEntity);
        return $em;
    }

    private function processchangepremium($data, Policy $entity, EntityManager $em)
    {
        $premium = NULL;
        if ($data["isChangePremium"]) {
            $premium = CurrencyService::cleanInputValueStatic($data["premium"]);
            $entity->getCoverNote()
                ->setPremiumPayable(CurrencyService::cleanInputValueStatic($premium))
                ->setPremiumChangeReason($data["changeReason"]);
            $this->policyPremium = $premium;
            $this->policyPremiumChangeReason = $data["changeReason"];
        } else {
            $premium = CurrencyService::cleanInputValueStatic($data["premium"]);
        }
        $this->policyPremium = $premium;

        $em->persist($entity);
        return $em;
    }

    /**
     *
     * @param string|array $data
     * @param Policy $entity
     * @param EntityManager $em
     * @return EntityManager
     */
    private function processInvoice($data, $entity, $em = NULL)
    {

        // identify if it is a micro payment
        // generate invoice
        // generate $microPayment if it is
        $invoiceEntity = new Invoice();
        $invoiceEntity->setAmount(CurrencyService::cleanInputValueStatic($data["premium"]))
            ->setCustomer($entity->getCoverNote()
            ->getCustomer())
            ->setInvoiceCategory($em->find("Transactions\Entity\InvoiceCategory", PolicyService::policyOriginCategoryforInvoice($entity)))
            ->setCurrency($em->find("Settings\Entity\Currency", CurrencyService::NIGERIA_NAIRA))
            ->setGeneratedOn(new \DateTime())
            ->setInvoiceUid(InvoiceService::generateUidStatic())
            ->setIsOpen(TRUE)
            ->setCoverNote($entity->getCoverNote())
            ->setExpiryDate(new \DateTime());

        // $policyCategory = $entity->getCoverNote()
        // ->getCoverCategory()
        // ->getId();
        // if ($policyCategory == CoverNoteService::COVERNOTE_CATEGORY_PROPOSAL) {
        // $invoiceEntity->setProposal($entity->getCoverNote()
        // ->getProposal());
        // } elseif ($policyCategory == CoverNoteService::COVERNOTE_CATEGORY_FLOAT_POLICY) {
        // $invoiceEntity->setPolicyFloat($entity->getCoverNote()
        // ->getPolicyFloat());
        // } elseif ($policyCategory == CoverNoteService::COVERNOTE_CATEGORY_OFFER) {
        // $invoiceEntity->setOffer($entity->getCoverNote()
        // ->getOffer());
        // } elseif ($policyCategory == CoverNoteService::COVERNOTE_CATEGORY_PACKAGES) {
        // $invoiceEntity->setPackages($entity->getCoverNote()
        // ->getPackage());
        // }

        if ($data["isPaid"] == TRUE) {
            $entity->setEndDate($this->policyExpirationDate);
            $invoiceEntity->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_PAID_STATUS));
            $this->processIsPaid($data, $invoiceEntity, $em);
            $em->persist($entity);
        } else {

            $invoiceEntity->setStatus($em->find("Transactions\Entity\InvoiceStatus", InvoiceService::INVOICE_UNPAID_STATUS));
        }

        if ($data["isMicro"] == TRUE) {
            $invoiceEntity->setIsMicro(TRUE);
            $microPayment = $this->invoiceService->generateMicroPayment($data["microPAymentFieldset"]["microPayment"], CurrencyService::cleanInputValueStatic($data["amount"]));
            for ($i = 0; $i < count($microPayment["value"]); $i ++) {

                $microPaymentEntity = new MicroPayment();

                $microPaymentEntity->setCreatedOn(new \DateTime())
                    ->setDueDate($microPayment["dueDate"][$i])
                    ->setValue($microPayment["value"][$i])
                    ->setInvoice($invoiceEntity)
                    ->setMicroPaymentStructure($em->find("Settings\Entity\MicroPaymentStructure", $data["microPAymentFieldset"]["microPayment"]))
                    ->setStatus($em->find("Transactions\Entity\TransactionStatus", TransactionService::TRANSACTION_STATUS_PENDING));

                $em->persist($microPaymentEntity);
            }
        }
        $this->policyInvoice = $invoiceEntity;
        $em->persist($invoiceEntity);
        return $em;
    }

    /**
     *
     * @param Invoice $invoiceEntity
     * @param EntityManager $em
     * @return \Doctrine\ORM\EntityManager
     */
    private function processIsPaid($data, Invoice $invoiceEntity, EntityManager $em)
    {
        $transactionEntity = new Transaction();

        $brokerId = $this->generalServie->getCentralBroker();
        $broker = $em->find("Users\Entity\InsuranceBrokerRegistered", $brokerId);
        $transactionEntity->setCreatedOn(new \DateTime())
            ->setInvoice($invoiceEntity)
            ->setPaymentDate(new \DateTime())
            ->setPaymentMode($em->find("Settings\Entity\PaymentMode", $data["manualPayment"]["paymentMode"]))
            ->
        // ->setMicroPayment()s
        setTransactStatus($em->find("Transactions\Entity\TransactionStatus", TransactionService::TRANSACTION_STATUS_SUCCESS))
            ->setTransactUid(TransactionService::generateStaticUid());

        $em->persist($transactionEntity);

        $mailParam = array(
            "messagePointers" => array(
                "to" => $invoiceEntity->getCoverNote()
                    ->getCustomer()
                    ->getUser()
                    ->getEmail(),
                "fromName" => $broker->getBrokerName(),
                "subject" => "Policy Renewal Transaction "
            ),
            "template" => array(
                "template" => "general-customer-transaction",
                "var" => array(
                    "customerName" => $invoiceEntity->getCoverNote()
                        ->getCustomer()
                        ->getName(),
                    "orderDate" => new \DateTime(),
                    "orderId" => $transactionEntity->getTransactUid(),
                    "paymentType" => "Cash",
                    "paymentMode" => "Full Payment",
                    "service" => "Policy Renewal",
                    "amount" => CurrencyService::cleanInputValueStatic($data["premium"]),
                    "brokerName" => $broker->getBrokerName(),
                    "serviceDescription" => "Payment for the renewal of policy " . $invoiceEntity->getCoverNote()
                        ->getPolicy()
                        ->getPolicyCode()
                )
            )
        );

        $this->getEventManager()->trigger(TriggerService::TRIGGER_POLICY_RENEWED_MAIL, $this, $mailParam);

        return $em;
    }

    // private
    public function hydratePolicyInfo($data, $entity)
    {
        $em = $this->entityManager;
        $entity->setCreatedOn(new \DateTime())
            ->setEndDate($data->getEndDate())
            ->setExtraInfo($data->getExtraInfo())
            ->setIsActive(TRUE)
            ->setIsAutoRenew($data->getIsAutoRenew())
            ->setIsLocked(TRUE)
            ->setPolicyCode($data->getPolicyCode())
            ->setPolicyName($data->getPolicyName())
            ->setPolicyStatus($em->find("Policy\Entity\PolicyStatus", PolicyService::POLICY_STATUS_ISSUED_AND_VALID))
            ->setPolicyUid($this->getPolicyUid())
            ->setStartDate($data->getStartDate());

        return $entity;
    }

    /**
     *
     * @param Policy $policyEntity
     * @return number
     */
    public static function policyOriginCategoryforInvoice($policyEntity)
    {
        $category = $policyEntity->getCoverNote()
            ->getCoverCategory()
            ->getId();
        switch ($category) {
            case CoverNoteService::COVERNOTE_CATEGORY_PROPOSAL:
                return InvoiceService::INVOICE_CAT_PROPOSAL;
                break;
            case CoverNoteService::COVERNOTE_CATEGORY_PACKAGES:
                return InvoiceService::INVOICE_CAT_PACKAGE;
                break;
            case CoverNoteService::COVERNOTE_CATEGORY_FLOAT_POLICY:
                return InvoiceService::INVOICE_CAT_POLICY;
                break;
            case CoverNoteService::COVERNOTE_CATEGORY_OFFER:
                return InvoiceService::INVOICE_CAT_OFFER;
                break;
            default:
                return InvoiceService::INVOICE_CAT_ADVERT;
                break;
        }
    }

    /**
     * This gets the name of the insurance company providing cover for the policy
     * if the covernote Insurer is not set,
     * Call the individual insurer selected by the proposal, offer, float or apackage entity
     *
     * @return string
     * @param object $policyEntity
     */
    public static function getInsurerName($policyEntity)
    {
        if ($policyEntity->getCoverNote()->getInsurer() != NULL) {
            return $policyEntity->getCoverNote()
                ->getInsurer()
                ->getInsuranceName();
        } else {
            $categoryId = $policyEntity->getCoverNote()
                ->getCoverCategory()
                ->getId();
            if ($categoryId == CoverNoteService::COVERNOTE_CATEGORY_PROPOSAL) {
                return $policyEntity->getCoverNote()
                    ->getProposal()
                    ->getInsurer()
                    ->getInsuranceName();
            } elseif ($categoryId == CoverNoteService::COVERNOTE_CATEGORY_OFFER) {

                return OfferService::getInsurerByName($policyEntity->getCoverNote()->getOffer());
            } elseif ($categoryId == CoverNoteService::COVERNOTE_CATEGORY_FLOAT_POLICY) {
                // return float insurer
            } elseif ($categoryId == CoverNoteService::COVERNOTE_CATEGORY_PACKAGES) {} else {
                return GeneralService::GENERAL_EMPTY_FIELD;
            }
        }
    }

    /**
     * This function gets the amount payable by the policy
     * without taking into consideration if there is a micro payment or not,
     * This references the invoice becos the premium might be auto generated or manually generated
     * On either point they both resolve to the invoice entity which signify the payment to be made
     *
     * @param object $policyEntity
     */
    public static function getPremiumPayable($policyEntity)
    {
        $premium = "";
        if ($policyEntity->getCoverNote()->getPremiumPayable() != NULL) {
            return $policyEntity->getCoverNote()->getPremiumPayable();
        } elseif (count($policyEntity->getCoverNote()->getInvoice()) > 0) { // get CoverNote Invoice
            $invoiceEntity = $policyEntity->getCoverNote()->getInvoice();

            return $invoiceEntity[0]->getAmount();
        } else {
            $categoryId = $policyEntity->getCoverNote()
                ->getCoverCategory()
                ->getId();
            if ($categoryId == CoverNoteService::COVERNOTE_CATEGORY_PROPOSAL) {
                return $policyEntity->getCoverNote()
                    ->getProposal()
                    ->getInvoice()
                    ->getAmount();
            } elseif ($categoryId == CoverNoteService::COVERNOTE_CATEGORY_OFFER) {

                return $policyEntity->getCoverNote()
                    ->getOffer()
                    ->getInvoice()
                    ->getAmount();
            } elseif ($categoryId == CoverNoteService::COVERNOTE_CATEGORY_FLOAT_POLICY) {
                // return float insurer
                return $policyEntity->getCoverNote()
                    ->getPolicyFloat()
                    ->getInvoice()
                    ->getAmount();
            } elseif ($categoryId == CoverNoteService::COVERNOTE_CATEGORY_PACKAGES) {
                //
                return $policyEntity->getCoverNote()
                    ->getPackage()
                    ->getInvoice()
                    ->getAmount();
            } else {
                return GeneralService::GENERAL_EMPTY_FIELD;
            }
        }

        return $premium;
    }

    /**
     *
     * @param Policy $policyEntity
     * @return \Object\Entity\Object|array
     */
    public static function getAssociatedObjects($policyEntity)
    {
        /**
         *
         * @var Object|array $objects
         */
        $objects = NULL;
        $coverNoteEntity = $policyEntity->getCoverNote();
        switch ($coverNoteEntity->getCoverCategory()->getId()) {
            case CoverNoteService::COVERNOTE_CATEGORY_PROPOSAL:
                $objects = $coverNoteEntity->getProposal()->getObject();
                break;

            case CoverNoteService::COVERNOTE_CATEGORY_OFFER:
                $objects = $coverNoteEntity->getOffer()->getObject();
                break;

            case CoverNoteService::COVERNOTE_CATEGORY_PACKAGES:
                $objects = $coverNoteEntity->getPackage()->getObject();
                break;

            case CoverNoteService::COVERNOTE_CATEGORY_FLOAT_POLICY:
                $objects = $coverNoteEntity->getPolicyFloat()->getObjects();
                break;

            // case CoverNoteService::COV
        }
        return $objects;
    }

    // public function getInsurerLogo($policyEntity)
    // {
    // // $url = $this->urlViewHelper;
    // $insurerLogoUrl = $url."/img/insure-logo/";
    // if ($policyEntity->getCoverNote()->getInsurer() == NULL) {
    // $categoryId = $policyEntity->getCoverNote()
    // ->getCoverCategory()
    // ->getId();

    // if ($categoryId == CoverNoteService::COVERNOTE_CATEGORY_PROPOSAL) {
    // $logo = $policyEntity->getCoverNote()
    // ->getInsurer()
    // ->getLogo();
    // return $insurerLogoUrl.$logo;
    // }elseif ($categoryId == CoverNoteService::COVERNOTE_CATEGORY_OFFER){

    // }
    // }
    // }

    /**
     * This function gets the active invoice on the policy
     * If The policy entity invoice is null,
     * It locates the origin of the policy , be it offer, proposal or floatPolicy
     * Then it gets the active policy on it
     *
     * @param Policy $policyEntity
     * @return object
     */
    public function getPolicyActiveInvoice($policyEntity)
    {
        if ($policyEntity->getCoverNote()->getInvoice() == NULL) {
            return $this->policyOriginInvoice($policyEntity);
        } else {
            $invoice = $policyEntity->getCoverNote()->getInvoice();
            return $invoice[0];
        }
    }

    /**
     *
     * @param Policy $policyEntity
     * @throws \Exception
     * @return number
     */
    private function policyOriginInvoice($policyEntity)
    {
        $coverNoteEntity = $policyEntity->getCoverNote();
        $coverNoteCategory = $coverNoteEntity->getCoverCategory()->getId();
        if ($coverNoteCategory == CoverNoteService::COVERNOTE_CATEGORY_PROPOSAL) {
            $proposalEntity = $coverNoteEntity->getProposal();
            return $proposalEntity->getInvoice();
        } elseif ($coverNoteCategory == CoverNoteService::COVERNOTE_CATEGORY_FLOAT_POLICY) {
            $policyFloatEntity = $coverNoteEntity->getPolicyFloat();
            return $policyFloatEntity->getInvoice();
        } elseif ($coverNoteCategory == CoverNoteService::COVERNOTE_CATEGORY_OFFER) {
            $offerEntity = $coverNoteEntity->getOffer();
            return $offerEntity->getInvoice();
        } elseif ($coverNoteCategory == CoverNoteService::COVERNOTE_CATEGORY_CUSTOMER) {
            // do something
        } elseif ($coverNoteCategory == CoverNoteService::COVERNOTE_CATEGORY_PACKAGES) {
            $packageEntity = $coverNoteEntity->getPackage();
            return $packageEntity->getInvoice();
        } else {
            throw new \Exception("Invoice lacks origin");
        }
    }

    public function getIncompletePolicy()
    {
        return $this->entityManager->getRepository('Policy\Entity\Policy')->getIncompletePolicy($this->userId, TRUE);
    }

    public function getMyPolicy()
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Policy\Entity\Policy")->findBrokerPolicy($this->centralBrokerId);
        return $data;
    }

    public function getMyCoverNote()
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Policy\Entity\Policy")->findBrokerCoverNote($this->centralBrokerId);
        return $data;
    }

    public function getExpiringPolicy()
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Policy\Entity\Policy")->findExpiringPolicy($this->centralBrokerId);
        return $data;
    }

    public function getCompanyPolicy()
    {
        $genralService = $this->generalServie;
        if ($genralService->getUserId() != NULL) {
            $userRole = $genralService->getUserRoleId();
            if ($userRole == UserService::USER_ROLE_BROKER_CHILD) {
                return $this->getMotherBrokerPolicy();
            }
        }
    }

    public static function getPolicyHookId()
    {
        $const = "policyhook";
        $code = \uniqid($const);
        return $code;
    }

    public function getPolicyUid()
    {
        $const = "policy";
        $code = \uniqid($const);
        return $code;
    }

    public function getPolicyFloatUid()
    {
        $const = "float";
        $code = \uniqid($const);
        return $code;
    }

    private function getBrokerPolicy()
    {
        $data = NULL;
        $generalService = $this->generalServie;
        $em = $generalService->getEntitymanager();

        $data = $em->getRepository('Policy\Entity\Policy')->findAllBrokerPolicy($generalService->getBrokerId(), false);
        return $data;
    }

    /**
     * This gets a customer policy for a specific broker
     *
     * @return array
     */
    public function getBrokerCustomerPolicy()
    {
        $data = NULL;
        $generalService = $this->generalServie;
        $em = $generalService->getEntityManager();
        $data = $em->getRepository('Policy\Entity\Policy')->findBrokerCustomerPolicy($this->customerId);
        return $data;
    }

    private function getChildBrokerPolicy()
    {
        $data = NULL;
        $generalService = $this->generalServie;
        $em = $generalService->getEntitymanager();
        $criteria = array(
            'broker' => $generalService->getChildBrokerId()
        );

        $order = array(
            'id' => 'DESC'
        );
        $data = $em->getRepository('Policy\Entity\PolicyChildBroker')->findBy($criteria);
        return $data;
    }

    private function getMotherBrokerPolicy()
    {
        $data = NULL;
        $generalService = $this->generalServie;
        $em = $generalService->getEntitymanager();
        $criteria = array(
            'broker' => $generalService->getMotherBrokerId()
        );

        $order = array(
            'id' => 'DESC'
        );
        $data = $em->getRepository('Policy\Entity\PolicyBroker')->findBy($criteria);
        return $data;
    }

    public function getAllMyPolicy()
    {
        $criteria = array(
            'user' => $this->userId,
            'isHidden' => false
        );
        $order = array(
            'id' => 'DESC'
        );
        return $this->entityManager->getRepository('Policy\Entity\Policy')->findBy($criteria, $order);
    }

    public function getPolicySession()
    {
        return $this->policySession;
    }

    // Begin setters
    public function setGeneralService($serice)
    {
        $this->generalServie = $serice;
        return $this;
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setCentralBrokerId($id)
    {
        $this->centralBrokerId = $id;
        return $this;
    }

    public function setPolicySession($sess)
    {
        $this->policySession = $sess;
        return $this;
    }

    public function setCustomerId($id)
    {
        $this->customerId = $id;
        return $this;
    }

    // ENd Setters

    /**
     *
     * @return mixed
     */
    public function getUrlViewHelper()
    {
        return $this->urlViewHelper;
    }

    /**
     *
     * @param mixed $urlViewHelper
     */
    public function setUrlViewHelper($urlViewHelper)
    {
        $this->urlViewHelper = $urlViewHelper;
        return $this;
    }

    public function setInvoiceService($invoiceService)
    {
        $this->invoiceService = $invoiceService;
        return $this;
    }
}

