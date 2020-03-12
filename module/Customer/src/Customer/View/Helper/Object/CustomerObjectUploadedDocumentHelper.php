<?php
namespace Customer\View\Helper\Object;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

/**
 * This class displays all documents associated to a specific property
 *
 * @author otaba
 *        
 */
class CustomerObjectUploadedDocumentHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    public function __invoke($docs)
    {
        return $this->framee($docs);
    }

    private function framee($docs)
    {
        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");
        
        $fra = "";
        $blobService = $this->getServiceLocator()->getServiceLocator()->get("GeneralServicer\Service\BlobService");
        if (count($docs) == 0) {
            return "No document attached to file";
        } else {
            foreach ($docs as $doc) {
                $json = json_encode(array(
                    "data"=>$doc->getId()
                ));
                
                $fra .= "<a id='sending_data_button' class='btn btn-default text-grey-400 btn-lg btn-circle paper-shadow relative ajax_element'
							data-json='".$json."'
							data-href='".$url("board", array("action"=>"displaydoc"))."'
					data-hover-z='0.5' data-animated data-toggle='tooltip'
					data-title='". $doc->getDocName() ."'> ". $blobService->showThumbnails($doc->getMimeType(), $doc)."</i>
				</a>   ";
                
            }
            return $fra;
        }
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     */
    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}

