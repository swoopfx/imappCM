<?php
namespace Users\Hydrator;

use Zend\Stdlib\Hydrator\AbstractHydrator;

/**
 *
 * @author swoopfx
 *        
 */
class IndContactEntityHydrator extends AbstractHydrator
{

    protected $entityManager;

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
    {}

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

    public function setEntityManager($em)
    {
        $this->entityManager = $em;
        return $this;
    }
}

