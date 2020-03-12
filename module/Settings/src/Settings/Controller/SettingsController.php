<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Settings for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Settings\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Users\Entity\BrokerBankAccount;
use CsnUser\Service\UserService;
use Users\Entity\BrokerCeo;
use Zend\Json\Json;
use Transactions\Entity\BrokerPayStackAccount;
use WasabiLib\Ajax\Response;
use WasabiLib\Ajax\Redirect;
use WasabiLib\Modal\WasabiModal;
use WasabiLib\Modal\WasabiModalView;

// use Zend\Http\Client;
class SettingsController extends AbstractActionController
{

    private $entityManager;

    private $generalService;

    private $brbankAccountForm;

    private $brbankAccountEntity;

    private $brokerId;

    private $brokerGeneralService;

    private $paymentService;

    private $acountName;

    private $accountNameForm;

    private $ceoForm;

    private $brokerChildForm;

    private $centralBrokerId;

    private $brokerChildId;

    private $paystackService;

    private $payStackPaymentService;

    private $blobService;

    private $dropZoneForm;

    private $renderer;

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        // $response = parent::on
        $this->redirectPlugin()->redirectCondition();
        return $response;
    }

    // begin modal
    public function webconnectionAction()
    {
        $response = new Response();
        $wasabiModal = new WasabiModal("standard", "Web Connection Settings");
        $viewModel = new ViewModel();
//         $viewModel->setTemplate("");
//         $wasabiModal->setContent($viewModel);
        
        $modalView= new WasabiModalView("#wasabi_modal", $this->renderer, $wasabiModal);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }
    
    
    public function apiconfigAction()
    {
        $response = new Response();
        $wasabiModal = new WasabiModal("standard", "API Documentation");
        $viewModel = new ViewModel();
        //         $viewModel->setTemplate("");
        //         $wasabiModal->setContent($viewModel);
        
        $modalView= new WasabiModalView("#wasabi_modal", $this->renderer, $wasabiModal);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }
    
    

    // End modal
    public function indexAction()
    {
        /**
         * Include button for signature Here
         *
         * @var Ambiguous $view
         */
        $view = new ViewModel();
        return $view;
    }

    public function newlogouploadAction()
    {
        $em = $this->entityManager;
        $blobService = $this->blobService;
        $response = NULL;
        $request = $this->getRequest();
        $generalService = $this->generalService;
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $generalService->getCentralBroker());
        if ($request->isPost() || $request->isXmlHttpRequest()) {
            $files = $this->params()->fromFiles('file');
            // var_dump($files[0]);
            $res = $this->blobService->uploadBlob($files);

            if ($res != False) {
                $brokerEntity->setCompanyLogo($res);

                $em->persist($brokerEntity);
                $em->persist($res);
                $em->flush();
            }
            $redirect = new Redirect($this->url()->fromRoute("settings/default", array(
                "action" => "profile"
            )));
            $response = new Response();
            $response->add($redirect);
        }

        return $this->getResponse()->setContent($response);
    }

    public function brokerBankAccountAction()
    {
        $this->redirectPlugin()->redirectCondition();
        $em = $this->entityManager;

        $bankAccountForm = $this->brbankAccountForm;

        $brokerAccountEntity = new BrokerBankAccount();
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);
        $bankAccountForm->bind($brokerAccountEntity);
        $bgs = $this->brokerGeneralService;
        $accountNameForm = $this->accountNameForm;
        $account = $bgs->getBrokerBankAccounts();

        $accountName = $bankAccountForm->get("brokerBankAccountFieldset")->get("accountName");
        $accountName->setAttributes(array(
            "value" => $brokerEntity->getCompanyName(),
            "disabled" => "disabled"
        ));

        $request = $this->getRequest();

        if ($request->isPost()) {

            $post = $request->getPost();
            $bankAccountForm->setData($post);

            $bankAccountForm->setValidationGroup(array(
                'brokerBankAccountFieldset' => array(
                    'bankName',
                    // 'accountName',
                    'bankAccountNo',
                    'swiftCode',
                    'sortCode',
                    'bankAddress'
                )
            ));

            if ($bankAccountForm->isValid()) {
                $data = $bankAccountForm->getData();
                try {

                    $brokerAccountEntity->setCreatedOn(new \DateTime())->setAccountName($brokerEntity->getCompanyName());

                    $brokerEntity->setBrokerBankAccount($brokerAccountEntity);
                    $em->persist($brokerAccountEntity);

                    $em->flush();
                    $this->flashmessenger()->addSuccessMessage("Successfully inputed a bank acoount ");
                    $this->redirect()->toRoute('settings/default', array(
                        'action' => 'broker-bank-account'
                    ));
                } catch (\Exception $e) {

                    $this->flashmessenger()->addErrorMessage("Hydration Error!");
                }
            }
        }
        $view = new ViewModel(array(
            'accountForm' => $bankAccountForm,
            'account' => $account,
            "accountNameForm" => $accountNameForm,
            "brokerEntity" => $brokerEntity
        ));

        return $view;
    }

    public function bankAccountAction()
    {
        $em = $this->entityManager;
        $brokerBankAccountEntity = new BrokerBankAccount();
        $bankAccountSession = new Container("bankAccountSession");
        $request = $this->getRequet();
        if ($request->isPost()) {
            $post = $request->getPost();
        }
        return $this->getResponse()->setContent(NULL);
    }

    public function webconfigAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }

    public function accountNameAction()
    {
        $this->redirectPlugin()->redirectCondition();
        $em = $this->entityManager;
        $bankAccountSession = new Container("bankAccountSession");
        $this->getResponse()->setContent("NULL");
        $paymentService = $this->paymentService;
        $accountNameForm = $this->accountNameForm;
        $request = $this->getRequest();

        // $postArray = $this->getRequest()->getPost();
        if ($request->isPost()) {
            $postArray = $this->getRequest()->getPost();
            $nigeriaBankEntity = $em->find("Settings\Entity\NigeriaBanks", $postArray['bankName']);
            $bankMoneyWaveCode = $nigeriaBankEntity->getMoneyWaveCode();
            $paymentService->setMoneyWaveBankCode($bankMoneyWaveCode)->setRecipientsAcc($postArray['bankAccountNo']);
            $body = $paymentService->fetchAccountName();

            $bankAccountSession->accountName = NULL;
            if ($body->status) {
                $bankAccountSession->accountName = $body->data->account_name;
                $bankAccountSession->bank = $postArray['bankName'];
                $bankAccountSession->bankName = $nigeriaBankEntity->getBankName();
                $bankAccountSession->accountNumber = $postArray['bankAccountNo'];

                $this->redirect()->toRoute("settings/default", array(
                    "action" => "broker-bank-account"
                ));
            } else {
                $bankAccountSession->accountName = NULL;
                $bankAccountSession->bank = $postArray['bankName'];
                $bankAccountSession->accountNumber = $postArray['bankAccountNo'];

                $this->flashmessenger()->addErrorMessage("We could not retrieve the account Name at this time ");
                $this->flashmessenger()->addErrorMessage("Please check tinformation submitted ");
                $this->redirect()->toRoute("settings/default", array(
                    "action" => "broker-bank-account"
                ));
            }
        }

        return $this->getResponse()->setContent(NULL);
    }

    public function profileAction()
    {
        $this->redirectPlugin()->redirectCondition();
        $em = $this->entityManager;

        $user = $this->identity();
        $dropZoneForm = $this->dropZoneForm;
        $dropZoneForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("settings/default", array(
                "action" => "newlogoupload"
            ))
        ));
        $request = $this->getRequest();
        $userRole = $user->getRole()->getId();
        $brokerChildEntity = NULL;
        $brokerEntity = NULL;
        $brokerCeoEntity = NULL;
        if ($userRole == UserService::USER_ROLE_BROKER) {
            $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->brokerId);
            if ($brokerEntity == NULL) {
                $this->flashmessenger()->addErrorMessage("No broker identifier found");
                $this->redirect()->toRoute("dashboard");
            }
        } elseif ($userRole == UserService::USER_ROLE_BROKER_CHILD) {
            $brokerChildEntity = $em->find("GeneralServicer\Entity\BrokerChild", $this->brokerChildId);
            if ($brokerChildEntity == NULL) {
                $this->flashmessenger()->addErrorMessage("No broker identifier found");
                $this->redirect()->toRoute("dashboard");
            }
        }

        $ceoForm = $this->ceoForm;
        $brokerChildForm = $this->brokerChildForm;
        if ($userRole == UserService::USER_ROLE_BROKER) {
            if ($brokerEntity->getCeo() != NULL) {
                $brokerCeoEntity = $brokerEntity->getCeo();
                $ceoForm->bind($brokerEntity->getCeo());
            } else {
                $brokerCeoEntity = new BrokerCeo();
                $ceoForm->bind($brokerCeoEntity);
            }
        } elseif ($userRole == UserService::USER_ROLE_BROKER_CHILD) {

            $brokerChildForm->bind($brokerChildEntity);
            // var_dump($brokerChildEntity->getId());
        }

        if ($request->isPost()) {
            $post = $request->getPost();
            // var_dump($post);
            if ($userRole == UserService::USER_ROLE_BROKER) {
                $ceoForm->setData($post);
                $ceoForm->setValidationGroup(array(
                    "brokerCeoFieldset" => array(
                        "firstname",
                        "lastname",
                        "email",
                        // "phone",
                        "linkedIn",
                        "facebook",
                        "tweeter"
                    )
                ));
                if ($ceoForm->isValid()) {
                    $data = $ceoForm->getData();
                    // var_dump($this->centralBrokerId);
                    $brokerCeoEntity->setBroker($em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId))
                        ->setEmail($data->getEmail())
                        ->setFacebook($data->getFacebook())
                        ->setFirstname($data->getFirstname())
                        ->setLastname($data->getLastname())
                        ->setLinkedIn($data->getLinkedIn())
                        ->setPhone($data->getPhone())
                        ->setTweeter($data->getTweeter())
                        ->setCreatedOn(new \DateTime());

                    try {

                        $em->persist($brokerCeoEntity);
                        $em->flush();
                        $this->flashmessenger()->addSuccessMessage("Profile successfully updated");
                        $this->redirect()->refresh();
                    } catch (\Exception $e) {
                        $this->flashmessenger()->addErrorMessage("There was a problem creating your profile");
                        $this->redirect()->refresh();
                    }
                }
            }

            if ($userRole == UserService::USER_ROLE_BROKER_CHILD) {
                $brokerChildForm->setData($post);
                // var_dump($post);
                $brokerChildForm->setValidationGroup(array(
                    "brokerChildFieldset" => array(
                        "firstname",
                        "lastname",
                        "facebook",
                        "linkedIn",
                        "tweeter"
                    )
                ));
                if ($brokerChildForm->isValid()) {
                    $data = $brokerChildForm->getData();
                    // var_dump();
                    $brokerChildEntity->setFirstname($data->getFirstname())
                        ->setLastname($data->getLastname())
                        ->setFacebook($data->getFacebook())
                        ->setBroker($em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId))
                        ->setLinkedIn($data->getLinkedIn())
                        ->setTweeter($data->getTweeter())
                        ->setModifiedOn(new \DateTime());
                    try {
                        $em->persist($brokerChildEntity);
                        $em->flush();

                        $this->flashmessenger()->addSuccessMessage("Successfully updated your profile");
                        $this->redirect()->refresh();
                    } catch (\Exception $e) {
                        $this->flashmessenger()->addErrorMessage("We could not update your profile");
                        $this->redirect()->refresh();
                    }
                }
            }
        }

        $view = new ViewModel(array(
            "ceoForm" => $ceoForm,
            "brokerChildForm" => $brokerChildForm,
            "brokerEntity" => $brokerEntity,
            "brokerChildEntity" => $brokerChildEntity,
            "dropZoneForm" => $dropZoneForm
        ));
        return $view;
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setBankAccountform($form)
    {
        $this->brbankAccountForm = $form;
        return $this;
    }

    public function setBankAccountEntity($entity)
    {
        $this->brbankAccountEntity = $entity;
        return $this;
    }

    public function setBrokerId($id)
    {
        $this->brokerId = $id;
        return $this;
    }

    public function setBrokerGeneralService($xserv)
    {
        $this->brokerGeneralService = $xserv;
        return $this;
    }

    public function setPaymentService($xserv)
    {
        $this->paymentService = $xserv;
        return $this;
    }

    public function setAccountNameForm($form)
    {
        $this->accountNameForm = $form;
        return $this;
    }

    public function setCeoForm($form)
    {
        $this->ceoForm = $form;
        return $this;
    }

    public function setBrokerChildForm($form)
    {
        $this->brokerChildForm = $form;
        return $this;
    }

    public function setCentralBroker($id)
    {
        $this->centralBrokerId = $id;
        return $this;
    }

    public function setBrokerChildId($id)
    {
        $this->brokerChildId = $id;
        return $this;
    }

    public function setPayStackService($xserv)
    {
        $this->paystackService = $xserv;
        return $this;
    }

    public function setPayStackPaymentService($xserv)
    {
        $this->payStackPaymentService = $xserv;
        return $this;
    }

    public function setBlobService($blob)
    {
        $this->blobService = $blob;
        return $this;
    }

    public function setGeneralService($xserv)
    {
        $this->generalService = $xserv;
        return $this;
    }

    public function setDropZoneForm($form)
    {
        $this->dropZoneForm = $form;
        return $this;
    }
    /**
     * @param mixed $renderer
     */
    public function setRenderer($renderer)
    {
        $this->renderer = $renderer;
        return $this;
    }

}
