<?php
     require './lib/fpdf.php';
     include 'conn.php';
     include 'server.php';
     
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->setTextColor(252, 3, 3);
        $pdf->Cell(175,20,'Expenses Data',0,1,'C');
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
        
        // $host="localhost";
        // $password="";
        // $dbname="khata";
        // $user="root";
        // $con = new PDO("mysql:host = $host;dbname=$dbname","$user",$password);

        // $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        // $cleardb_server = $cleardb_url["host"];
        // $cleardb_username = $cleardb_url["user"];
        // $cleardb_password = $cleardb_url["pass"];
        // $cleardb_db = substr($cleardb_url["path"],1);
        // $active_group = 'default';
        // $query_builder = TRUE;
        // $con = new PDO("mysql:host = $cleardb_server;dbname= $cleardb_db","$cleardb_username","$cleardb_password");


        // $query ="SELECT * FROM expenses WHERE u_id = '$u_id'";
        // $result = $con->prepare($query);
        // $result->execute();
        // if($result)
        //     $i=0;
        //     while($row = $result->fetch())
        //     {
        //       $pdf->Cell(20,10,++$i,1,0,'C');
        //       $pdf->Cell(40,10,$row['e_name'],1,0,'C');
        //       $pdf->Cell(40,10,$row['e_amont'],1,0,'C');
        //       $pdf->Cell(40,10,$row['e_desc'],1,1,'C');
        //     }

    
        $pdf->Output();
           
 
?>