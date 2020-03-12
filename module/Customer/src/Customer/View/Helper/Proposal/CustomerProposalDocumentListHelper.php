<?php
namespace Customer\View\Helper\Proposal;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;


/**
 *
 * @author otaba
 *        
 */
class CustomerProposalDocumentListHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{
    
    private $servicelocator;

    /**
     */
    public function __construct()
    {
        
        
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
     *
     */
    public function getServiceLocator()
    {
        return $this->servicelocator;
        
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     *
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        
        $this->servicelocator = $serviceLocator;
        return $this;
    }

    

    public function  __invoke($proposalId){
        $generalService = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("Customer\Service\ClientGeneralService");
        
        $em = $generalService->getEntityManager();
        $proposalEntity = $em->find("Proposal\Entity\Proposal", $proposalId);
        return $this->framee($proposalEntity->getDocument());
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
            return "No docs available";
        } else {
            foreach ($docs as $inf){
                $json = json_encode(array(
                    "data"=>$inf->getId()
                ));
                $fra .= " <a
					id='sending_data_button' class='btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative ajax_element'
							data-json='".$json."'
							data-href='".$url("board", array("action"=>"displaydoc"))."'
					data-hover-z='0.5' data-animated data-toggle='tooltip'
					data-title='".$inf->getDocName()."'> ". $blobService->showThumbnails($inf->getMimeType(), $inf)."</i>
				</a> ";
            }
        }
        return $fra;
    }
}

