<?php
namespace Proposal\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;


/**
 *
 * @author swoopfx
 *        
 */
class ProposalCustomerNotificationHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{
    
    private $serviceLocator;

    public function __invoke($id){
        $info= NULL;
        $generalService = $this->getServiceLocator()->getServiceLocator()->get();
        $em = $generalService->getEntityManager('GeneralServicer\Service\GeneralService');
        $critera = array(
            'proposal'=>$id
        );
        $order = array(
            'id'=>'DESC'
        );
        $data = $em->getRepository("Proposal\Entity\CustomerProposalNotification")->findBy($critera, $order, 10);
        if (count($data) == 0){
            $inf= "";// remind the broker to send a reminder
        }else{
            //list all Notification 
            // include Reminder Button
        }
        
        return $info;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
     *
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     *
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

   
}

