<?php
namespace Messages\Service;

/**
 *
 * @author otaba
 *        
 */
class MessageService
{

    const MESSAGES_FUNCTION_SENDER = 1;

    const MESSAGE_FUNCTION_RECEIVER = 2;

    const MESSAGE_STATUS_READ = 1;

    const MESSAGE_STATUS_UNREAD = 2;

    private $entityManager;

    public function __construct()
    {}
    
    public function getBrokerMessageSnippet(){
//         $
    }

    public function getOfferMessages($offerEntity)
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Messages\Entity\Messages")->findOfferMessages($offerEntity);
        // var_dump(count($data[0]->getMessageEntered()));
        if ($data == NULL) {
            return NULL;
        } else {
            return $data[0]->getMessageEntered();
        }
    }

    public function getProposalMessages($proposalEntity)
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Messages\Entity\Messages")->findProposalMessages($proposalEntity);
        if ($data == NULL) {
            return NULL;
        } else {
            return $data[0]->getMessageEntered();
        }
    }

    public function getPackagesMessages($customerPackageEntity)
    {
        $em = $this->entityManager;
        $data = $em->getRepository("Messages\Entity\Messages")->findCustomerPackageMessages($customerPackageEntity);
        if ($data == NULL) {
            return NULL;
        } else {
            return $data[0]->getMessageEntered();
        }
    }
    
    public function getBrokerOfferUnreadMessage(){
        $em = $this->entityManager;
        $data = $em->getRepository("Messages\Entity\Messages")->findOfferMessages($offerEntity);
        // var_dump(count($data[0]->getMessageEntered()));
        if ($data == NULL) {
            return NULL;
        } else {
            return $data[0]->getMessageEntered();
        }
    }

    public function messageUid()
    {
        $const = "messg";
        $code = \uniqid($const);
        return $code;
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

