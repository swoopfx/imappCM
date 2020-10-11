<?php
namespace GeneralServicer\Service;

use ZendService\WindowsAzure\Storage\Blob\Blob;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
// use MicrosoftAzure\Storage\Blob\Models\ContainerACL;
use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;
// use MicrosoftAzure\Storage\Blob\Models\CreateBlobOptions;
use MicrosoftAzure\Storage\Blob\Models\CreateBlockBlobOptions;
use GeneralServicer\Entity\Document;
use MicrosoftAzure\Storage\Common\Internal\Resources;

/**
 *
 * @author swoopfx
 *        
 */
class BlobService
{

    private $entityManager;

    private $userContainerName;

    private $localFileName;

    private $userId;

    private $docPath;

    private $fileType;

    private $fileSize;

    private $fileName;

    private $fileError;

    private $fileTempName;

    private $blobClient;

    private $centralBrokerId;

    private $centralBrokerUid;

    private $urlView;

    // Videos
    const AVI_VIDEO_MIME_TYPE = "video/x-msvideo";

    const GP_VIDEO_MIME_TYPE = "video/3gpp";

    const MPEG_VIDEO_MIMETYPE = "video/mpeg";

    // Document
    const PDF_MIME_TYPE = "application/pdf";

    const WORD_DOC_MIME_TYPE = "application/msword";

    const WORD_DOCX_MIME_TYPE = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";

    const POWERPOINT_PPT_MIME_TYPE = "application/vnd.ms-powerpoint";

    const POWERPOINT_PPTX_MIME_TYPE = "application/vnd.openxmlformats-officedocument.presentationml.presentation";

    const EXCEL_XLS_MIME_TYPE = "application/vnd.ms-excel";

    const EXCEL_XLSX_MIME_TYPE = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";

    const CSV_MIME_TYPE = "text/csv";

    const TEXT_MIME_TYPE = "text/plain";

    const HTML_MIME_TYPE = "text/html";

    const RTF_MIME_TYPE = "application/rtf";

    // Image
    const JPEG_MIME_TYPE = "image/jpeg";

    const PNG_MIME_TYPE = "image/png";

    const BMP_MIME_TYPE = "image/bmp";

    const GIF_MIME_TYPE = "image/gif";

    const MAX_FILE_SIZE = 10582853;

    // 10 MB

    // Binary Data
    const BINARY_MIME_TYPE = "application/octet-stream";

    protected $error_messages = array(
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE (10MB) specified',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk'
    );

    // private $uploadContainer;
    // const LIVE_AZURE_BLOB_URL = "";

    // const DEMO_AZURE_BLOB_URI = "http://" . Resources::EMULATOR_BLOB_URI;

    // const DEMO_AZURE_DEV_STORE_NAME = Resources::DEV_STORE_NAME;

    // const DEMO_AZURE_BLOB_FULL_URL = BlobService::DEMO_AZURE_BLOB_URI . "/" . BlobService::DEMO_AZURE_DEV_STORE_NAME;

    /**
     * This is used to set the local file to be uploaded
     *
     * @param object $sl
     * @return \GeneralServicer\Service\BlobService
     */
    public function setLocalFileName($sl)
    {
        $blob = new Blob();
        $this->localFileName = $sl;
        return $this;
    }

    public function __construct()
    {
        // $connectionString = "UseDevelopmentStorage=true";
        // $this->blobClient = BlobRestProxy::createBlobService($connectionString);
    }

    /**
     * This sets the doc paths
     *
     * @param string $path
     * @return \GeneralServicer\Service\BlobService
     */
    public function setDocPath($path)
    {
        $this->docPath = $path;
        return $this;
    }

    private function fileTypeCondition()
    {
        switch ($this->fileType) {
            case "image/png":

                break;
        }
    }

    public function cleanContainerName($name)
    {
        return strtolower($name);
    }

    public function createContainer($containerName)
    {
        $options = new CreateContainerOptions();
        $options->setPublicAccess(PublicAccessType::CONTAINER_AND_BLOBS);

        try {
            $this->blobClient->createContainer($this->cleanContainerName($containerName), $options);
        } catch (\Exception $e) {}
    }

