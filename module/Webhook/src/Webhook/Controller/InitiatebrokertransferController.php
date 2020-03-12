<?php
namespace Webhook\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Doctrine\ORM\EntityManager;
use Transactions\Entity\BrokerTransfer;
use Wallet\Entity\WalletTransaction;
use Transactions\Service\TransactionService;
use Wallet\Service\WalletService;

/**
 * This broker is the webnook for intiated brker transfer
 * What ever response from rave materializes here
 *
 * @author otaba
 *        
 */
class InitiatebrokertransferController extends AbstractRestfulController
{

    /**
     *
     * @var EntityManager
     */
    private $entityManager;

    // TODO - Insert your code here
    public function getList()
    { // Action used for GET requests without resource Id
        return new JsonModel(array(
            'data' => array(
                array(
                    'id' => 1,
                    'name' => 'Mothership',
                    'band' => 'Led Zeppelin'
                ),
                array(
                    'id' => 2,
                    'name' => 'Coda',
                    'band' => 'Led Zeppelin'
                )
            )
        ));
    }

    public function get($id)
    { // Action used for GET requests with resource Id
        return new JsonModel(array(
            "data" => array(
                'id' => 2,
                'name' => 'Coda',
                'band' => 'Led Zeppelin'
            )
        ));
    }

    public function create($data)
    {
        $em = $this->entityManager;
        // Action used for POST requests

        // {
        // "event.type": "Transfer",
        // "transfer": {
        // "id": 570,
        // "account_number": "0690000040",
        // "bank_code": "044",
        // "fullname": "Alexis Sanchez",
        // "date_created": "2018-06-11T14:07:49.000Z",
        // "currency": "NGN",
        // "amount": 9000,
        // "fee": 45,
        // "status": "SUCCESSFUL",
        // "reference": "rave-transfer-152812343460966",
        // "narration": "New transfer",
        // "approver": null,
        // "complete_message": "Approved Or Completed Successfully",
        // "requires_approval": 0,
        // "is_approved": 1,
        // "bank_name": "ACCESS BANK NIGERIA"
        // }
        // }
        if (count($data) > 0) {

            if (assertArrayHasKey("transfer", $data)) {
                $transfer = $data["transfer"];
                if ($transfer["status"] == "SUCCESSFUL") {
                    $transferReference = $transfer["reference"];
                    $transferAmount = $transfer["amount"];
                    /**
                     *
                     * @var BrokerTransfer $brokerTransferEntity
                     */
                    $brokerTransferEntity = $em->getRespository("Transactions\Entity\BrokerTransfer")->findOneBy(array(
                        "transferReference" => $transferReference
                    ));

                    $walletEntity = $brokerTransferEntity->getWallet();
                    $bookBalance = $walletEntity->getBookBalance();
                    $newBookBalance = floatval($bookBalance) - floatval($transferAmount);

                    $walletEntity->setBookBalance($newBookBalance);

                    $walletTransactionEntity = new WalletTransaction();
                    $walletTransactionEntity->setAmount($transferAmount)
                        ->setCreatedOn(new \DateTime())
                        ->setStatus($em->find("Transactions\Entity\TransactionStatus", TransactionService::TRANSACTION_STATUS_SUCCESS))
                        ->setTransactionType($em->find("Wallet\Entity\WalletTransactionType", WalletService::WALLET_TRANSACTION_TYPE_WITHDRAW))
                        ->setWallet($walletEntity);
                    $brokerTransferEntity->setStatus($em->find("Transactions\Entity\BrokerTransferStatus", TransactionService::BROKER_TRANSFER_STATUS_COMPLETED));
                    try {
                        $em->persist($brokerTransferEntity);
                        $em->persist($walletEntity);
                        $em->persist($walletTransactionEntity);
                    } catch (\Exception $e) {
                        // Log Error
                    }
                } else {
                    // was not successful
                    // return
                }
                // $transferAmount = $
            }
        }

        // return new JsonModel(array('data' => array('id'=> 3, 'name' => 'New Album', 'band' => 'New Band')));
    }

    public function update($id, $data)
    { // Action used for PUT requests
        return new JsonModel(array(
            'data' => array(
                'id' => 3,
                'name' => 'Updated Album',
                'band' => 'Updated Band'
            )
        ));
    }

    public function delete($id)
    { // Action used for DELETE requests
        return new JsonModel(array(
            'data' => 'album id 3 deleted'
        ));
    }

    /**
     *
     * @return mixed
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     *
     * @param mixed $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }
}

