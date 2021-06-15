<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . '/third_party/tcpdf/tcpdf.php';

class Pdf extends TCPDF
{
    function __construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = 'UTF-8', $diskcache = false, $pdfa = false)
    {
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);
    }

    function header()
    {
    }

    function createHeader($pdf, $text)
    {
        $pdf->setFontSubsetting(true);

        $pdf->AddPage();

        $image_file = base_url('assets/images/logo.png');

        $pdf->Image($image_file, 70, 6, 20, 20, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
        // Set font
        $pdf->SetFont('helvetica', 'B', 25);
        // Title
        $pdf->SetXY(0, 0);
        $pdf->Cell(0, 25, 'E-Sensus Penduduk Desa Malimpung', 0, false, 'C', 0);
        $pdf->SetFont('helvetica', '', 12);
        $pdf->SetXY(0, 0);
        $pdf->Cell(0, 40, 'Malimpung, Patampanua, Kabupaten Pinrang, Sulawesi Selatan 91252', 0, false, 'C', 0);

        $pdf->SetDrawColor(150, 150, 150);
        $pdf->SetLineWidth(1);
        $pdf->Line(5, 31, 350, 31);
        $pdf->SetLineWidth(0);
        $pdf->Line(5, 32, 350, 32);

        $pdf->ln(35);

        $pdf->SetFont('helvetica', 'B', 12, '', true);
        $pdf->cell(0, 0, $text, 0, 1, 'C');

        $pdf->ln();
    }
}
