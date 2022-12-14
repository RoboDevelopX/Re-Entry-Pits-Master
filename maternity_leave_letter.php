<?php
session_start();
include 'database/config.php';
include 'fpdf/fpdf.php';
$sr_no = $_GET['sr_no'];
$query = "SELECT * FROM `records` WHERE `sr_no` = '$sr_no'";
                    $fetch = $mysqli->query($query) or die($mysqli->error.__LINE__);
                    $row = mysqli_fetch_assoc($fetch);
                    $issue_date = date_create($row['date_issued']);
                    $re_entry_date = date_create($row['re_entry_date']);
$pdf = new FPDF();
$pdf->AddPage();
$pdf->Image('assets/images/Coat_of_arms_of_Zambia.png',82,16,30);
$pdf->Ln(15);
$pdf->SetFont('Times','B',12);
$pdf->Cell(176,55,'Republic of Zambia', 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(176,60,'Ministry of Education', 0, 0, 'C');
$pdf->Ln(15);
$pdf->Cell(176,60,'RE: MINISTRY OF EDUCATION RE-ENTRY POLICY FOR PREGNANT GIRLS');
$pdf->Ln(40);
$pdf->SetFont('Times','',12);
$pdf->MultiCell(0,5,'This is a follow up to our earlier communication regarding your child, '.$row['g_name'].', who is currently expecting a baby.');
$pdf->Ln(5);
$pdf->MultiCell(0,5,'This letter serves to explain Government Policy on school girl pregnancies. Through the Re-Entry Policy Circular of 1997, Government prohibited the expulsion of pregnant girls from school. This policy requires girls to go back to school not later than one year after delivery of the child.');
$pdf->Ln(5);
$pdf->MultiCell(0,5,'The purpose of this letter, therefore, is to inform you that '.$row['g_name'].' will be required to resume school by '.date_format($re_entry_date, "F j, Y").', after she has given birth. Kindly sign the attached commitment form and return it to the school within this week. Failure to comply with the requirements of the Re-Entry Policy may result in legal action being taken against the parents/guardians as stipulated in the Laws of the Land.');
$pdf->Ln(15);
$pdf->SetFont('Times','I',12);
$pdf->Cell(0,5,'Yours sincerely,');
$pdf->Ln(20);
$pdf->Cell(0,5,$row['manager']);
$pdf->Ln(5);
$pdf->SetFont('Times','B',12);
$pdf->Cell(0,5,'School Manager');

/* Page 2 */
$pdf->AddPage();
$pdf->Image('assets/images/Coat_of_arms_of_Zambia.png',82,16,30);
$pdf->Ln(15);
$pdf->SetFont('Times','B',12);
$pdf->Cell(176,55,'Republic of Zambia', 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(176,60,'Ministry of Education', 0, 0, 'C');
$pdf->Ln(15);
$pdf->Cell(176,60,'Ref/Serial Number: '.$row['sr_no']);
$pdf->Ln(15);
$pdf->Cell(176,60,'LETTER OF MATERNITY LEAVE AND RE-ADMISSION');
$pdf->Ln(40);
$pdf->SetFont('Times','I',12);
$pdf->Cell(0,5,'Dear '.$row['g_name'].',');
$pdf->Ln(10);
$pdf->SetFont('Times','',12);
$pdf->MultiCell(0,5,'This serves to inform you that the school has granted you maternity leave from '.date_format($issue_date, "F j, Y").' to '.date_format($re_entry_date, "F j, Y").'.');
$pdf->Ln(10);
$pdf->MultiCell(0,5,'You will be required to report for classes on '.date_format($re_entry_date, "F j, Y").' at 07:30 hrs.');
$pdf->Ln(10);
$pdf->MultiCell(0,5,'Please note that disciplinary action will be taken against you if you fail to report on the stated date.');
$pdf->Ln(15);
$pdf->SetFont('Times','I',12);
$pdf->Cell(0,5,'Yours sincerely,');
$pdf->Ln(20);
$pdf->Cell(0,5,$row['manager']);
$pdf->Ln(5);
$pdf->SetFont('Times','B',12);
$pdf->Ln(5);
$pdf->Cell(0,5,'School Manager');
$pdf->Ln(5);
$pdf->Cell(0,5,date('F j, Y'));

/* Print */
$pdf->Output();
?>