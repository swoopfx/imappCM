<?php
namespace Claims\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 *
 * @author swoopfx
 *        
 */
class ClaimsRepository extends EntityRepository
{

    public function findBrokerCustomerSpecificUnsettledClaims($brokerId, $customerId)
    {
//         $dql = "SELECT c FROM Claims\Entity\CLaims c JOIN c.policy p JOIN p.coverNote cv JOIN cv.customer r JOIN r.customerBroker cb  WHERE cb.broker = :broker AND c.isSettled = :sett AND c.isHidden = :hide ORDER BY c.id DESC";
    }

    public function findUnsettledClaims($broker)
    {
        // var_dump("hhhhhhh");
        $max = 50;
        // var_dump("huyyy");
        $dql = "SELECT c FROM Claims\Entity\CLaims c JOIN c.policy p JOIN p.coverNote cv JOIN cv.customer r JOIN r.customerBroker cb  WHERE cb.broker = :broker  AND c.isHidden = :hide ORDER BY c.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'broker' => $broker,
//             'sett' => false,
            "hide" => FALSE
        ))
            ->setMaxResults($max)
            ->getResult();
        // var_dump($query);
        return $query;
    }

    public function findCustomerUnsettledClaims($customerId)
    {
//         try {
            $dql = "SELECT c FROM Claims\Entity\CLaims c JOIN c.policy p JOIN p.coverNote cv WHERE  cv.customer = :cus   AND c.isHidden = :hide ORDER BY c.id DESC";
            $query = $this->getEntityManager()
                ->createQuery($dql)
                ->setParameters(array(
                'cus' => $customerId,
                'hide' => false,
//                 "sett"=>"NULL"
            ))
                ->getResult();
            return $query;
//         } catch (\Exception $e) {
//             var_dump($e->getMessage());
//         }
    }
}

