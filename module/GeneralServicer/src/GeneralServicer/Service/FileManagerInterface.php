<?php
namespace GeneralServicer\Service;

/**
 *
 * @author swoopfx
 *        
 */
interface FileManagerInterface
{

    public function directoryStatus();

    public function FileUploader();

    /**
     * Use jThis ton view all files available t a certain user
     */
    public function FileViewer();

    /**
     *
     * @param integer $userId            
     */
    public function setUserIdentity($userId);
}

?>