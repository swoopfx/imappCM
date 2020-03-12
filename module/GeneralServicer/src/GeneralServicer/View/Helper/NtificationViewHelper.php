<?php
namespace GeneralServicer\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 *
 * @author otaba
 *        
 */
class NtificationViewHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

    /**
     */
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

    public function __invoke($brokerId)
    {
       
        $generalService = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("GeneralServicer\Service\GeneralService");
       
//             $url = $this->getServiceLocator()
//             ->getServiceLocator()
//             ->get("ViewHelperManager")
//             ->get("url");
            
        $em = $generalService->getEntityManager();
       
       
                $data = $em->getRepository("GeneralServicer\Entity\Notifications")->findBrokerNotificationSnippet($brokerId);
       
        $data = NULL;
        if ($data == NULL) {
            return "<p style='color: red;'>No notification available</p>";
        } else {
            $frame = "";
            //var_dump($data[0]->getNotificationUrl());
            $count = (count($data) > 5 ? 5 : count($data));
            for($i = 0 ; $i < $count; $i++){
                $frame .= "<li>
                            <p><a style='width: 100%;' href='".$data[$i]->getNotificationUrl()."' class='btn btn-danger btn-xs'>".$data[$i]->getTopic()." </a> </p>
                          </li>";
               
            }
            return $frame;
            
        }
    }
}

