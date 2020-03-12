<?php
namespace GeneralServicer\Service;

use ZendService\WindowsAzure\Storage\Blob\Blob;
use Zend\Http\Request;
use Zend\Http\Response;
use ZendService\WindowsAzure\Credentials;
use ZendService\WindowsAzure\Exception\DomainException;
use ZendService\WindowsAzure\Exception\InvalidArgumentException;
use ZendService\WindowsAzure\Exception\RuntimeException;
use ZendService\WindowsAzure\RetryPolicy;
use ZendService\WindowsAzure\Storage;

class StorageService extends Blob
{
    private $entityManager;
    
    private $accountName;
    
    private $host;
    
    private $accountKey;
    
    private $container;

    public function __construct($host = Storage\Storage::URL_DEV_BLOB, $accountName = Credentials\AbstractCredentials::DEVSTORE_ACCOUNT, $accountKey = Credentials\AbstractCredentials::DEVSTORE_KEY, $usePathStyleUri = false, RetryPolicy\AbstractRetryPolicy $retryPolicy = null)
    {
        parent::__construct($host, $accountName, $accountKey, $usePathStyleUri, $retryPolicy);
    }
    
    public function setAccountName($name){
        $this->accountName = $name;
        return $this;
    }
    
    public function setAcountKey($key){
        $this->accountKey = $key;
        return $this;
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
    
    public function setHost($host){
        $this->host = $host;
        return $this;
    }
    
    public function setAccountKey($key){
        $this->accountKey = $key;
        return $this;
    }
    
    public function setContainer($con){
        $this->container = $con;
        return $this;
    }
    
    
}