    protected function cleanBlobName($name)
    {
        $name = str_replace(" ", "-", $name);
        $name = time() . "_" . $name;
        return $name;
    }

    /**
     * 
     * @param object $file
     * @throws \Exception
     * @return \GeneralServicer\Entity\Document
     */
    public function uploadBlob($file)
    {
        $em = $this->entityManager;
        $docEntity = new Document();
        // var_dump($file);

        // $docName = str_replace(" ", "-", $file["name"]);
        // var_dump($file);
        $blobName = $this->cleanBlobName($file["name"]);
        if (filesize($file['tmp_name'] > BlobService::MAX_FILE_SIZE)) { // maximum size exceeded
            throw new \Exception($this->error_messages[2]);
        } elseif ($file['tmp_name'] == NULL) { // Missing file for upload
//             var_dump($file);
//             var_dump($file['error']);
            throw new \Exception($this->error_messages[4]);
            
        } else {
            
            $content = fopen($file['tmp_name'], 'r');
            // $content = file_get_contents($file[0]['name']);
//             var_dump($file);
            $blobOptions = new CreateBlockBlobOptions();
            $blobOptions->setContentType($file["type"]);
            $res = $this->blobClient->createBlockBlob($this->centralBrokerUid, $blobName, $content, $blobOptions);

            if ($res != NULL) {
                $loadUri = ($_SERVER["APPLICATION_ENV"] == "development" ? GeneralService::GENERAL_DEMO_AZURE_BLOB_FULL_URL : GeneralService::GENERAL_LIVE_AZURE_BLOB_URL);

                $docUrl = $loadUri . "/" . $this->centralBrokerUid . "/" . $blobName;
                $mimeType = $file["type"];

                $docEntity->setCreatedOn(new \DateTime())
                    ->setDocUrl($docUrl)
                    ->setMimeType($mimeType)
                    ->setDocName($blobName)
                    ->setIsHidden(false)
                    ->setIsConfirmed(false);

                $em->persist($docEntity);
//                 $em->flush();

                return $docEntity;
            } else {
                // return false;
                throw new \Exception("Upload Error");
            }
        }
        // var_dump($res);

        // var_dump($res->getLastModified());

        // var_dump($res->getContentMD5());
        // $this->blobClient->cre
        // } catch (\Exception $e) {
        // var_dump($e->getMessage());
        // return false;
        // }
    }

    public function uploadpdf($stream)
    {
        $em = $this->entityManager;
        $docEntity = new Document();

        if ($stream != NULL) {
            $blobOptions = new CreateBlockBlobOptions();
            $blobOptions->setContentType(BlobService::PDF_MIME_TYPE);
            $blobName = $this->cleanBlobName("doc.pdf");
            $res = $this->blobClient->createBlockBlob($this->centralBrokerUid, $blobName, $stream, $blobOptions);
        
            if ($res != NULL) {
                $loadUri = ($_SERVER["APPLICATION_ENV"] == "development" ? GeneralService::GENERAL_DEMO_AZURE_BLOB_FULL_URL : GeneralService::GENERAL_LIVE_AZURE_BLOB_URL);
                
                $docUrl =  $loadUri. "/" . $this->centralBrokerUid . "/" . $blobName;
                $mimeType = BlobService::PDF_MIME_TYPE;
                
                $docEntity->setCreatedOn(new \DateTime())
                ->setDocUrl($docUrl)
                ->setMimeType($mimeType)
                ->setDocName($blobName)
                ->setIsHidden(false)
                ->setIsConfirmed(false);
                
                $em->persist($docEntity);
                $em->flush();
                
                return $docEntity->getId();
            } else {
                // return false;
                throw new \Exception("Upload Error");
            }
        }
    }

    public function putty()
    {
        $em = $this->entityManager;
        $docEntity = $this->documentEntity;
        $containerName = $this->userContainerName;
        $blobName = $this->getName();
        // $localFileName = $this->localFileName;
        $docPath = $this->docPath;
        try {
            $res = $this->blobInstance->putBlob($containerName, $this->getBlobName(), $docPath);
            $docEntity->setDocName($res->getName());
            $docEntity->setDocUrl($res->getUrl());
            $docEntity->setIsConfirmed(false);
            $docEntity->setCreatedOn(new \DateTime());
            $docEntity->setIsHidden(false);
            $em->persist($docEntity);
            $em->flush();
        } catch (\Exception $e) {
            echo "Problem Uploading file";
        }
    }

