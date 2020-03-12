<?php
namespace Object\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class ObjectRepository extends EntityRepository
{

    public function getAllObjectForUser($userId, $status = false)
    {
        
        /**
         * Use this function to select the count of all object in the database
         */
        $query = "Select o.id From \Object\Entity\Object o  WHERE o.user = ?1 ";
        return $this->getEntityManager()
            ->createQuery($query)
            ->setParameter(1, $userId)
            ->getResult();
    }

    public function findCustomerBrokerObject($criteria)
    {
        $max = 100;
        $dql = "SELECT o FROM Object\Entity\Object o JOIN o.customer c JOIN c.customerBroker cb  WHERE cb.broker = :broker AND o.customer = :cus AND o.isHidden = :hide ORDER BY o.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "broker" => $criteria['broker'],
            'cus' => $criteria['customer'],
            'hide' => $criteria['hidden']
        ))
            ->setMaxResults($max)
            ->getResult();
        
        return $query;
    }

    /**
     * This gets all objects associated to a certain broker
     *
     * @param unknown $broker            
     */
    public function findObjects($broker)
    {
        $max = 3000;
        $dql = "SELECT o  FROM Object\Entity\Object o JOIN o.customer c JOIN c.customerBroker cb WHERE cb.broker = :broker AND o.isHidden = :hidden ORDER BY o.id DESC ";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setMaxResults($max)
            ->setParameters(array(
            "broker" => $broker,
            "hidden" => FALSE
        ))
            ->getResult();
        
        return $query;
    }

    public function findCustomerObject($customer)
    {
        $max = 1000;
        $dql = "SELECT o FROM Object\Entity\Object o WHERE o.customer = :cus AND o.isHidden = :hidden  ORDER BY o.id DESC ";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "cus" => $customer,
            "hidden" => FALSE
        ))
            ->setMaxResults($max)
            ->getResult();
        return $query;
    }
    
    // public function findBrokerAllObject($broker){
    // $max = 5000;
    // $dql = "SELECT o, c FROM Object\Entity\Object o JOIN o.customer c JOIN c.customerBroker b WHERE b.broker = :broker AND o.isHidden = :phidden ";
    // return $query ;
    // }
}