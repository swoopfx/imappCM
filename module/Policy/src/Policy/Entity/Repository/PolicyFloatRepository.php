<?php
namespace Policy\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class PolicyFloatRepository extends EntityRepository
{

    public function findCustomerUnpublishedPolicy($customerId, $brokerId)
    {
        $dql = "SELECT f FROM Policy\Entity\PolicyFloat f JOIN f.coverNote c JOIN c.customer r JOIN r.customerBroker cb  JOIN c.policy p WHERE c.customer = :cus  AND  cb.broker = :broker AND p.isActive = :pub ORDER BY f.id DESC";

        // $query = $this->getEntityManager()
        // ->createQuery($dql)
        // ->setParameters(array(
        // "cus" => $customerId,
        // "broker" => $brokerId
        // ))->setMaxResults(100)
        // ->getResult();

        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "cus" => $customerId,
            "broker" => $brokerId,
            "pub" => false
        ))
            ->
        getResult();

        return $query;
    }

    public function findCentralBrokerUnpublishedPolicy($brokerId)
    {
        $dql = "SELECT f FROM Policy\Entity\PolicyFloat f JOIN f.coverNote c JOIN c.customer r JOIN r.customerBroker cb JOIN c.policy p WHERE cb.broker = :broker AND p.isActive = :pub ORDER BY f.id DESC";

        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "broker" => $brokerId,
            "pub" => False
        ))
            ->getResult();
        return $query;
    }
}

