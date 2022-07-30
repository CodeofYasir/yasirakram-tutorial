<?php
     require './lib/fpdf.php'; 
     include 'server.php';
    
    if(isset($_POST['e_pdf'])){
        $pdf = new FPDF();
        $pdf->AliasNBPages();
        $pdf->AddPage('L','A4',0);


        $pdf->SetFont('Arial','B',22);
        $pdf->setTextColor(252, 3, 3);
        $pdf->Cell(276,5,'EXPENSES DATA',0,0,'C');
        $pdf->SetFont('Arial','B',14);
        $pdf->Ln();                         


        $pdf->setTextColor(0, 0, 0);
        $pdf->Cell(32,10,"Date:",0,0,'C');
        $pdf->Cell(10,10,date("j-n-Y"),0,1,'C');
    
        // table header
        $pdf->setTextColor(0, 0, 0);
        $pdf->SetFont('Arial','B',12);
        $pdf->setLeftMargin(20);

        $pdf->Cell(15,10,'ID',1,0,'C');
        $pdf->Cell(35,10,'TYPE',1,0,'C');
        $pdf->Cell(20,10,'AMOUNT',1,0,'C');
        $pdf->Cell(190,10,'DESCRIPTIO',1,1,'L');
        // table rows
        $pdf->SetFont('Arial','',14);
        
         
        $result = mysqli_query($db, "SELECT * FROM expenses WHERE u_id = '$u_id'");
        if($result)
            $i=0;
            while($row = mysqli_fetch_array($result))
            {
              $pdf->Cell(15,10,++$i,1,0,'C');
              $pdf->Cell(35,10,$row['e_name'],1,0,'C');
              $pdf->Cell(20,10,$row['e_amont'],1,0,'C');
              $pdf->Cell(190,10,$row['e_desc'],1,1,'L');
            }

        $pdf->Output();        
    }


    if(isset($_POST['l_pdf'])){
        $pdf = new FPDF();
        $pdf->AliasNBPages();
        $pdf->AddPage('L','A4',0);
        
        
        $pdf->SetFont('Arial','B',22);
        $pdf->setTextColor(252, 3, 3);
        $pdf->Cell(276,5,'LENDER DATA',0,0,'C');
        $pdf->SetFont('Arial','B',14);
        $pdf->Ln();                         


        $pdf->setTextColor(0, 0, 0);
        $pdf->Cell(23,10,"Date:",0,0,'C');
        $pdf->Cell(15,10,date("j-n-Y"),0,1,'C');
    
        // table header
        $pdf->setTextColor(0, 0, 0);
        $pdf->SetFont('Times','B',12);
        $pdf->setLeftMargin(15);
        $pdf->Cell(15,10,'ID',1,0,'C');
        $pdf->Cell(35,10,'NAME',1,0,'C');
        $pdf->Cell(20,10,'AMOUNT',1,0,'C');
        $pdf->Cell(23,10,'C DATE',1,0,'C');
        $pdf->Cell(23,10,'R DATE',1,0,'C');
        $pdf->Cell(150,10,'DESCRIPTION',1,0,'L');
        $pdf->Ln();                         
    
        $result = mysqli_query($db, "SELECT * FROM lender WHERE u_id = '$u_id'");
        if($result)
            $i=0;
            while($row = mysqli_fetch_array($result))
            {
                $pdf->SetFont('Times','B',12);
                $pdf->setLeftMargin(15);
                $pdf->Cell(15,10,++$i,1,0,'C');
                $pdf->Cell(35,10,$row['l_name'],1,0,'C');
                $pdf->Cell(20,10,$row['l_amont'],1,0,'C');
                $pdf->Cell(23,10,$row['l_cdate'],1,0,'C');
                $pdf->Cell(23,10,$row['l_rdate'],1,0,'C');
                $pdf->Cell(150,10,$row['l_desc'],1,0,'L');
                $pdf->Ln();  

            }            

        $pdf->Output();
    }
     
    if(isset($_POST['b_pdf'])){
        $pdf = new FPDF();
        $pdf->AliasNBPages();
        $pdf->AddPage('L','A4',0);
        
        
        $pdf->SetFont('Arial','B',22);
        $pdf->setTextColor(252, 3, 3);
        $pdf->Cell(276,5,'BORROWER DATA',0,0,'C');
        $pdf->SetFont('Arial','B',14);
        $pdf->Ln();                         
                               


        $pdf->setTextColor(0, 0, 0);
        $pdf->Cell(23,10,"Date:",0,0,'C');
        $pdf->Cell(15,10,date("j-n-Y"),0,1,'C');
    
        // table header
        $pdf->setTextColor(0, 0, 0);
        $pdf->SetFont('Times','B',12);
        $pdf->setLeftMargin(15);
        $pdf->Cell(15,10,'ID',1,0,'C');
        $pdf->Cell(35,10,'NAME',1,0,'C');
        $pdf->Cell(20,10,'AMOUNT',1,0,'C');
        $pdf->Cell(23,10,'C DATE',1,0,'C');
        $pdf->Cell(23,10,'R DATE',1,0,'C');
        $pdf->Cell(150,10,'DESCRIPTION',1,0,'L');
        $pdf->Ln();                         
    
        $result = mysqli_query($db, "SELECT * FROM borrow WHERE u_id = '$u_id'");
        if($result)
            $i=0;
            while($row = mysqli_fetch_array($result))
            {
                $pdf->SetFont('Times','B',12);
                $pdf->setLeftMargin(15);
                $pdf->Cell(15,10,++$i,1,0,'C');
                $pdf->Cell(35,10,$row['b_name'],1,0,'C');
                $pdf->Cell(20,10,$row['b_amount'],1,0,'C');
                $pdf->Cell(23,10,$row['b_cdate'],1,0,'C');
                $pdf->Cell(23,10,$row['b_rdate'],1,0,'C');
                $pdf->Cell(150,10,$row['b_desc'],1,0,'L');
                $pdf->Ln();  

            }            

        $pdf->Output();
    }

    if(isset($_POST['i_pdf'])){
        $pdf = new FPDF();
        $pdf->AliasNBPages();
        $pdf->AddPage('L','A4',0);
        
        
        $pdf->SetFont('Arial','B',22);
        $pdf->setTextColor(252, 3, 3);
        $pdf->Cell(276,5,'INVESTMENT DATA',0,0,'C');
        $pdf->SetFont('Arial','B',14);
                            
        $pdf->Ln();                         


        $pdf->setTextColor(0, 0, 0);
        $pdf->Cell(23,10,"Date:",0,0,'C');
        $pdf->Cell(15,10,date("j-n-Y"),0,1,'C');
    
        // table header
        $pdf->setTextColor(0, 0, 0);
        $pdf->SetFont('Times','B',12);
        $pdf->setLeftMargin(15);
        $pdf->Cell(15,10,'ID',1,0,'C');
        $pdf->Cell(35,10,'NAME',1,0,'C');
        $pdf->Cell(25,10,'AMOUNT',1,0,'C');
        $pdf->Cell(23,10,'C DATE',1,0,'C');
        $pdf->Cell(168,10,'DESCRIPTION',1,0,'L');
        $pdf->Ln();                         
    
        $result = mysqli_query($db, "SELECT * FROM investment WHERE u_id = '$u_id'");
        if($result)
            $i=0;
            while($row = mysqli_fetch_array($result))
            {
                $pdf->SetFont('Times','B',12);
                $pdf->setLeftMargin(15);
                $pdf->Cell(15,10,++$i,1,0,'C');
                $pdf->Cell(35,10,$row['i_name'],1,0,'C');
                $pdf->Cell(25,10,$row['i_amount'],1,0,'C');
                $pdf->Cell(23,10,$row['i_cdate'],1,0,'C');
                $pdf->Cell(168,10,$row['i_desc'],1,0,'L');
                $pdf->Ln();  

            }            

        $pdf->Output();
    }
 
    if(isset($_POST['inc_pdf'])){
        $pdf = new FPDF();
        $pdf->AliasNBPages();
        $pdf->AddPage('L','A4',0);
        
        
        $pdf->SetFont('Arial','B',22);
        $pdf->setTextColor(252, 3, 3);
        $pdf->Cell(276,5,'INCOME DATA',0,0,'C');
        $pdf->SetFont('Arial','B',14);
                                
        $pdf->Ln();                         


        $pdf->setTextColor(0, 0, 0);
        $pdf->Cell(23,10,"Date:",0,0,'C');
        $pdf->Cell(15,10,date("j-n-Y"),0,1,'C');
    
        // table header
        $pdf->setTextColor(0, 0, 0);
        $pdf->SetFont('Times','B',12);
        $pdf->setLeftMargin(15);
        $pdf->Cell(15,10,'ID',1,0,'C');
        $pdf->Cell(35,10,'NAME',1,0,'C');
        $pdf->Cell(25,10,'AMOUNT',1,0,'C');
        $pdf->Cell(23,10,'C DATE',1,0,'C');
        $pdf->Cell(168,10,'DESCRIPTION',1,0,'C');
        $pdf->Ln();                         
    
        $result = mysqli_query($db, "SELECT * FROM income WHERE u_id = '$u_id'");
        if($result)
            $i=0;
            while($row = mysqli_fetch_array($result))
            {
                $pdf->SetFont('Times','B',12);
                $pdf->setLeftMargin(15);
                $pdf->Cell(15,10,++$i,1,0,'C');
                $pdf->Cell(35,10,$row['inc_name'],1,0,'C');
                $pdf->Cell(25,10,$row['inc_amount'],1,0,'C');
                $pdf->Cell(23,10,$row['inc_cdate'],1,0,'C');
                $pdf->Cell(168,10,$row['inc_desc'],1,0,'C');
                $pdf->Ln();  

            }            

        $pdf->Output();
    }    
?>