    /**
     * This can only be used in a view or viewhelper
     * It defines the thumbnail meant to show
     *
     * @param
     *            string mimeType
     * @param object $inf
     * @return string
     */
    public function showThumbnails($mimeType, $inf = NULL)
    {
        $url = $this->urlView;
        $pdf = $url("welcome", array(), array(
            'force_canonical' => true
        )) . "pdf.jpg";
        $video = $url("welcome", array(), array(
            'force_canonical' => true
        )) . "video.jpg";
        $microsoft = $url("welcome", array(), array(
            'force_canonical' => true
        )) . "microsoft.jpg";
        $excel = $url("welcome", array(), array(
            'force_canonical' => true
        )) . "excel.png";

        $defaultDoc = $url("welcome", array(), array(
            'force_canonical' => true
        )) . "docuplouad.png";
        switch ($mimeType) {
            case BlobService::AVI_VIDEO_MIME_TYPE:
            case BlobService::MPEG_VIDEO_MIMETYPE:
                return "<i class='fa fa-video-camera fa-4x'></i>";
                break;

            case BlobService::PDF_MIME_TYPE:
                return "<img src='" . $pdf . "' class='img-circle width-40' >";
                break;
            case BlobService::JPEG_MIME_TYPE:
            case BlobService::BMP_MIME_TYPE:
            case BlobService::PNG_MIME_TYPE:
            case BlobService::GIF_MIME_TYPE:
                return "<img src='" . $inf->getDocUrl() . "' class='img-circle width-40' >";

                break;

            case BlobService::WORD_DOC_MIME_TYPE:
            case BlobService::WORD_DOCX_MIME_TYPE:
                return "<img src='" . $microsoft . "' class='img-circle width-40' >";
                break;

            case BlobService::CSV_MIME_TYPE:
            case BlobService::EXCEL_XLS_MIME_TYPE:
            case BlobService::EXCEL_XLSX_MIME_TYPE:
                return "<img src='" . $excel . "' class='img-circle width-40' >";
                break;
            default:
                return "<img src='" . $defaultDoc . "' class='img-circle width-40' >";
                break;
        }
    }

    private function getBlobName()
    {
        $const = "blob";
        $code = \uniqid($const);
        return $code . $this->userId;
    }

    // Begin Internal Stters
    public function setFileType($type)
    {
        $this->fileType = $type;
        return $this;
    }

    public function setFileError($error)
    {
        $this->fileError = $error;
        return $this;
    }

    public function setFileName($name)
    {
        $this->fileName = $name;
        return $this;
    }

    public function setFileSize($size)
    {
        $this->fileSize = $size;
        return $this;
    }

    public function setFileTempName($name)
    {
        $this->fileTempName = $name;
        return $this;
    }

    // End internal Setters
    public function getUserContainerName()
    {
        return $this->userContainerName;
    }

    // Begin setters
    public function setEntityManager($em)
    {
        $this->entityManager = $em;

        return $this;
    }

    public function setUserContainer($container)
    {
        $this->userContainerName = $container;

        return $this;
    }

    public function setAccountName($azureName)
    {
        $this->azureAccountName = $azureName;

        return $this;
    }

    public function setAccountkey($azureKey)
    {
        $this->azureAccountKey = $azureKey;

        return $this;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    public function setBlobClient($client)
    {
        $this->blobClient = $client;
        return $this;
    }

    /**
     *
     * @return object <unknown, \MicrosoftAzure\Storage\Blob\BlobRestProxy>
     */
    public function getBlobClient()
    {
        return $this->blobClient;
    }

    public function setCentralBrokerId($id)
    {
        $this->centralBrokerId = $id;
        return $this;
    }

    public function setCentralBrokerUid($uid)
    {
        $this->centralBrokerUid = $uid;
        return $this;
    }

    public function setUrlView($view)
    {
        $this->urlView = $view;
        return $this;
    }

    // End Setters
}

