<?php
namespace Messages\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Messages\Service\MessageService;

/**
 *
 * @author otaba
 *        
 */
class CutomerMessageOfferHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLoator;

    public function __construct()
    {}

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
     *
     */
    public function getServiceLocator()
    {
        return $this->serviceLoator;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     *
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLoator = $serviceLocator;
        return $this;
    }

    public function __invoke($offerEntity)
    {
        $messageService = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("Messages\Service\MessageService");
        
        $generalService = $this->getServicelocator()
            ->getServiceLocator()
            ->get("Customer\Service\ClientGeneralService");
        $em = $generalService->getEntityManager();
        $centralBrokerId = $generalService->getBrokerId();
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $centralBrokerId);
        
        $data = $messageService->getOfferMessages($offerEntity);
        $count = (count($data) < 20 ? count($data) : 20);
        $frame = "";
        // var_dump($data);
        if(count($data) == 0){
            return "No Messages Transmitted";
        }else{
        for ($i = 0; $i < $count; $i ++) {
            
            $frame .= "<div class='item'>
							<div class='testimonial'>
								<div class='panel panel-default'>
									<div class='panel-body'>
										<p>" . $data[$i]->getMessageText() . "</p>
									</div>
								</div>
								<div class='media v-middle'>
									
									<div class='media-body'>
										<p class='text-subhead margin-v-5-0'>
											<strong> " . ($data[$i]->getBrokerFunction()->getId() == MessageService::MESSAGES_FUNCTION_SENDER ? "<p style='color: green;'>Recived From ".$brokerEntity->getBrokerName()."</p>" : "<p style='color: red;'>Sent By ".$offerEntity->getCustomer()->getName()."</p>") . "<span class='text-muted'> " . date_diff(new \DateTime(), $data[$i]->getCreatedOn())->format("%a") . " days ago</span></strong>
										</p>
										
									</div>
								</div>
							</div>
						</div>";
            
            // "<li>
            // <div class='block'>
            // <div class='tags'>
            // <a href='' class='" . ($data[$i]->getBrokerFunction()->getId() == MessageService::MESSAGES_FUNCTION_SENDER ? 'tag' : 'tagr') . "'> <span>" . ($data[$i]->getBrokerFunction()->getId() == MessageService::MESSAGES_FUNCTION_SENDER ? 'Broker' : 'Customer') . "</span>
            // </a>
            // </div>
            // <div class='block_content'>
            
            // <div class='byline'>
            // <span>" . date_diff(new \DateTime(), $data[$i]->getCreatedOn())->format("%a") . "</span> by <a>" . ($data[$i]->getBrokerFunction()->getId() == MessageService::MESSAGES_FUNCTION_SENDER ? $brokerEntity->getBrokerName() : $offerEntity->getCustomer()->getName()) . "</a>
            // </div>
            // <p class='excerpt'>
            // " . $data[$i]->getMessageText() . "
            // </p>
            // </div>
            // </div>
            // </li>";
            // return $frame;
        }}
        return $frame;
    }
}

