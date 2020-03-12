<?php
namespace GeneralServicer\Service;

use Users\Entity\InsuranceBrokerRegistered;

/**
 *
 * @author otaba
 *        
 */
class FireBaseService
{

    private $entityManager;

    private $connection;
    
    private $database;

    // TODO - Insert your code here

    /**
     */
    public function __construct()
    {

        // TODO - Insert your code here
    }

    /**
     *
     * @param InsuranceBrokerRegistered $brokerEntity
     * @return boolean
     */
    public function brokerConnection($brokerEntity)
    {
        $isConnected = "";
//         var_dump($this->database);

//         $this->database
        return $isConnected;
    }

    public function customerConnection($brokerEntity, $customerEntity)
    {}
    /**
     * @return mixed
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @return mixed
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param mixed $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

    /**
     * @param mixed $connection
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     * @param mixed $database
     */
    public function setDatabase($database)
    {
        $this->database = $database;
        return $this;
    }


}

