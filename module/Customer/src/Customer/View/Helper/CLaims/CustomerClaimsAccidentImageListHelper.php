<?php
namespace Customer\View\Helper\CLaims;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use GeneralServicer\Service\BlobService;


/**
 *
 * @author otaba
 *        
 */
class CustomerClaimsAccidentImageListHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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

   
    
    public function __invoke($claimsId){
        
        $generalService = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("Customer\Service\ClientGeneralService");
        
        $em = $generalService->getEntityManager();
        $claimsEntity = $em->find("Claims\Entity\CLaims", $claimsId);
        return $this->framee($claimsEntity->getClaimsImagesDoc());
    }
    
    private function framee($docs)
    {
        $url = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("ViewHelperManager")
        ->get("url");
        
        $blobService = $this->getServiceLocator()->getServiceLocator()->get("GeneralServicer\Service\BlobService");
        $fra = "";
        if (count($docs) == 0) {
            return "No document available";
        } else {
            foreach ($docs as $inf){
                $json = json_encode(array(
                    "data"=>$inf->getId()
                ));
                $fra .= " <a
					id='sending_data_button' class='btn btn-default text-grey-400 btn-lg  paper-shadow relative ajax_element'
							data-json='".$json."'
							data-href='".$url("board", array("action"=>"displaydoc"))."'
					data-hover-z='0.5' data-animated data-toggle='tooltip'
					data-title='".$inf->getDocName()."'>". $blobService->showThumbnails($inf->getMimeType(), $inf)."</i>
				</a> ";
            }
        }
        return $fra;
    }
    
   
}

