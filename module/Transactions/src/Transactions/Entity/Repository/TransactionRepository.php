<?php
namespace Transactions\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Transactions\Service\InvoiceService;

/**
 *
 * @author otaba
 *        
 */
class TransactionRepository extends EntityRepository
{

    public function findAllManulaPayment($brokerId)
    {
        $dql = "SELECT p, i FROM Transactions\Entity\TransactionManualProcess p JOIN p.invoice i JOIN i.customer c JOIN c.customerBroker cb WHERE cb.broker = :broker AND i.status = :status AND i.isOpen = :open ORDER BY p.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "broker" => $brokerId,
            "open" => TRUE,
            "status" => InvoiceService::INVOICE_UNPAID_STATUS
        
        ))
            ->getResult();
        return $query;
    }

    public function findCustomerTransactions($customer)
    {
//         $dql = "SELECT i FROM Transactions\Entity\Invoice i JOIN WHERE i.customer =: cus AND COUNT(i.transaction) > 0 ORDER BY i.id DESC";
//         $query = $this->getEntityManager()
//             ->createQuery($dql)
//             ->setParameters(array(
//             "cus" => $customer
//         ))
//             ->setMaxResults(100)
//             ->getResult();
//         return $query;
    }
}

