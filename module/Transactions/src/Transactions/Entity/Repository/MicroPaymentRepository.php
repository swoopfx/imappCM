<?php
namespace Transactions\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Transactions\Service\TransactionService;

/**
 *
 * @author otaba
 *        
 */
class MicroPaymentRepository extends EntityRepository
{

    // TODO - Insert your code here
    
//     /**
//      *
//      * @param EntityManager $em
//      *            The EntityManager to use.
//      *            
//      * @param Mapping\ClassMetadata $class
//      *            The class descriptor.
//      *            
//      */
//     public function __construct(EntityManagerInterface $em, ClassMetadata $class)
//     {
//         parent::__construct($em, $class);
//        
//     }
    
    /**
     * This gets all Micro Payment that expires in 7, 3 and 1 day(s)
     * @return mixed|\Doctrine\DBAL\Driver\Statement|array|NULL
     */
    public function findExpiringMicroPayment(){
        $dql ="SELECT m FROM Transactions\Entity\MicroPayment m WHERE m.dueDate > CURRENT_DATE() AND (DATE_DIFF(i.expiryDate, CURRENT_DATE()) = 7 OR DATE_DIFF(i.expiryDate, CURRENT_DATE()) = 3 OR DATE_DIFF(i.expiryDate, CURRENT_DATE()) = 1) AND m.status = :status ORDER BY m.id DESC";
        $query = $this->getEntityManager()->createQuery($dql)->setParameters(array(
            "status"=>TransactionService::TRANSACTION_STATUS_PENDING
        ))->getResult();
        return $query;
    }
    
    public function findActivationMicroPayment(){
        $dql = "SELECT m FROM Transactions\Entity\MicroPayment m WHERE DATE_DIFF(m.dueDate, CURRENT_DATE()) = 0 AND m.status = :status";
        $query = $this->getEntityManager()->createQuery($dql)->setParameters(array(
            "status"=>TransactionService::TRANSACTION_STATUS_PENDING
        ))->getResult();
    }
    
    
}

