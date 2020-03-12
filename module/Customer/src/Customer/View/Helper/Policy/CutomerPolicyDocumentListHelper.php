<?php
namespace Customer\View\Helper\Policy;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;


/**
 *
 * @author otaba
 *        
 */
class CutomerPolicyDocumentListHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    

    private $serviceLocator;
    
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

    

    public function __invoke($docArray){
        
        return $this->framee($docArray);
    }
    
    
    
    private function framee($info){
        $url = $this->getServiceLocator()->getServicelocator()->get("ViewHelperManager")
        ->get("url");
        $fr = "";
        $blobService = $this->getServiceLocator()->getServiceLocator()->get("GeneralServicer\Service\BlobService");
        
        foreach ($info as $inf){
            $json = json_encode(array(
                "data"=>$inf->getId()
            ));
            $fr .= " <a
					id='sending_data_button' class='btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative ajax_element'
							data-json='".$json."'
							data-href='".$url("board", array("action"=>"displaydoc"))."'
					data-hover-z='0.5' data-animated data-toggle='tooltip'
					data-title='".$inf->getDocName()."'> ". $blobService->showThumbnails($inf->getMimeType(), $inf)."</i>
				</a> ";
        }
        
        return $fr;
    }
}

