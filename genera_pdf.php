<?php
require('fpdf/fpdf.php');

class PDF extends FPDF {
    function CellChop($w, $h, $word, $border = 0, $ln = 0, $align = 'J', $fill = false, $link = '') {
        if($w == 0) $w = $this->GetMaxLenght();
        while(ceil($this->GetStringWidth($word)) + 1 > $w) {
            $word = substr($word, 0, -1);
        }
        $this->Cell($w,$h,$word,$border,$ln,$align,$fill,$link);
    }
    function CellAuto($margin, $h, $word, $border = 0, $ln = 0, $align = 'J', $fill = false, $link = '') {
        $this->Cell(ceil($this->GetStringWidth($word))+$margin,$h,$word,$border,$ln,$align,$fill,$link);
    }
    function WriteChop($w, $h, $string, $link ='') {
        while(ceil($this->GetStringWidth($string)) >= $w) {
            $string = substr($string, 0, -1);
        }
        $this->Write($h, $string, $link);
    }
    function GetMaxLenght() {
        return $this->GetPageWidth() - $this->GetX() - 10;
    }
}

$mec_elet = '';
if(isset($_POST['meccanica']) and isset($_POST['elettrica'])) {
    $mec_elet = '(Meccanica ed Elettrica)';
}
if(isset($_POST['meccanica']) xor isset($_POST['elettrica'])) {
    $mec_elet = isset($_POST['meccanica']) ? '(Meccanica)' : '(Elettrica)';
}


