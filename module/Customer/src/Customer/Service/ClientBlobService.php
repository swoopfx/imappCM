<?php
namespace Customer\Service;

use GeneralServicer\Service\GeneralService;
use MicrosoftAzure\Storage\Blob\Models\CreateBlockBlobOptions;
use GeneralServicer\Entity\Document;

/**
 *
 * @author otaba
 *        
 */
class ClientBlobService
{

   private $entityManager;
   
   private $clientGeneralService;
   
   private $blobClient;
   
   private $centralBrokerUid;
    
   
   public function uploadBlob($file)
   {
       $em = $this->entityManager;
       $docEntity = new Document();
       
       try {
           $content = fopen($file['tmp_name'], 'r');
           // $content = file_get_contents($file[0]['name']);
           
           $blobOptions = new CreateBlockBlobOptions();
           $blobOptions->setContentType($file["type"]);
           $docName = str_replace(" ", "-", $file["name"]);
           // var_dump($file);
           $blobName = time() . $docName;
           //var_dump($file);
           // var_dump($this->centralBrokerId);
           $res = $this->blobClient->createBlockBlob($this->centralBrokerUid, $blobName, $content, $blobOptions);
           if($res != NULL || isEmpty($res)){
               $docUrl = GeneralService::GENERAL_DEMO_AZURE_BLOB_FULL_URL . "/" . $this->centralBrokerUid . "/" . $blobName;
               $mimeType = $file["type"];
               
               $docEntity->setCreatedOn(new \DateTime())
               ->setDocUrl($docUrl)
               ->setMimeType($mimeType)
               ->setDocName($blobName)
               ->setIsHidden(false)
               ->setIsConfirmed(false);
               
               $em->persist($docEntity);
               $em->flush();
               
               return $docEntity->getId();
           }else{
               return false;
           }
           
           // var_dump($res->getContentMD5());
           // $this->blobClient->cre
       } catch (\Exception $e) {
           return false;
       }
   }
    
    public function setEntityManager($em){
        $this->entityManager = $em ;
        return $this;
    }
    
    public function setClientGeneralService($xserv){
        $this->clientGeneralService= $xserv;
        return $this;
    }
    
    public function setBlobClient($client){
        $this->blobClient = $client;
        return $this;
    }
    
    public function setCentralBrokerUid($uid){
        $this->centralBrokerUid  = $uid;
        return $this;
    }
}

