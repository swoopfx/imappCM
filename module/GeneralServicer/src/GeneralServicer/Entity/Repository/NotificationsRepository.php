<?php
namespace GeneralServicer\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class NotificationsRepository extends EntityRepository
{

    public function findBrokerNotificationSnippet($broker)
    {
        $dql = "SELECT n FROM GeneralServicer\Entity\Notifications n WHERE n.isAction = :action AND n.recipientBroker = :broker AND n.isRead = :read";

        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setMaxResults(20)
            ->setParameters(array(
                "read"=>FALSE,
                "action"=>TRUE,
                "broker"=>$broker
            ))
            ->getResult();
        return $query;
    }
}