$color = [181,225,175];
$pdf = new PDF();
$pdf->SetTitle('Rapporto di Manutenzione');
$pdf->AddPage();
call_user_func_array([$pdf, "SetFillColor"], $color);
// $pdf->SetFillColor(181,225,175);
$pageW = $pdf->GetPageWidth();
/* LOGO */
$logoW = 45;
$pdf->Image('assets/img/logo.png', $pageW - $logoW - 10 , 13, $logoW);
/* TITLE */
$pdf->SetFont('Arial', 'B', 19);
$pdf->Cell(0, 16, 'Rapporto di Manutenzione', 0, 1);
/* ROW 1 */
$pdf->SetFont('Arial', 'B', 10);
$pdf->CellAuto(5, 5, 'LUOGO:', 'LT', 0, '', true);
$pdf->SetFont('Arial', '', 10);
$pdf->CellChop(40, 5, $_POST['luogo'], 'LT', 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->CellAuto(5, 5, 'OPERATORE:', 'LT', 0, '', true);
$x = $pdf->GetX();
$pdf->SetFont('Arial', '', 10);
$pdf->CellChop($pageW - $x - 26 - 10, 5, implode(', ', array_filter($_POST['nomi'], function($nome){return trim($nome) != '';}) ), 'LT', 0);
$pdf->Cell(26, 5, date('d/m/Y', strtotime($_POST['data'])), 'LTR', 0, 'C');
$pdf->Ln();
$pdf->Cell(0, 5, '', 'LTR', 1, '', true);
/* ROW 2 */
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 5, 'MACCHINARIO OGGETTO:', 'LT', 0, '', true);
$pdf->SetFont('Arial', '', 10);
$pdf->CellChop(0, 5, $_POST['macchinario'], 'LTR', 0, '');
$pdf->Ln();
$pdf->Cell(0, 5, '', 'LTR', 1, '', true);
/* ROW 3 */
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 5, 'COMPONENTE DANNEGGIATO:', 'LT', 0, '', true);
$pdf->SetFont('Arial', '', 10);
$pdf->CellChop(0, 5, $_POST['componente'], 'LTR', 0, '');
$pdf->Ln();
$pdf->Cell(0, 5, '', 'LTR', 1, '', true);
/* ROW 4 */
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 5, 'CAUSA DEL GUASTO:', 'LT', 0, '', true);
$pdf->SetFont('Arial', '', 10);
$pdf->CellChop(0, 5, $_POST['causa-guasto'], 'LTR', 0, '');
$pdf->Ln();
$pdf->Cell(0, 5, '', 'LTR', 1, '', true);
/* ROW 5 */
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 5, 'TIPO D\'INTERVENTO:', 'LT', 0, '', true);
$pdf->SetFont('Arial', '', 10);
$pdf->CellChop(0, 5, $_POST['tipo-intervento'], 'LTR', 0, '');
$pdf->Ln();
$pdf->Cell(0, 5, '', 'LTR', 1, '', true);
/* ROW 6 */
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 5, 'SOLUZIONE ADOTTATA:', 'LT', 0, '', true);
$pdf->SetFont('Arial', '', 10);
$pdf->CellChop(0, 5, $_POST['soluzione-adottata'] . $mec_elet , 'LTR', 0, '');
$pdf->Ln();
$pdf->Cell(0, 5, '', 'LTR', 1, '', true);
/* ROW 7 */
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 5, 'TEMPO COMPLESSIVO:', 'LT', 0, '', true);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(26, 5, $_POST['tempo-intervento'], 'LT', 0, 'C');
$x = $pdf->GetX();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($pageW - $x - 26 - 10, 5, 'PER STRAORDINARIE:', 'LT', 0, 'R', true);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, $_POST['straordinari'], 'LTR', 0, 'C');
$pdf->Ln();
$pdf->Cell(0, 5, '', 'LTR', 1, '', true);
/* ROW 8 TABLE */
$col = ($pageW - 20)/7;
$pdf->Cell($col, 5, 'Luogo', 'LT', 0, 'C', true);
$pdf->Cell($col, 5, 'Zona', 'LT', 0, 'C', true);
$pdf->Cell($col, 5, utf8_decode('Armadio N°'), 'LT', 0, 'C', true);
$pdf->Cell($col*.8, 5, 'Codice', 'LT', 0, 'C', true);
$pdf->Cell($col*1.6, 5, 'Descrizione', 'LT', 0, 'C', true);
$pdf->Cell($col*.8, 5, utf8_decode('Q.tà'), 'LT', 0, 'C', true);
$pdf->Cell($col*.8, 5, 'Rimanenza', 'LTR', 0, 'C', true);
$pdf->Ln();
for($i = 0; $i < 5; $i++) {
    $pdf->Cell($col, 5, '', 'LT', 0);
    $pdf->Cell($col, 5, '', 'LT', 0);
    $pdf->Cell($col, 5, '', 'LT', 0);
    $pdf->Cell($col*.8, 5, '', 'LT', 0);
    $pdf->Cell($col*1.6, 5, '', 'LT', 0);
    $pdf->Cell($col*.8, 5, '', 'LT', 0);
    $pdf->Cell($col*.8, 5, '', 'LTR', 1);
}
/* ROW 9 */
$pdf->CellAuto(5, 5, 'Disponibile in magazzino', 'LT', 0, '', true);
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->Cell(0, 5, '', 'TR', 1, '', true);
$pdf->SetFillColor(255);
$pdf->Rect($x, $y + 1, 3, 3, 'DF');
call_user_func_array([$pdf, "SetFillColor"], $color);
/* ROW 10 OSSERVAZIONI */
$pdf->CellAuto(5, 5, 'Osservazioni:', 'LT', 0,);
list($x, $y) = [$pdf->GetX(), $pdf->GetY()];
$max = ($pdf->GetPageWidth() - 20)*13 - 410;
$pdf->WriteChop($max,5, $_POST['osservazioni']);
$pdf->SetXY($x,$y);
$pdf->Cell(0, 5, '', 'TR', 1,);
for($i = 0; $i < 13; $i++) {
    $pdf->Cell(0, 5, '', 'LTR', 1,);
}
if(isset($_POST["isra"])) {
    $y += 5.7;
    for ($i=0; $i < 9; $i++) { 
        $pdf->Rect(190, $y + $i*5, 3.5, 3.5, 'D');
    }
}
$pdf->Cell(0, 5, '', 'LTR', 1, '', true);
/* ROW VERIFICA 1 */
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->Rect($x + 8, $y + 1, 3, 3);
if(isset($_POST['verifiche']) && in_array("1", $_POST['verifiche'])) {
    $pdf->SetFont('ZapfDingbats');
    $pdf->Text($x+8.5, $y+3.6, chr(51));
}
$pdf->Cell(20, 5, '', 'LT', 0);
$pdf->SetFont('Arial');
$pdf->Cell(0, 5, "Verificata l'assenza di materiali nella zona interessata alla manutenzione", 'LTR', 1);
/* ROW VERIFICA 2 */
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->Rect($x + 8, $y + 1, 3, 3);
if(isset($_POST['verifiche']) && in_array("2", $_POST['verifiche'])) {
    $pdf->SetFont('ZapfDingbats');
    $pdf->Text($x+8.5, $y+3.6, chr(51));
}
$pdf->Cell(20, 5, '', 'LT', 0);
$pdf->SetFont('Arial');
$pdf->Cell(0, 5, "Verificata 'assenza di sostanze inquinanti", 'LTR', 1);
/* ROW VERIFICA 3 */
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->Rect($x + 8, $y + 1, 3, 3);
if(isset($_POST['verifiche']) && in_array("3", $_POST['verifiche'])) {
    $pdf->SetFont('ZapfDingbats');
    $pdf->Text($x+8.5, $y+3.6, chr(51));
}
$pdf->Cell(20, 5, '', 'LT', 0);
$pdf->SetFont('Arial');
$pdf->Cell(0, 5, "Verificata la pulizia della zona interessata alla manutenzione", 'LTR', 1);
$pdf->Cell(0, 5, '', 'LTR', 1, '', true);
/* ROW FIRME */
$pdf->SetFont('Arial', 'B', 10);
$pdf->CellAuto(5,5,'OPERATORE:', 'LTB', 0, '', true);
$pdf->SetFont('Arial', '', 10);
$pdf->CellChop(70,5, $_POST['nomi'][0], 'LTB', 0);
$pdf->CellAuto(5,5, date('d/m/Y', strtotime($_POST['data'])), 'LTB', 0, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0,5, 'Firma:', 'LTRB', 1);
/* FINE */
$pdf->SetY($pdf->GetY() + 5);
$pdf->CellAuto(3,5, 'Si deve allegare tutta la documentazione connessa.');
$pdf->SetFont('Arial', '');
$pdf->Cell(0, 5, '(Relazioni, disegni, mail, offerte, ecc.)');
$pdf->Ln();
$pdf->Cell(0, 5, 'MER/RM;05-11-96;03;18-04-2017;P14');




$pdf->Output('I', 'Rapporto di Manutenzione.pdf');


?>