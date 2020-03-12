<?php
namespace Policy\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;


/**
 *
 * @author otaba
 *        
 */
class PolicyDocumentListHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{
    
    private $serviceLocator;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
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

   
    
    public function __invoke($policyEntity){
        $docs = $policyEntity->getDocuments();
        return $this->frames($docs);
    }
    
    private function frames($docs)
    {
        $url = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("ViewHelperManager")
        ->get("url");
        $fra = "";
        if (count($docs) == 0) {
            return "No document uploaded yet";
        } else {
            foreach ($docs as $doc) {
                $jsonData = json_encode(array(
                    "data"=>$doc->getId()
                ));
                $fra .= "

                          <li>
                            <p>
                              <span class='month'><a href='" . $doc->getDocUrl() . "' target='_blank'>" . $doc->getDocName() . "</a></span> <a id='sending_data_button' data-json='".$jsonData."' class='ajax_element' data-href='" . $url("policy/default", array(
                                  "action" => "removedocconfirm",
                                 
                              )) . "'><span class='count fa fa-close fa-danger'></span></a></p>
                          </li>";
            }
        }
        return "<ul class='to_do list-inline widget_tally'>" . $fra . "</ul>";
    }
}

