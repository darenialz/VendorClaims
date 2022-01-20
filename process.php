<?php

    $vendor = $_POST['vendor'];
    $orlig = $_POST['orlig'];
    $quotation = $_POST['quotation'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $details = $_POST['details'];


    $conn = mysqli_connect('localhost', 'root', '', 'bank');
    $number = count($_POST["problem"]);

    if($number >= 1)
    {
        for($i=0; $i<$number; $i++)
        {
            if(trim($_POST["problem"][$i]) != '')
            {
                $problems = $_POST["problem"][$i];
                $units = $_POST["unit"][$i];
                $prices = $_POST["price"][$i];
                
                $total = $units * $prices;
                
                $sql = "INSERT INTO problem(vendor, orlig, quotation, date, location, problems, unit, price, total, details) VALUES ('$vendor', '$orlig', '$quotation', '$date', '$location', '$problems', '$units', '$prices', '$total', '$details')";
                mysqli_query($conn, $sql);
                
            }
        } 
        
        header('Location:register.php');
    }
    else{
        echo "Register First";
    }


?>