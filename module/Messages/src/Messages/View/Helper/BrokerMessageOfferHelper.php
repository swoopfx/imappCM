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
class BrokerMessageOfferHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

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

    public function __invoke($offerEntity)
    {
        $messageService = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("Messages\Service\MessageService");
        
        $generalService = $this->getServicelocator()
            ->getServiceLocator()
            ->get("GeneralServicer\Service\GeneralService");
        $em = $generalService->getEntityManager();
        $centralBrokerId = $generalService->getCentralBroker();
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $centralBrokerId);
        
        // $messageForm = $this->getServiceLocator()
        // ->getServiceLocator()
        // ->get("FormElementManager")
        // ->get("Messages\Form\MessageForm");
        
        $data = $messageService->getOfferMessages($offerEntity);
        
        //$data = $offerEntity->getMessages()->getMessageEntered();
        //var_dump(count($data));
        $count = (count($data) < 20 ? count($data) : 20);
        $frame = "";
        // var_dump($data);
        for ($i = 0; $i < $count; $i++) {
            
            $frame .= "<li>
					<div class='block'>
						<div class='tags'>
							<a href='' class='" . ($data[$i]->getBrokerFunction()->getId() == MessageService::MESSAGES_FUNCTION_SENDER ? 'tag' : 'tagr') . "'> <span>" . ($data[$i]->getBrokerFunction()->getId() == MessageService::MESSAGES_FUNCTION_SENDER ? 'Broker' : 'Customer') . "</span>
							</a>
						</div>
						<div class='block_content'>

							<div class='byline'>
								<span>" . date_diff(new \DateTime(), $data[$i]->getCreatedOn())->format("%a") . " days ago</span> by <a>" . ($data[$i]->getBrokerFunction()->getId() == MessageService::MESSAGES_FUNCTION_SENDER ? $brokerEntity->getBrokerName() : $offerEntity->getCustomer()->getName()) . "</a>
							</div>
							<p class='excerpt'>
								" . $data[$i]->getMessageText() . "
							</p>
						</div>
					</div>
				</li>";
           // return $frame;
        }
        return $frame;
    }
}

