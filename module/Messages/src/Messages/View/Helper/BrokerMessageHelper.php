<?php
namespace Messages\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 *
 * @author otaba
 *        
 */
class BrokerMessageHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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
        
//         $messageForm = $this->getServiceLocator()
//             ->getServiceLocator()
//             ->get("FormElementManager")
//             ->get("Messages\Form\MessageForm");
 
        $data = $messageService->getOfferMessages($offerEntity);
        for($i = 0 ; $i < 20; $i++){
          
        }
        
        
    }
}

