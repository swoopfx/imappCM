<?php
namespace GeneralServicer\Service;

/**
 *
 * @author swoopfx
 *        
 */
class FileManagerService implements FileManagerInterface
{

    protected $_dir = NULL;

    protected $entityManager;

    protected $auths;
 // TODO find a way to make sure the user initialized
    
    /**
     * (non-PHPdoc)
     *
     * @see \GeneralServicer\Service\FileManagerInterface::directoryStatus()
     *
     */
    public function directoryStatus()
    {
        
        // TODO - Insert your code here
    }

    /**
     * (non-PHPdoc)
     *
     * @see \GeneralServicer\Service\FileManagerInterface::FileUploader()
     *
     */
    public function FileUploader()
    {
        if ($this->auths->hasIdentity()) {}
    }

    /**
     * (non-PHPdoc)
     *
     * @see \GeneralServicer\Service\FileManagerInterface::FileViewer()
     *
     */
    public function FileViewer()
    {
        
        // TODO - Insert your code here
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \GeneralServicer\Service\FileManagerInterface::setUserIdentity()
     */
    public function setUserIdentity($auth)
    {
        $this->auths = $auth;
    }

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
    }
}

?>