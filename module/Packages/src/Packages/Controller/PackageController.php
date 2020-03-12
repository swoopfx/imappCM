<?php
namespace Packages\Controller;

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link http://github.com/zendframework/Packages for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use WasabiLib\Modal\Button;
use WasabiLib\Modal\WasabiModal;
use WasabiLib\Ajax\Response;
use WasabiLib\Modal\WasabiModalView;
use WasabiLib\Ajax\InnerHtml;
use WasabiLib\Modal\Dialog;
use Packages\Entity\FeaturedPackages;
use Zend\View\Model\JsonModel;
use Zend\Session\Container;

class PackageController extends AbstractActionController
{

    private $entityManager;

    private $generalService;

    private $createPackageForm;

    private $packageEntity;

    private $bannerUploadForm;

    private $renderer;

    private $packageService;

    private $featuredPackageForm;

    private $centralBrokerId;

    private $blobService;

    private $dropZoneForm;

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        // $response = parent::on
        $this->redirectPlugin()->redirectCondition();
        return $response;
    }

    // Begin Async
    public function uploaddropzoneAction()
    {
        $em = $this->entityManager;
        $packageBannerSession = new Container("package_banner_session");
        $request = $this->getRequest();
        if ($request->isPost() || $request->isXmlHttpRequest()) {
            $files = $this->params()->fromFiles('file');
            // $res = $this->blobService->uploadBlob($files);
            $res = $this->blobService->uploadBlob($files);
            // $this->redirect()->toRoute("home");
            if ($res != False) {
                $packageBannerSession->bannerId = $res;
                // $objectEntity = $em->find("Object\Entity\Object", $objectViewSession->objectId);
                // $objectEntity->addDocument($em->find("GeneralServicer\Entity\Document", $res))
                // ->setUpdateOn(new \DateTime());
                // $em->persist($objectEntity);
                // $em->flush();
                // $this->flashmessenger()->addSuccessMessage("Logo Successfully uploaded");
                // return $this->redirect()->toRoute("dashboard");
            }
        }
        $blobService = $this->blobService;
        
        return $this->getResponse()->setContent(NULL);
    }

    // / End Async
    public function deleteAction()
    {
        $em = $this->entityManager;
        $id = $this->params()->fromRoute("id", NULL);
        if ($id == NULL) {
            $this->flashmessenger()->addErrorMessage("There is no identifier for this package");
            $this->redirect()->toRoute("packages");
        }
        // $packageEntity = $em->find("Packages\Entity\Packages", $id);
        $packageEntity = $em->getRepository("Packages\Entity\Packages")->findOneBy(array(
            "packageUid" => $id
        ));
        // var_dump($packageEntity);
        $packageEntity->setIsHidden(TRUE)->setUpdatedOn(new \DateTime());
        try {
            $em->persist($packageEntity);
            $em->flush();
            $this->flashmessenger()->addSuccessMessage("The package was successfully deleted");
            $this->redirect()->toRoute("packages/default", array(
                "action" => "all"
            ));
        } catch (\Exception $e) {
            $this->flashmessenger()->addErrorMessage("There was a problem deleting this package");
            $this->redirect()->toRoute("packages");
        }
        $this->getResponse()->setContent(NULL);
    }

    public function featuredAction()
    {
        $em = $this->entityManager;
        $featuredPackageForm = $this->featuredPackageForm;
        $featuredPackageForm->bind(new FeaturedPackages());
        $request = $this->getRequest();
        $featuredPackageForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("packages/default", array(
                "action" => "featured"
            ))
        ));
        $brokerEntity = $em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId);
        $featuredPackageEntity = NULL;
        if ($brokerEntity->getFeaturedPackages() == NULL) {
            $featuredPackageEntity = new FeaturedPackages();
            $featuredPackageEntity->setCreatedOn(new \DateTime());
        } else {
            $featuredPackageEntity = $brokerEntity->getFeaturedPackages();
            $featuredPackageEntity->setUpdatedOn(new \DateTime());
        }
        $featuredPackageForm->bind($featuredPackageEntity);
        
        if ($request->isPost()) {
            
            $post = $request->getPost();
            $featuredPackageForm->setData($post);
            // $data = $featuredPackageForm->getData();
            // var_dump($featuredPackageForm);
            $featuredPackageForm->setValidationGroup(array(
                "featuredPackageFieldset" => array(
                    "package1",
                    "package2",
                    "package3",
                    "package4",
                    "package5"
                )
            ));
            if ($featuredPackageForm->isValid()) {
                
                // var_dump("Hey");
                $featuredPackageEntity->setBroker($em->find("Users\Entity\InsuranceBrokerRegistered", $this->centralBrokerId));
                try {
                    $em->persist($featuredPackageEntity);
                    $em->flush();
                    
                    $this->flashmessenger()->addSuccessMessage("Featured Packages successfully updated");
                    $this->redirect()->toRoute("packages/default", array(
                        "action" => "featured"
                    ));
                } catch (\Exception $e) {
                    $this->flashmessenger()->addErrorMessage("We could not update the featured packages");
                    $this->redirect()->toRoute("packages");
                }
            } else {
                $this->flashmessenger()->addErrorMessage("There was a Validation Error");
            }
        }
        $view = new ViewModel(array(
            "featuredPakageForm" => $featuredPackageForm
        ));
        return $view;
    }

    public function indexAction()
    {
        $packageService = $this->packageService;
        $packages = $packageService->brokerPackages();
        $view = new ViewModel(array(
            "packages" => $packages
        ));
        return $view;
    }

    public function allAction()
    {
        $packageService = $this->packageService;
        $packages = $packageService->brokerPackages();
        
        $view = new ViewModel(array(
            "packages" => $packages
        ));
        return $view;
    }

    public function createAction()
    {
        // $res = FALSE;
        $em = $this->entityManager;
        $dropZoneUploadForm = $this->dropZoneForm;
        $dropZoneUploadForm->setAttributes(array(
            "action" => $this->url()
                ->fromRoute("packages/default", array(
                "action" => "uploaddropzone"
            ))
        ));
        $bannerSession = new Container("package_banner_session");
        $createPackageForm = $this->createPackageForm;
        $packageEntity = $this->packageEntity;
        $createPackageForm->bind($packageEntity);
        $request = $this->getRequest();
        $packageService = $this->packageService;
        $bannerUploadForm = $this->bannerUploadForm;
        $recentPackages = ""; // get 10 most recent packages
        if ($request->isPost()) {
            $data = $request->getPost();
            $createPackageForm->setData($data);
            var_dump("MOOO");
            if ($createPackageForm->isValid()) {
                
                $res = $packageService->createPackageHydrate($packageEntity);
                
                try {
                    
                    $em->persist($packageEntity);
                    $em->flush();
                    $this->flashmessenger()->addSuccessMessage("Package Successfully created");
                    $bannerSession->bannerId = NULL;
                    
                    // $this->flash->addSuccessMessage("Package successfully created");
                    // $this->redirect->toRoute("packages");
                    
                    $this->redirect()->toRoute("packages/default", array(
                        "action" => "view",
                        "id" => $res->getPackageUid()
                    ));
                } catch (\Exception $e) {
                    $this->flashmessenger()->addErrorMessage($e->getMessage());
                    $this->redirect()->toRoute("packages/default", array(
                        "action" => "create"
                    ));
                }
            }
        }
        $view = new ViewModel(array(
            'createPackageForm' => $createPackageForm,
            "dropZoneForm" => $dropZoneUploadForm
        
        ));
        return $view;
    }

    public function serviceAction()
    {
        $em = $this->entityManager;
        $request = $this->getRequest();
        $data = "";
        if ($request->isXmlHttpRequest()) {
            // $data
            $post = $request->getPost()->service;
            $data = $em->getRepository("Settings\Entity\InsuranceSpecificService")->findBy(array(
                "insuranceServiceType"=>$post
            ));
            $html = "";
            foreach ($data as $dat){
                $html .= "<option value='" . $dat->getId() . "'>".$dat->getSpecificService()."</option>";
            }
           // $dat = "<option value='" . $dat->getId() . "'>".$dat->getSpecificService()."</option>";
            $inner = new InnerHtml();
            // $inner->setSelector("#pack_cover");
            // $inner->setContent("<option value='".$post."'>JUST ME</option>");
            
            // $response = new Response();
            // $response->add($inner);
            return $this->getResponse()->setContent($html);
        }
        // $view = new ViewModel(array(
        // "data"=>"<option value='303'>PUM PUM </option>",
        // ));
        
        // $view->setTerminal(TRUE);
        // // $view->set
        // return $view;
    }

    public function uploadbannerAction()
    {
        /**
         * When the upload button is clicked,
         * This function is called
         * The data is called from the form
         * The data is processed stuffed into the conatiner and respose stored in database
         * a resolving respose is returned here
         * if true show image stuffed i container on the specialized div
         * if false show error
         */
        $bannerSession = new Container("package_banner_session");
        $request = $this->getRequest();
        if ($request->isPost()) {
            // validate it must be of a particular size
            try {
                
                if ($request->isPost()) {
                    $files = $this->params()->fromFiles('file');
                    $res = $this->blobService->uploadBlob($files[0]);
                    if ($res != False) {
                        $bannerSession->docId = $res;
                        $this->flashmessenger()->addSuccessMessage("Successfully uploaded banner");
                        $this->redirect()->toRoute("packages/default", array(
                            "action" => "create"
                        ));
                    }
                }
            } catch (\Exception $e) {
                $this->flashmessenger()->addErrorMessage("There was a problem uploading the document");
                $this->redirect()->toRoute("packages/default", array(
                    "action" => "create"
                ));
            }
        } elseif ($request->isXmlHttp()) {}
        
        return $this->getResponse()->setContent(NULL);
    }

    /**
     * This list all the avaliable packages cretaed by the broker
     * It should be able to filer by category
     */
    public function viewAction()
    {
        $em = $this->entityManager;
        $id = $this->params()->fromRoute("id", NULL);
        if ($id == NULL) {
            $this->flashmessenger()->addErrorMessage("You did not specify a package to edit");
            $this->redirect()->toRoute("packages");
        }
        // $package = $em->find("Packages\Entity\Packages", $id);
        $package = $em->getRepository("Packages\Entity\Packages")->findOneBy(array(
            "packageUid" => $id
        ));
        // $packages = $packagesService->brokerPackages();
        $view = new ViewModel(array(
            "package" => $package
        ));
        return $view;
    }

    public function reviewAction()
    {
        $request = $this->getRequest();
        $uploadForm = $this->bannerUploadForm;
        $id = $this->params()->fromRoute("id", NULL);
        $em = $this->entityManager;
        if ($id == NULL) {
            $this->flashmessenger()->addErrorMessage("You did not specify a package to edit");
            $this->redirect()->toRoute("packages");
        }
        // $packageEntity = $em->find("Packages\Entity\Packages", $id);
        $packageEntity = $em->getRepository("Packages\Entity\Packages")->findOneBy(array(
            "packageUid" => $id
        ));
        $packageForm = $this->createPackageForm;
        $packageForm->bind($packageEntity);
        if ($request->isPost()) {
            $data = $request->getPost();
            $packageForm->setData($data);
            if ($packageForm->isValid()) {
                // Set information data
                // Hydrate all information
                
                // $package = $this->params()->fromPost('packageName');
                // $packageEntity->set
                try {
                    $em->persist($packageEntity);
                    $em->flush();
                } catch (\Exception $e) {}
            }
        }
        
        $view = new ViewModel(array(
            'packageForm' => $packageForm,
            "uploadForm" => $uploadForm
        ));
        return $view;
    }

    public function processAction()
    {
        $view = new ViewModel();
        return $view;
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }

    public function setGeneralService($xser)
    {
        $this->generalService = $xser;
        return $this;
    }

    public function setCreatePackageForm($form)
    {
        $this->createPackageForm = $form;
        return $this;
    }

    public function setPackageEntity($ent)
    {
        $this->packageEntity = $ent;
        return $this;
    }

    public function setBannerUploadForm($ban)
    {
        $this->bannerUploadForm = $ban;
        return $this;
    }

    public function setRenderer($rend)
    {
        $this->renderer = $rend;
        return $this;
    }

    public function setPackageService($xserv)
    {
        $this->packageService = $xserv;
        return $this;
    }

    public function setFeaturedPackageForm($form)
    {
        $this->featuredPackageForm = $form;
        return $this;
    }

    public function setCentralBrokerId($id)
    {
        $this->centralBrokerId = $id;
        return $this;
    }

    public function setBlobService($xserv)
    {
        $this->blobService = $xserv;
        return $this;
    }

    public function setDropZoneForm($form)
    {
        $this->dropZoneForm = $form;
        return $this;
    }
}
