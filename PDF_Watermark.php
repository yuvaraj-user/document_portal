<?php 
require_once('assets/plugins/FPDF/fpdf.php');
require_once('assets/plugins/FPDI/fpdi.php');
require_once('PDF_Rotate.php');

require_once('assets/plugins/process/Process.php'); 
require_once('assets/plugins/process/ProcessUtils.php'); 
require_once('assets/plugins/process/Pipes/PipesInterface.php'); 
require_once('assets/plugins/process/Pipes/AbstractPipes.php'); 
require_once('assets/plugins/process/Pipes/WindowsPipes.php'); 
require_once('assets/plugins/process/Exception/ExceptionInterface.php'); 
require_once('assets/plugins/process/Exception/RuntimeException.php'); 

require_once('assets/plugins/pdf-version-converter/src/Guesser/GuesserInterface.php'); 
require_once('assets/plugins/pdf-version-converter/src/Guesser/RegexGuesser.php'); 
require_once('assets/plugins/pdf-version-converter/src/Converter/GhostscriptConverterCommand.php');
require_once('assets/plugins/pdf-version-converter/src/Converter/ConverterInterface.php'); 

require_once('assets/plugins/pdf-version-converter/src/Converter/GhostscriptConverter.php'); 
require_once('assets/plugins/filesystem/Filesystem.php'); 




$guesser = new \Xthiago\PDFVersionConverter\Guesser\RegexGuesser();

// use Symfony\Component\Filesystem\Filesystem,
//     Xthiago\PDFVersionConverter\Converter\GhostscriptConverterCommand,
//     Xthiago\PDFVersionConverter\Converter\GhostscriptConverter;

// [..]
echo $guesser->guess('uploads/Quality_Assurance_SOP.pdf'); // will print something like '1.4'

exit;
$command = new Xthiago\PDFVersionConverter\Converter\GhostscriptConverterCommand();
$filesystem = new Symfony\Component\Filesystem\Filesystem();

$converter = new Xthiago\PDFVersionConverter\Converter\GhostscriptConverter($command, $filesystem);
$converter->convert('uploads/Quality_Assurance_SOP.pdf', '1.4');

function addWatermark($x, $y, $watermarkText, $angle, $pdf, $opacity = 0.3)
{
    $angle = $angle * M_PI / 180;
    $c = cos($angle);
    $s = sin($angle);
    $cx = $x * 1;
    $cy = (300 - $y) * 1;
    $pdf->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm', $c, $s, - $s, $c, $cx, $cy, - $cx, - $cy));

        $pdf->_out(sprintf('%.2F gs', $opacity));  // Set the opacity (gs is the graphics state operator)

    $pdf->Text($x, $y, $watermarkText);
    // $pdf->Image('../global/photos/logo.png', $x, $y, 250, 60);
    $pdf->_out('Q');
}

// Source file and watermark config 
$file = 'uploads/Eg.pdf'; 
$text_image = '../global/photos/logo.png'; 
 
// Set source PDF file 
$pdf = new Fpdi(); 

$pdf_rotate = new PDF_Rotate(); 

if(file_exists("./".$file)){ 
    $pagecount = $pdf->setSourceFile($file); 
}else{ 
    die('Source PDF not found!'); 
} 
 

// Add watermark image to PDF pages 
for($i=1;$i<=$pagecount;$i++){ 
    $tpl = $pdf->importPage($i); 
    $size = $pdf->getTemplateSize($tpl); 
    $pdf->addPage(); 
    $pdf->useTemplate($tpl, 1, 1, $size['w'], $size['h'], TRUE); 
    
    $imageWidth = 150; // Set image width
    $imageHeight = 50; // Set image height

    //Put the watermark 
    $xaxis_final = ($size['w'] - $imageWidth)/2; 
    $yaxis_final = ($size['h'] - $imageHeight)/2;

    $pdf->SetFont('Times', '', 70);
    // $pdf->SetTextColor(192, 192, 192);
    $pdf->SetTextColor(80, 200, 120);

    $watermarkText = 'Rasi Seeds';
    addWatermark(130, 210, $watermarkText, 45, $pdf, 0.3);
    $pdf->SetXY(25, 25);

    // $pdf->Image($text_image, $xaxis_final, $yaxis_final, 0, 0, 'png'); 
} 
 
// Output PDF with watermark 
$pdf->Output('uploads/Eg-wm.pdf');

?>