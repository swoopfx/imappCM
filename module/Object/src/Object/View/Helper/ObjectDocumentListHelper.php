<?php
namespace Object\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * This class creates gets a list off all documents uploaded 
 * relative to this object Entity
 * @author otaba
 *        
 */
class ObjectDocumentListHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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
    
    private function frame($info){
        $frame = "<div class=''>
                        <ul class='to_do list-inline widget_tally'>
                         
                            ".$info."
                          
						   </ul>
                      </div>";
        return $frame;
    }

    public function __invoke($objectEntity)
    {
        $url = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("ViewHelperManager")
        ->get("url");
        $objectDocuments = $objectEntity->getDocument();
        $info = "";
        if(count($objectDocuments) != 0){
            foreach ($objectDocuments as $doc){
                $info .=  " <li><span class='month'><a href='" . $doc->getDocUrl() . "' target='_blank'>" . $doc->getDocName() . "</a></span> <a href='" . $url("object/default", array(
                    "action" => "removedoc",
                    "inf" => $doc->getId()
                )) . "'><span class='count fa fa-close fa-danger'></span></a></li>";
                
            }
            return $this->frame($info);
        }else{
            $info =  "<p style='color: red;'><i class='fa fa-warning (alias)'></i> No Doc</p>";
            return $this->frame($info);
            /**
             * Show all documents as a list
             */
        }
    }
}

