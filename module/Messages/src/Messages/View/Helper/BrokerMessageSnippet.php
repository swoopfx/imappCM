<?php
namespace Messages\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use GeneralServicer\Service\GeneralService;
use Doctrine\ORM\EntityManager;

class BrokerMessageSnippet extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    /**
     * This provides a quisck view of the availabile messages on the system
     *
     * @param string $broker
     * @return string
     */
    public function __invoke()
    {
        $html = "";

        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");
        
            
            $dateFormat = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("dateFormat");

        /**
         *
         * @var GeneralService $generalService
         */
        $generalService = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("GeneralServicer\Service\GeneralService");

        /**
         *
         * @var EntityManager $em
         */
        $em = $generalService->getEntityManager();

        if ($generalService->getCentralBroker() != NULL) {
            
            /**
             * 
             * @var unknown $messages
             */
            $messages = $em->getRepository("Messages\Entity\Messages")->findBrokerMessageUnreadSnippet($generalService->getCentralBroker());
            
            $allMessageLink = $url("messages/default", array(
                "action" => "index"
            ));
            if(count($messages) > 0){
                foreach ($messages as $message){
                    $html .= "<li><a> <span class='image'><img src='images/img.jpg'
												alt='Profile Image' /></span> <span> <span></span>
												<span class='time'>{$dateFormat($message->getCreatedOn(), \IntlDateFormatter::MEDIUM, \IntlDateFormatter::NONE, "en_us")}</span>
										</span> <span class='message'> {$message->getMessageText()} </span>
<span class='message'> <strong>{$message->getMessages()->getMessageCategory()->getCategory()} message</strong> </span>
									</a></li>";
                }
            $frame = "
								<ul id='menu1' class='dropdown-menu list-unstyled msg_list'
									role='menu'>
									
									{$html}
								</ul>";

            return $frame;
            }else{
                return NULL;
            }
        }
    }
}

