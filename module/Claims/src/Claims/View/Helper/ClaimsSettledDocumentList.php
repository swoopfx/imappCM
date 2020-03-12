<?php
namespace Claims\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;

class ClaimsSettledDocumentList extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    public function __invoke($claimsEntity)
    {
        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");

        $fra = "";
//         $approved = ($claimsEntity->getIsSettled() == TRUE ? "disabled" : "");
        $claimsSettledEntity = $claimsEntity->getClaimsSettled();
        $docs = $claimsSettledEntity->getDocument();
        if (count($docs) == 0) {
            $fra = "No docs available";
        } else {
            foreach ($docs as $doc) {

                $json = json_encode(array(
                    "data" => $doc->getId()
                ));
                $fra .= "
                          <li>
                            <p>
                              <span class='month'><a href='" . $doc->getDocUrl() . "' target='_blank'>" . $doc->getDocName() . "</a></span> <a id='sending_data_button' class='ajax_element'  data-json='{$json} 'data-href='" . $url("claims/default", array(
                    "action" => "removedocconfirm"
                )) . "'><span class='count fa fa-close fa-danger'></span></a></p>
                          </li><br>";
            }

            $fra = "<table><tr><td><ul class='to_do list-inline widget_tally'>" . $fra . "</ul></td></tr></table>";
        }

        return $fra;
    }
}

