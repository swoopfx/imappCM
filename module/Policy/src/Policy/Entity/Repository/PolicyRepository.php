<?php
namespace Policy\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Policy\Service\PolicyService;
use Policy\Service\CoverNoteService;

/**
 *
 * @author swoopfx
 *        
 */
class PolicyRepository extends EntityRepository
{

    public function getIncompletePolicy($userId, $status = TRUE)
    {
        // get an policy tageed incoplete
        $number = 30;

        $dql = "SELECT p FROM \Policy\Entity\Policy p  WHERE (p.user = :user AND p.isIncomplete = :is) ORDER BY p.id ASC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'user' => $userId,
            'is' => $status
        ))
            ->setMaxResults($number)
            ->getResult();

        return $query;
    }

    /**
     * This finds policy for a certain customer
     */
    public function findBrokerCustomerPolicy($customerId)
    {
        $max = 5000;
        $dql = "SELECT  p, c FROM Policy\Entity\Policy p  JOIN p.coverNote c WHERE c.customer = :customer AND c.isPolicy = :isPolicy AND p.policyStatus = :status AND p.isActive = :active ORDER BY p.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "customer" => $customerId,
            "isPolicy" => TRUE,
            "status" => PolicyService::POLICY_STATUS_ISSUED_AND_VALID,
            "active" => TRUE
        ))
            ->setMaxResults($max)
            ->getResult();
        return $query;
    }

    public function findBrokerPolicy($brokerId)
    {
        $max = 5000;
        $dql = "SELECT cv, c FROM Policy\Entity\CoverNote cv  JOIN cv.customer c JOIN c.customerBroker cb WHERE cb.broker = :broker AND cv.isHidden = :hidden AND cv.isPolicy = :policy ORDER BY cv.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'broker' => $brokerId,
            'hidden' => False,
            "policy" => TRUE
        ))
            ->getResult();
        return $query;
    }

    public function findBrokerExpiringPolicy($brokerId)
    {}

    public function findBrokerExpiredPolicy($brokerId)
    {
        $dql = "SELECT p FROM Policy\Entity\Policy p JOIN p.coverNote cv JOIN cv.customer c JOIN c.customerBroker cb WHERE cb.broker = :broker AND   p.policyStatus = :stat ORDER BY p.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "broker" => $brokerId,
//             "status" => PolicyService::POLICY_STATUS_SUSPENDED,
            "stat" => PolicyService::POLICY_STATUS_EXPIRED
        ))
            ->setMaxResults("400")
            ->getResult();
        return $query;
    }

    public function findBrokerCoverNote($brokerId)
    {
        $max = 5000;
        $dql = "SELECT cv, c FROM Policy\Entity\CoverNote cv  JOIN cv.customer c JOIN c.customerBroker cb WHERE cb.broker = :broker AND cv.isHidden = :hidden AND cv.isPolicy = :policy ORDER BY cv.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'broker' => $brokerId,
            'hidden' => FALSE,
            "policy" => FALSE
        ))
            ->setMaxResults($max)
            ->getResult();
        return $query;
    }

    public function findExpiringPolicy($brokerId)
    {
        $max = 1000;
        $dql = "SELECT p FROM Policy\Entity\Policy p JOIN p.coverNote c JOIN c.customer r JOIN r.customerBroker cb WHERE cb.broker = :broker AND p.policyStatus = :status AND p.endDate < CURRENT_DATE() AND  DATE_DIFF(p.endDate, CURRENT_DATE()) < 30  ORDER BY p.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "broker" => $brokerId,
            "status" => PolicyService::POLICY_STATUS_ISSUED_AND_VALID
        ))
            ->setMaxResults($max)
            ->getResult();
        return $query;
    }

    public function findCustomerCoverNote($customer)
    {
        $max = 1000;
        $dql = "SELECT c FROM Policy\Entity\CoverNote c WHERE c.customer = :cus AND c.isPolicy = :policy AND c.isHidden = :hide ORDER BY c.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "cus" => $customer,
            "policy" => FALSE,
            "hide" => FALSE
        ))
            ->setMaxResults($max)
            ->getResult();
        return $query;
    }

    public function findCustomerPolicy($customer)
    {
        $max = 30000;
        // $dql = "SELECT p FROM Policy\Entity\Policy p JOIN p.customer r JOIN r.customerBroker cb WHERE p.customer = :cus AND cb.broker = :broker ORDER BY p.id DESC";
        // $dql = "SELECT p FROM \Policy\Entity\Policy p JOIN p.customer r JOIN r.customerBroker cb WHERE cb.broker = :broker AND p.customer = :cus";
        $dql = "SELECT p FROM \Policy\Entity\Policy p JOIN p.coverNote cv WHERE cv.customer = :cus ORDER BY p.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'cus' => $customer
        ))
            ->setMaxResults($max)
            ->getResult();
        return $query;
    }

    public function findCustomerActivePolicy($customer)
    {
        $dql = "SELECT p FROM Policy\Entity\Policy p JOIN p.coverNote cv  WHERE cv.customer = :cus AND p.isActive = :active AND p.policyStatus = :status  ORDER BY p.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "cus" => $customer,
            "active" => TRUE,
            "status" => PolicyService::POLICY_STATUS_ISSUED_AND_VALID
        ))
            ->getResult();

        return $query;
    }

    public function findCustomerTerminatedPolicy($customer)
    {
        $dql = "SELECT p FROM Policy\Entity\Policy p JOIN p.coverNote cv WHERE cv.customer = :cus AND p.policyStatus = :status ORDER BY p.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "cus" => $customer,
            "status" => PolicyService::POLICY_STATUS_SUSPENDED
        ))
            ->getResult();
        return $query;
    }

    public function findCustomerExpiredPolicy($customer)
    {
        $dql = "SELECT p FROM Policy\Entity\Policy p JOIN p.coverNote cv WHERE cv.customer = :cus AND p.policyStatus = :status ORDER BY p.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "cus" => $customer,
            "status" => PolicyService::POLICY_STATUS_INACTIVE
        ))
            ->getResult();
        return $query;
    }

    public function findCustomerUpcomingRenewablePolicy($customer)
    {
        $dql = "SELECT p FROM Policy\Entity\Policy p JOIN p.coverNote cv WHERE cv.customer = :cus AND p.policyStatus = :status AND p.endDate > CURRENT_DATE() AND  DATE_DIFF(p.endDate, CURRENT_DATE()) < 30 ORDER BY p.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "cus" => $customer,
            "status" => PolicyService::POLICY_STATUS_ISSUED_AND_VALID
        ))
            ->getResult();
        // var_dump(count($query));
        return $query;
    }

    // Begin job
    /**
     * This get data for the covernote job that is about to expire
     *
     * @return mixed|\Doctrine\DBAL\Driver\Statement|array|NULL
     */
    public function findJobExpiredCoverNote()
    {
        $dql = "SELECT * FROM Policy\Entity\CoverNote c WHERE  DATE_DIFF(c.dueDate, CURRENT_DATE()) = 0 and c.policy = :pol ORDER BY c.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "pol" => NULL
        ))
            ->setMaxResults(10000)
            ->getResult();
        return $query;
    }

    /**
     * This function finds all cover note expriing within 15, 7 and 3 days
     *
     * @return mixed|\Doctrine\DBAL\Driver\Statement|array|NULL
     */
    public function findExpiringCoverNote()
    {
        $dql = "SELECT * FROM Policy\Entity\CoverNote c WHERE c.coverStatus = :status AND  (DATE_DIFF(c.dueDate, CURRENT_DATE()) = 15 OR DATE_DIFF(c.dueDate, CURRENT_DATE()) = 7 OR DATE_DIFF(c.dueDate, CURRENT_DATE()) = 3) AND c.dueDate  > CURRENT_DATE()";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "status" => CoverNoteService::COVERNOTE_STATUS_POLICY_ISSUED_AND_VALID
        ))
            ->getResult();

        return $query;
    }

    /**
     * This functon gets data of policy expiring in 60, 30 and 14 days
     *
     * @return mixed|\Doctrine\DBAL\Driver\Statement|array|NULL
     */
    public function findRenewablePolicy()
    {
        $dql = "SELECT p FROM Policy\Entity\Policy p WHERE p.policyStatus = :status AND ((DATE_DIFF(p.endDate, CURRENT_DATE()) = 60 OR DATE_DIFF(p.endDate, CURRENT_DATE()) = 30 ) OR DATE_DIFF(p.endDate, CURRENT_DATE()) = 14 )) AND p.endDate  > CURRENT_DATE()";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "status" => PolicyService::POLICY_STATUS_ISSUED_AND_VALID
        ))
            ->getResult();
        return $query;
    }

    /**
     * This gets expiring policy on the D date
     *
     * @return mixed|\Doctrine\DBAL\Driver\Statement|array|NULL
     */
    public function findZeroDayExpirePolicy()
    {
        $dql = "SELECT p FROM FROM Policy\Entity\Policy p WHERE p.policyStatus = :status AND (DATE_DIFF(p.endDate, CURRENT_DATE()) = 0";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "status" => PolicyService::POLICY_STATUS_ISSUED_AND_VALID
        ))
            ->getResult();
        return $query;
    }
    // End Job
}

