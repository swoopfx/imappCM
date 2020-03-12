<?php
namespace Transactions\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Transactions\Service\InvoiceService;

/**
 *
 * @author swoopfx
 *        
 */
class InvoiceRepository extends EntityRepository
{

    private $expiringTime = 16;

    public function findBrokerCustomerInvoices($broker)
    {
        $max = 100;
        $dql = "SELECT i, c, ic FROM Transactions\Entity\Invoice i JOIN i.customer c JOIN c.customerBroker cb JOIN i.invoiceCategory ic WHERE cb.broker = :broker   ORDER BY i.id DESC ";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'broker' => $broker
            // "open" => TRUE
        
        ))
            ->setMaxResults($max)
            ->getResult();
        return $query;
    }

    public function findExpiredBrokerCustomerInvoice($broker)
    {
        $max = 10000;
        $dql = "SELECT i FROM Transactions\Entity\Invoice i  WHERE i.broker = :broker AND i.status = :status ORDER BY i.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'broker' => $broker,
            'status' => InvoiceService::INVOICE_EXPIRED_STATUS
        ))
            ->setMaxResults($max)
            ->getResult();
        
        return $query;
    }

    public function findExpiredChildBrokerCustomerInvoice($childBroker)
    {
        $max = 10000;
        $dql = "SELECT i FROM Transactions\Entity\Invoice i   WHERE i.brokerChild = :broker AND i.status = :status ORDER BY i.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'broker' => $childBroker,
            'status' => InvoiceService::INVOICE_EXPIRED_STATUS
        ))
            ->setMaxResults($max)
            ->getResult();
        
        return $query;
    }

    public function findSetUpInvoices($userId)
    {
        $max = 50;
        $dql = "SELECT i FROM Transactions\Entity\InvoiceUser i JOIN i.invoice n WHERE i.user = :user AND n.isOpen = :open ORDER BY i.id DESC"; // and category of invoice
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'user' => $userId,
            'open' => true
        ))
            ->setMaxResults($max)
            ->getResult();
        return $query;
    }

    public function findCustomerInvoice($customerid, $brokerId)
    {
        $max = 1000;
        $dql = "SELECT i FROM Transactions\Entity\Invoice i JOIN i.customer r JOIN  r.customerBroker cb WHERE cb.broker = :broker AND i.customer = :cus AND i.isOpen = :open  ORDER BY i.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "cus" => $customerid,
            "broker" => $brokerId,
             "open" => TRUE
        ))
            ->setMaxResults($max)
            ->getResult();
        return $query;
    }

    public function findBrokerExpiringInvoice($broker)
    {
        $dql = "SELECT i FROM Transactions\Entity\Invoice i JOIN i.customer c JOIN c.customerBroker cb JOIN i.invoiceCategory ic WHERE cb.broker = :broker AND i.status = :status AND i.isOpen = :open AND i.expiryDate > CURRENT_DATE() AND  DATE_DIFF(i.expiryDate, CURRENT_DATE()) > -16  ORDER BY i.id DESC ";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'broker' => $broker,
            "open" => TRUE,
            "status" => InvoiceService::INVOICE_UNPAID_STATUS
        ))
            ->getResult();
        return $query;
    }

    public function findBrokerExpiredInvoice($broker)
    {
        $dql = "SELECT i FROM Transactions\Entity\Invoice i JOIN i.customer c JOIN c.customerBroker cb JOIN i.invoiceCategory ic WHERE cb.broker = :broker AND i.status = :status AND i.isOpen = :open  ORDER BY i.id DESC ";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'broker' => $broker,
            "open" => TRUE,
            "status" => InvoiceService::INVOICE_EXPIRED_STATUS
        ))
            ->getResult();
        return $query;
    }

    public function findCustomerExpiringInvoice($customeId)
    {
        $dql = "SELECT i FROM Transactions\Entity\Invoice i JOIN i.customer c JOIN c.customerBroker cb JOIN i.invoiceCategory ic WHERE i.customer = :cus AND i.status = :status AND i.isOpen = :open AND i.expiryDate > CURRENT_DATE() AND  DATE_DIFF(i.expiryDate, CURRENT_DATE()) < 16  ORDER BY i.id DESC ";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'cus' => $customeId,
            "open" => TRUE,
            "status" => InvoiceService::INVOICE_UNPAID_STATUS
        ))
            ->getResult();
        return $query;
    }

    // Begin job
    public function findJobExpiringInvoice()
    {
        $dql = "SELECT i FROM Transactions\Entity\Invoice i WHERE i.status = :status AND i.isOpen = :open AND i.expiryDate > CURRENT_DATE() AND  DATE_DIFF(i.expiryDate, CURRENT_DATE()) = 15"; //TODO check this on mysql doc
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
                "open" => TRUE,
                "status" => InvoiceService::INVOICE_UNPAID_STATUS
            ))
            ->setMaxResults(10000)
            ->getResult();
            return $query;
    }
    
    // End Job
}

