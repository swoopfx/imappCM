<?php
namespace GeneralServicer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;
use WasabiLib\Ajax\Response;
use WasabiLib\Modal\WasabiModal;
use WasabiLib\Modal\WasabiModalView;
use Zend\Session\Container;
use Policy\Service\CoverNoteService;

/**
 *
 * @author otaba
 *        
 */
class PortalController extends AbstractActionController
{

    private $entityManager;

    private $renderer;
    
    private $puidSession;
    
    private $portalService;

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
       
        return $response;
    }

    public function splashAction()
    {
        $this->layout()->setTemplate("insurer-portal");
        $viewModel = new ViewModel();
        $em = $this->entityManager;
       
        $portUis = $this->params()->fromRoute("pxd", NULL);
        if ($portUis != NULL){
            $puidSession = new Container("piudSession");
            $puidSession->setExpirationSeconds(10);
            $puidSession->portUis = $portUis;
        }
        $port = NULL;
        
        if ($portUis == NULL) {
            $this->flashmessenger()->addErrorMessage("Portal ID is absent");
            $viewModel->setTemplate("general-portal-missing-uid");
        } else {
            
            $port = $em->getRepository("IMServices\Entity\InsurePortal")->findOneBy(array(
                "portalUid" => $portUis
            ));
           
            if ($port != NULL) {
                if ($port->getIsFinal() == TRUE) {
                   
                    $viewModel->setTemplate("general-portal-not-authorized");
                    $viewModel->setVariables(array());
                } else {
                    // At this point insurer can view all information
                    $viewModel->setVariables(array(
                        "port" => $port
                    ));
                }
            } else {
                $viewModel->setTemplate("general-portal-no-portuid");
            }
        }
        
        return $viewModel;
    }
    
    public function pageAction(){
        $this->layout()->setTemplate('insurer-portal-board');
       
        $em = $this->entityManager;
//         $puidSession = new Container("piudSession");
//         $puidSession->

        $puidSession = $this->puidSession;
        $view = new ViewModel();

        if($puidSession->portUis != NULL){
            $portalEntity = $em->getRepository("IMServices\Entity\InsurePortal")->findOneBy(array(
                "portalUid" => $puidSession->portUis
            ));
            $type = $portalEntity->getType()->getId();
           
            if($type == CoverNoteService::COVERNOTE_CATEGORY_PROPOSAL){
                $proposalEntity = $portalEntity->getProposal();
                $view->setVariables(array(
                    "proposalEntity"=>$proposalEntity
                ));
//                 $view->setTemplate("");
            }elseif ($type == CoverNoteService::COVERNOTE_CATEGORY_OFFER){
                
            }elseif ($type == CoverNoteService::COVERNOTE_CATEGORY_PACKAGES){
                
            }else{
                
            }
            
           
        }else{
            $this->layout()->setTemplate("insurer-portal");
            $view->setTemplate("general-portal-no-portuid");
        }
        return $view;
    }

    public function viewpolicymodalAction()
    {
        $response = new Response();
        $modal = new WasabiModal("standard", "View Details");
        $modalView = new WasabiModalView("#wasabi", $this->renderer, $modal);
        $response->add($modalView);
        return $this->getResponse()->setContent($response);
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
    /**
     * @param object $renderer
     */
    public function setRenderer($renderer)
    {
        $this->renderer = $renderer;
        return $this;
    }
    /**
     * @param mixed $puidSession
     */
    public function setPuidSession($puidSession)
    {
        $this->puidSession = $puidSession;
        return $this;
    }
    /**
     * @param mixed $portalService
     */
    public function setPortalService($portalService)
    {
        $this->portalService = $portalService;
        return $this;
    }



}

