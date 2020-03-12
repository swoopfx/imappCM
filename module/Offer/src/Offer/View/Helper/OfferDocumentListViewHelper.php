<?php
namespace Offer\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 *
 * @author otaba
 *        
 */
class OfferDocumentListViewHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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

    public function __invoke($offerEntity)
    {
        $generalService = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("GeneralServicer\Service\GeneralService");
        $document = $offerEntity->getIdDoc();
        return $this->frames($document);
    }

    private function frames($docs)
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
                $fra .= "
                          <li>
                            <p>
                              <span class='month'><a href='" . $doc->getDocUrl() . "' target='_blank'>" . $doc->getDocName() . "</a></span> <a href='" . $url("offer/default", array(
                    "action" => "removedoc",
                    "id" => $doc->getId()
                )) . "'><span class='count fa fa-close fa-danger'></span></a></p>
                          </li>";
            }
        }
        return "<ul class='to_do list-inline widget_tally'>" . $fra . "</ul>";
    }

}

