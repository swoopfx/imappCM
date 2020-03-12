<?php
namespace GeneralServicer\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 *
 * @author otaba
 *        
 */
class BrokerChildRepository extends EntityRepository
{

    public function findAssignedChildBrokerCustomer($broker)
    {
        $dql = "SELECT b, c FROM GeneralServicer\Entity\BrokerChild b JOIN b.customerBroker c WHERE c.broker = :broker ORDER BY b.id DESC ";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'broker' => $broker
        ))
            ->
        getResult();
        return $query;
    }

    public function findBRokerChild($brokerId)
    {
        $dql = "SELECT b FROM GeneralServicer\Entity\BrokerChild b   WHERE b.broker = :broker ORDER BY b.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "broker" => $brokerId
        ))
            ->getResult();
        return $query;
    }
}

