<?php
     require './lib/fpdf.php';
     include 'conn.php';
     include 'server.php';
     
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->setTextColor(252, 3, 3);
        $pdf->Cell(200,20,'Employe Management System',0,1,'C');
        $pdf->setLeftMargin(30);
        $pdf->setTextColor(0, 0, 0);

        $pdf->Cell(20,10,"Date:",0,0,'C');
        $pdf->Cell(30,10,date("j-n-Y"),0,1,'C');
        // table column
        $pdf->Cell(20,10,'ID',1,0,'C');
        $pdf->Cell(40,10,'Type',1,0,'C');
        $pdf->Cell(40,10,'Amount',1,0,'C');
        $pdf->Cell(40,10,'Description',1,1,'C');
        // table rows
        $pdf->SetFont('Arial','',14);
        
        // $con = new PDO("mysql:host = localhost;dbname=khata","root","");
        // $con = new PDO("mysql:host = $cleardb_server;dbname=$cleardb_db","$cleardb_username","$cleardb_password");

        $query ="SELECT * FROM expenses WHERE u_id = '$u_id'";
        $result = $con->prepare($query);
        $result->execute();
        if($result)
            $i=0;
            while($row = $result->fetch())
            {
              $pdf->Cell(20,10,++$i,1,0,'C');
              $pdf->Cell(40,10,$row['e_name'],1,0,'C');
              $pdf->Cell(40,10,$row['e_amont'],1,0,'C');
              $pdf->Cell(40,10,$row['e_desc'],1,1,'C');
            }

    
        $pdf->Output();
           
 
?>