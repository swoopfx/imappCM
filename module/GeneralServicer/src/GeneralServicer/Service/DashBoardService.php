<?php
namespace GeneralServicer\Service;

/**
 *
 * @author swoopfx
 *        
 */
class DashBoardService
{

    protected $entityManager;

    protected $auth;

    protected $identity;

    protected $qb;

    protected $userId;

    public function __construct()
    {}

    public function getActiveOffer()
    {
        return $this->activeOfferDQL();
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setAuth($auth)
    {
        $this->auth = $auth;
        return $this;
    }

    /**
     * These return [the object to the database parameters
     */
    private function activeOfferDQL()
    {
        $result = $this->entityManager->getRepository('Offer\Entity\Offer')->findAll(array()

        );
        // $qb = $this->qb;
        // $result = $qb->select('a')
        // ->from('Offer\Entity\Offer', 'a')
        // ->where('a.user =?1 AND a.isPolicized = ?2')
        // ->orderBy('a.id', 'ASC')
        // ->setParameters(array(
        // 1 => $this->userId,
        // 2 => FALSE
        // ));
        $result = $this->entityManager->getRepository('Offer\Entity\Offer')->findBy(array(
            'user' => 20
        ), // $where
array(
            'offerName' => 'ASC'
        ), // $orderBy
10, // $limit
0) // $offset
;
        
        return $result;
    }

    private function overDueInvoiceDql()
    {}

    private function endingPoliciesDql()
    {}

    private function IncompletePolicy()
    {}
}

