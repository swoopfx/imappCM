<?php
namespace Customer\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 *
 * @author swoopfx
 *        
 */
class CustomerRepository extends EntityRepository
{

    public function findBrokerCustomers($broker)
    {
        $max = 10000;
        $dql = "SELECT c FROM Customer\Entity\Customer c JOIN c.customerBroker b WHERE b.broker = :broker AND c.isHidden = :hidden ORDER BY c.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'broker' => $broker,
            "hidden" => FALSE
        ))
            ->setMaxResults($max)
            ->getResult();
        return $query;
    }

    public function findAllChildBrokerCustomer($broker)
    {
        $max = 10000;
        $dql = "SELECT c FROM Customer\Entity\Customer c JOIN c.customerBroker b JOIN b.assignedChildBroker a WHERE a.brokerChild = :broker ORDER BY c.id DESC";
        $dql = "SELECT b FROM Customer\Entity\Customer b JOIN b.assignedChildBroker acb WHERE acb.broker = :broker ORDER BY b.id DESC ";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'broker' => $broker
        ))
            ->setMaxResults($max)
            ->getResult();
        return $query;
    }

    public function findAllAssignedChildBroker($customer, $broker)
    {
        $dql = "SELECT a FROM GeneralServicer\Entity\BrokerChild a  WHERE a.assignedCustomer = :customer AND a.broker = :broker ORDER BY a.id DESC ";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'customer' => $customer,
            'broker' => $broker
        ))
            ->getResult();
        return $query;
    }

    // public function findAllAssignedChildBroker(){
    // $dql = "SELECT a FROM Customer\Entity\CustomerAssignedBrokerChild a JOIN a.customerBroker b WHERE b.customer = :customer";
    // }
    public function getCustomerAssignedBroker($customerId, $brokerId)
    {
        $dql = "SELECT  c, ca  FROM Customer\Entity\Customer c JOIN c.customerBroker  cb JOIN c.assignedChildBroker ca WHERE cb.broker = :broker AND c.id = :customerId ORDER BY c.id DESC ";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'customerId' => $customerId,
            'broker' => $brokerId
        ))
            ->getResult();
            return $query;
    }

    public function findCustomerActivePackages($customerId, $brokerId)
    {
        $max = 300;
        $dql = "SELECT cp, k FROM Customer\Entity\CustomerPackage cp JOIN cp.packages k JOIN cp.customer r JOIN r.customerBroker cb WHERE cb.broker = :broker AND cp.customer = :cus AND cp.isActive = :act ORDER BY cp.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "cus" => $customerId,
            "broker" => $brokerId,
            "act" => TRUE
        ))
            ->setMaxResults($max)
            ->getResult();
        // var_dump($query);
        return $query;
    }
    
    public function findAllAssignedBroker($customerId){
        
    }
}

