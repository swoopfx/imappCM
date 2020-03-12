<?php
namespace Messages\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Messages\Service\MessageService;

/**
 *
 * @author otaba
 *        
 */
class MessageRepository extends EntityRepository
{

    public function findOfferMessages($offerEntity)
    {
        $dql = "SELECT m, e FROM Messages\Entity\Messages m JOIN m.messageEntered e WHERE m.offer = :offer ORDER BY e.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "offer" => $offerEntity->getId()
        ))
            ->getResult();
        return $query;
    }

    public function findOfferUnreadMessages($messageEntity)
    {
        $dql = "SELECT m FROM Messages\Entity\MessageEntered m WHERE m.messages = :mess AND m.messageStatus = :status AND m.brokerFunction = :broker ORDER BY m.id DESC";
        // $query = $this->getEntityManager()
        // ->createQuery($dql)
        // ->setParameters(array(
        // "mess" => $messageEntity->getId(),
        // "status"=>MessageService::MESSAGE_STATUS_UNREAD,
        // "broker"=>MessageService::MESSAGE_FUNCTION_RECEIVER
        // ))
        // ->getResult();

        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "mess" => $messageEntity,
            "status" => MessageService::MESSAGE_STATUS_UNREAD,
            "broker" => MessageService::MESSAGE_FUNCTION_RECEIVER
        ))
            ->getResult();

        return $query;
    }

    public function findProposalMessages($proposalEntity)
    {
        $dql = "SELECT m, e FROM Messages\Entity\Messages m JOIN m.messageEntered e WHERE m.proposals = :prop ORDER BY e.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "prop" => $proposalEntity->getId()
        ))
            ->getResult();
        return $query;
    }

    public function findCustomerPackageMessages($packageEntity)
    {
        $dql = "SELECT m, e FROM Messages\Entity\Messages m JOIN m.messageEntered e WHERE m.packages = :pack ORDER BY e.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "pack" => $packageEntity->getId()
        ))
            ->getResult();
        return $query;
    }

    public function findBrokerMessageUnreadSnippet($broker)
    {
        $dql = "SELECT me FROM Messages\Entity\MessageEntered me JOIN me.messages m WHERE m.broker = :broker AND me.isRead = :read ORDER BY me.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
                "read"=>FALSE,
                "broker"=>$broker
            ))
            ->setMaxResults(5)
            ->getResult();
            
            return $query;
    }
}

