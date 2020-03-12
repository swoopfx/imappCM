<?php
namespace Comments\Service;

use CsnUser\Service\UserService;

/**
 *
 * @author swoopfx
 *        
 */
class CommentService
{

    const COMMENT_CATEGORY_PORTAL = 10;

    const COMMENT_CATEGORY_CLAIMS = 20;

    const COMMENT_CATEGORY_PROPOSAL = 30;

    const COMMENT_CATEGORY_OFFER = 40;

    const COMMENT_CATEGORY_PACKAGES = 50;

    const COMMENT_CATEGORY_FLOAT_POLICY = 60;

    const COMMENT_CATEGORY_MESSAGES = 70;

    const COMMENT_CATEGORY_COVERNOTE = 80;

    const COMMENT_CATEGORY_OTHERS = 1000;

    private $generalService;

    private $entityManager;

    public function __construct()
    {}

    public static function commentUid()
    {
        $const = "comment";
        // $id = $this->userId;
        $code = \uniqid($const);
        return $code;
    }

    public static function commentorName($userEntity)
    {
        // $em = $this->entityManager;
        $role = $userEntity->getRole()->getId();
        switch ($role) {
            case UserService::USER_ROLE_CUSTOMER:
                // $customerEntity = $em->getRepository("Customer\Entity\Customer")->findOneBy(array(
                // "user"=>$userEntity->getId()
                // ));
                // return $customerEntity->getName();

                return "CUSTOMER";
                break;

            case UserService::USER_ROLE_BROKER:
            case UserService::USER_ROLE_BROKER_CHILD:
                return "BROKER";
                break;
        }
    }

    public function setGeneralService($xserv)
    {
        $this->generalService = $xserv;
        return $this;
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

