<?php
namespace Wallet\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Wallet\Service\WalletService;

class WalletRepository extends EntityRepository
{

    public function findLastWithdrawal($userId)
    {
        $dql = "SELECT wt FROM Wallet\Entity\WalletTransaction wt JOIN wt.wallet w WHERE w.user = :user AND wt.transactionType = :type  ORDER BY wt.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "user" => $userId,
            "type" => WalletService::WALLET_TRANSACTION_TYPE_WITHDRAW
        ))
            ->getResult();
       
        return $query;
    }

    public function findLast20Transaction($userId)
    {
        $dql = "SELECT wt FROM Wallet\Entity\WalletTransaction wt JOIN wt.wallet w WHERE w.user = :user ORDER BY wt.id DESC";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            "user" => $userId
        ))
            ->setMaxResults(50)
            ->getResult();
        return $query;
    }
}

