<?php
namespace Proposal\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 *
 * @author swoopfx
 *        
 */
class ProposalRepository extends EntityRepository
{

    public function findBrokerActiveProposal($broker, $status = TRUE)
    {
        $max = 30000;
        $dql = "SELECT p FROM Proposal\Entity\Proposal p JOIN  p.proposalBroker b  WHERE b.broker = :broker AND p.isActive = :active  ORDER BY b.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'broker' => $broker,
            'active' => $status
        ))
            ->setMaxResults($max)
            ->getResult();
        return $query;
    }

    public function findAllBrokerProposal($broker, $status = TRUE)
    {
        $max = 30000;
        $dql = "SELECT p FROM Proposal\Entity\Proposal p JOIN p.customer r JOIN r.customerBroker e WHERE e.broker = :broker AND p.isActive = :active AND p.isHidden = :hidden   ORDER BY p.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'broker' => $broker,
            'active' => $status,
            "hidden" => FALSE
        ))
            ->setMaxResults($max)
            ->getResult();
        return $query;
    }

    public function findChildBrokerProposal($broker, $status = TRUE)
    {
        $dql = "SELECT p FROM  Proposal\Entity\Proposal p  JOIN p.customer c JOIN c.assignedChildBroker acb WHERE acb.broker = :broker AND p.isActive = :active AND p.isHidden = :hidden   ORDER BY p.id DESC ";
        
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'broker' => $broker,
            'active' => $status,
            "hidden" => FALSE
        ))
            ->getResult();
        return $query;
    }

    public function findCustomerBrokerProposal($customer, $broker)
    {
        $max = 10000;
        $dql = "SELECT p FROM Proposal\Entity\Proposal p  JOIN p.customer c JOIN c.customerBroker cb WHERE p.customer = :cus AND cb.broker = :broker AND p.isActive = :act AND p.isVisible = :vis  ORDER BY p.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'cus' => $customer,
            'broker' => $broker,
            'act' => TRUE,
            "vis" => TRUE,
//             "pol" => FALSE
        
        ))
            ->setMaxResults($max)
            ->getResult();
        return $query;
    }
}

