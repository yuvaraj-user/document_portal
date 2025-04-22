<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
// Required Files
// require 'pdfparser/src/Smalot/PdfParser/config.php';
// require 'pdfparser/src/Smalot/PdfParser/RawData/RawDataParser.php';
// require 'pdfparser/src/Smalot/PdfParser/RawData/FilterHelper.php';
require 'pdfparser/src/Smalot/PdfParser/Document.php';
require 'pdfparser/src/Smalot/PdfParser/Header.php';
require 'pdfparser/src/Smalot/PdfParser/Element.php';
require 'pdfparser/src/Smalot/PdfParser/PDFObject.php';
require 'pdfparser/src/Smalot/PdfParser/Page.php';
require 'pdfparser/src/Smalot/PdfParser/XObject/Form.php';
require 'pdfparser/src/Smalot/PdfParser/Font.php';
require 'pdfparser/src/Smalot/PdfParser/Element/ElementName.php';
require 'pdfparser/src/Smalot/PdfParser/Element/ElementXRef.php';
require 'pdfparser/src/Smalot/PdfParser/Element/ElementString.php';
require 'pdfparser/src/Smalot/PdfParser/Element/ElementDate.php';
require 'pdfparser/src/Smalot/PdfParser/Element/ElementBoolean.php';
require 'pdfparser/src/Smalot/PdfParser/Element/ElementMissing.php';
require 'pdfparser/src/Smalot/PdfParser/Element/ElementNumeric.php';
require 'pdfparser/src/Smalot/PdfParser/Element/ElementArray.php';
require 'pdfparser/src/Smalot/PdfParser/Element/ElementHexa.php';
require 'pdfparser/src/Smalot/PdfParser/Element/ElementNull.php';
require 'pdfparser/src/Smalot/PdfParser/Pages.php';
require 'pdfparser/src/Smalot/PdfParser/Parser.php';

// Namespaces
use Smalot\PdfParser\Parser;

$file_path = "Eg.pdf";

if (!file_exists($file_path)) {
    echo "File does not exist: " . $file_path;
    exit;
}

// Parse the temporary PDF to extract text
$parser = new Parser();
$pdf = $parser->parseFile($file_path);
$text = $pdf->getText();
echo $text;exit;

?>