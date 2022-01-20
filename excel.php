<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Export to Excel</title>
</head>
<body>
    <?php

    header('Content-Type: application/vnd-ms-excel');
    header('Content-disposition: attachment; filename=data.xls');

    ?>
    
    <center>Data Bank</center> <br>
    
    <table border="1">
       <tr>
           <th>No</th>
            <th>Vendor</th>
            <th>Date</th>
            <th>No Quotation</th>
            <th>Location</th>
            <th>No Orlig</th>
            <th>Problem</th>
            <th>Detail</th>
            <th>Unit</th>
            <th>Price (RM)</th>
            <th>Total (RM)</th>
       </tr>
       
       <?php
        
        $conn = mysqli_connect('localhost', 'root', '', 'bank');
        
        $sql = "SELECT id, vendor, orlig, quotation, date, location, GROUP_CONCAT(problems) AS Problem, GROUP_CONCAT(unit) AS unit, GROUP_CONCAT(price) AS price, GROUP_CONCAT(total) AS total, details FROM problem GROUP BY vendor"; 
        $sql2 = "SELECT * FROM problem"; 
        
        //Execute the Query
        $res = mysqli_query($conn, $sql);
        $res2 = mysqli_query($conn, $sql2);
        
        $sn = 1;
        $grandtotal = 0;
        
        while($rows = mysqli_fetch_assoc($res))
        {
            while($special = mysqli_fetch_assoc($res2))
            {
                $specialtotal = $special['total'];
                $grandtotal = $grandtotal + $specialtotal;
            }
        ?>
       
       <tr>
           <td><?php echo $sn++; ?></td>
            <td><?php echo $rows['vendor']; ?></td>
            <td><?php echo $rows['date']; ?></td>
            <td><?php echo $rows['quotation']; ?></td>
            <td><?php echo $rows['location']; ?></td>
            <td><?php echo $rows['orlig']; ?></td>
            <td><?php echo str_replace(',', '<br /><br />', $rows['Problem']); ?></td>
            <td><?php echo $rows['details']; ?></td>
            <td><?php echo str_replace(',', '<br /><br />', $rows['unit']); ?></td>
            <td><?php echo str_replace(',', '<br /><br />', $rows['price']); ?></td>
            <td><?php echo str_replace(',', '<br /><br />', $rows['total']); ?></td>
       </tr>
       <?php
        }
        ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><?php echo '<b><u>Grand Total: RM' . $grandtotal; '</u></b>'?></td>
        </tr> 
    </table>
    
</body>
</html>