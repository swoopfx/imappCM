<?php
namespace Proposal\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * This class displays all uploaded document on this proposal
 *
 * @author otaba
 *        
 */
class ProposalProcessDocHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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

    public function __invoke($proposalId)
    {
        $generalService = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("GeneralServicer\Service\GeneralService");

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
        $fra = "";
        if (count($docs) == 0) {
            return "No docs available";
        } else {
            
            foreach ($docs as $doc) {
                $json = json_encode(array("data" => $doc->getId()));
//                 var_dump($doc->getId());
                $fra .= "
                          <li>
                            <p>
                              <span class='month'><a href='" . $doc->getDocUrl() . "' target='_blank'>" . $doc->getDocName() . "</a></span> <a id='sending-data-button' class='ajax_element' data-ajax-loader='removeDoc' data-json='{$json}' data-href='" . $url("proposal/default", array(
                    "action" => "removedocconfirm",
                                  
                )) . "'><span class='count fa fa-close fa-danger'></span></a></p>
                          </li>";
            }
        }
        return "<ul class='to_do list-inline widget_tally'>" . $fra . "</ul>";
    }
}

