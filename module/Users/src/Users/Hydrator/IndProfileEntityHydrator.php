<?php
namespace Users\Hydrator;

use Zend\Stdlib\Hydrator\AbstractHydrator;
use Users\Entity\IndividualInfo;

/**
 *
 * @author swoopfx
 *        
 */
class IndProfileEntityHydrator extends AbstractHydrator
{

    /**
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\Hydrator\HydrationInterface::hydrate()
     *
     */
    public function hydrate(array $data, $object)
    {
        if (! $object instanceof IndividualInfo) {
            return $object;
        }
        
        if ($this->propertyAvailable('firstname', $data)) {
            $object->setFirstname($data['firstname']);
        }
        if ($this->propertyAvailable('lastname', $data)) {
            $object->setFirstname($data['lastname']);
        }
        if ($this->propertyAvailable('othername', $data)) {
            $object->setFirstname($data['othername']);
        }
        
        if ($this->propertyAvailable('dob', $data)) {
            $object->setFirstname($data['dob']);
        }
        
        if ($this->propertyAvailable('createdOn', $data)) {
            $object->setFirstname($data['createdOn']);
        }
        if ($this->propertyAvailable('updatedOn', $data)) {
            $object->setFirstname($data['updatedOn']);
        }
        if ($this->propertyAvailable('user', $data)) {
            $object->setFirstname($data['user']);
        }
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\Hydrator\ExtractionInterface::extract()
     *
     */
    public function extract($object)
    {}

    protected function propertyAvailable($property, $data)
    {
        return (array_key_exists($property, $data) && ! empty($data[$property]));
    }
}

