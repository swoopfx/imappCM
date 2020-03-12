<?php
namespace Packages\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class PackageRepository extends EntityRepository
{

    public function findFeaturedPackages($brokerId)
    {
        $max = 8;
        $dql = "SELECT f, p FROM Packages\Entity\FeaturedPackages f JOIN f.packages WHERE f.broker = :broker ORDER BY f.id ASC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'broker' => $brokerId
        
        ))
            ->setMaxResults($max)
            ->getResult();
        return $query;
    }

    public function findBrokerPackages($broker)
    {
        $max = 300;
        $dql = "SELECT p, pi FROM Packages\Entity\Packages p  JOIN p.packagedInsurer pi WHERE p.broker = :broker AND p.isActive = :isactive AND p.isHidden = :hidden ORDER BY p.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "broker" => $broker,
            'isactive' => TRUE,
            "hidden" => False
        ))
            ->setMaxResults($max)
            ->getResult();
        return $query;
    }

    public function findAllCustomerAcquiredPackages($broker)
    {
        $max = 200;
        $dql = "SELECT cp, c, p FROM Customer\Entity\CustomerPackage cp JOIN cp.customer c JOIN cp.packages p JOIN c.customerBroker cb WHERE cb.broker = :broker AND cp.isActive = :active ORDER BY cp.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "broker" => $broker,
            "active" => TRUE
        ))
            ->setMaxResults($max)
            ->getResult();
        
        return $query;
    }
}