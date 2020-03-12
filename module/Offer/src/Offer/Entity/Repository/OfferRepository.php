<?php
namespace Offer\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class OfferRepository extends EntityRepository
{

    private $userId;

    /**
     *
     * @param string $userId            
     * @param
     *            boolean string $status
     * @return array
     */
    public function getActiveOffers($userId, $status = FALSE)
    {
        /**
         * use this to create a dql for active offers repo
         */
        // $dql = "SELECT o, c, n, d, s, i FROM \Offer\Entity\Offer o JOIN o.offerCode c " .
        // "JOIN o.createdOn d JOIN o.offerStatus s JOIN o.offerName n WHERE b.user = ?1 ORDER BY o.createdOn DESC
        // ";
        $number = 30;
        
        $dql = "SELECT o FROM Offer\Entity\Offer o  WHERE o.user = :user AND o.isPolicized = :isPolicy ORDER BY o.id ASC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'user' => $userId,
            'isPolicy' => $status
        ))
            ->setMaxResults($number)
            ->getResult();
        
        return $query;
    }

    public function findActiveOffers($brokerId)
    {
        $max = 1000;
        $dql = "SELECT o FROM Offer\Entity\Offer o JOIN o.customer c JOIN c.customerBroker cb WHERE cb.broker = :broker AND o.isHidden = :hide AND o.isPolicized = :pol ORDER BY o.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "broker" => $brokerId,
            "hide" => FALSE,
            "pol" => FALSE
        ))
            ->setMaxResults($max)
            ->getResult();
        return $query;
    }

    public function getOfferForBroker($userId)
    {
        // use this to get all information for the insurance brokers
    }

    public function getOfferForAdmin($userId)
    {}

    public function getStatusId($status)
    {
        $dql = "Select o, e From Status o where o.status =?1 ";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameter(1, $status);
        
        return $query->getResult();
    }

    public function getActiveOffer()
    {
    /**
     * This dql get all offers that has been submitted for processing
     * But has not been fully processed to a policy
     */
    }

    public function findCustomerBrokerOffer($customer, $broker)
    {
        $max = 100;
        $dql = "SELECT o FROM Offer\Entity\Offer o JOIN o.customer c JOIN c.customerBroker cb  WHERE o.customer = :cus AND cb.broker = :broker AND o.isPolicized = :pol ORDER BY o.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'broker' => $broker,
            'cus' => $customer,
            'pol' => false
        ))
            ->setMaxResults($max)
            ->getResult();
        return $query;
    }

    public function findCustomerOffer($customerId, $brokerId)
    {
        $max = 3000;
        $dql = "SELECT o FROM Offer\Entity\Offer o JOIN o.customer r JOIN r.customerBroker cr WHERE cr.broker = :broker AND o.customer = :cus AND o.isPolicized = :pol AND o.isHidden = :is  ORDER BY o.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'cus' => $customerId,
            'broker' => $brokerId,
            'pol' => FALSE,
            "is" => FALSE
        ))
            ->getResult();
           
        return $query;
    }
}