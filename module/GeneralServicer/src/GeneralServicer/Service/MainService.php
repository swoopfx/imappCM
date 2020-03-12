<?php
namespace GeneralServicer\Service;

/**
 *
 * @author swoopfx
 *        
 */
class MainService
{

    private $entityManager;

    private $viewManager;

    private $controllerPluginManager;

    public function __construct()
    {
        
        // TODO - Insert your code here
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        
        return $this;
    }

    public function setVeiwManager($manager)
    {
        $this->viewManager = $manager;
        
        return $this;
    }

    public function setControllerPluginManager($manager)
    {
        $this->controllerPluginManager = $manager;
        
        return $this;
    }
}

