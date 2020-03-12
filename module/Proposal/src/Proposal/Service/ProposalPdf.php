<?php
namespace Proposal\src\Proposal\Service;

class ProposalPdf extends \TCPDF
{

    private $entityManager;

    private $generalService;

    private $urlViewHelper;

    // TODO - Insert your code here
    public function __construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = 'UTF-8', $diskcache = false, $pdfa = false)
    {
        parent::__construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = 'UTF-8', $diskcache = false, $pdfa = false);
        // TODO - Insert your code here
    }

    public function Header()
    {
        // Logo
//         $image_file = K_PATH_IMAGES . 'logo_example.jpg';
//         $image_file= $this->urlViewHelper("welcome", array(), array(
//             'force_canonical' => true
//         ));
        $image_file = "";
//         $this->Image
        $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 15, 'PROPOSAL DETAILS', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }
    
    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

    public function createProposalPdf()
    {}

    /**
     *
     * @return mixed
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     *
     * @param mixed $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getGeneralService()
    {
        return $this->generalService;
    }

    /**
     * @return mixed
     */
    public function getUrlViewHelper()
    {
        return $this->urlViewHelper;
    }

    /**
     * @param mixed $generalService
     */
    public function setGeneralService($generalService)
    {
        $this->generalService = $generalService;
        return $this;
    }

    /**
     * @param mixed $urlViewHelper
     */
    public function setUrlViewHelper($urlViewHelper)
    {
        $this->urlViewHelper = $urlViewHelper;
        return $this;
    }

}

