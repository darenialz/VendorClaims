<?php 

require('function.php');

//display table
$sql = "SELECT id, vendor, orlig, quotation, date, location, GROUP_CONCAT(problems) AS Problem, GROUP_CONCAT(unit) AS unit, GROUP_CONCAT(price) AS price, GROUP_CONCAT(total) AS total, details FROM problem GROUP BY vendor ORDER BY quotation";

//calculation
$sql2 = "SELECT * FROM problem";

if(isset($_POST['search'])){
    $sql = search($_POST['keyword']);
    $sql2 = calculate($_POST['keyword']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Claims</title>
    
    <style>
        body{
            width: 100vw;
            height: 100vh;
            background-color: #E2E5DE;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        
        #logout{
            position: absolute;
            top: 20px;
            right: 30px;
        }
        
        table, th, td, tr{
            border: 1px solid black;
            border-collapse: collapse;
            padding: 15px 10px 15px 10px;
        }
        
        .btn-approve{
            border: 1px solid white;
            background-color: #95F985;
            border-radius: 10%;
            color: black;
            padding: 7px 7px 7px 7px;
            text-decoration: none;
            margin: 0 10px 0 5px;
        }
        
        .btn-delete{
            border: 1px solid white;
            background-color: red;
            border-radius: 10%;
            color: black;
            padding: 7px 7px 7px 7px;
            text-decoration: none;
            margin: 0 5px 0 10px;
        }
        
        .btn-approve:hover{
            background-color: #90EE90;
        }
        
        .btn-delete:hover{
            background-color: #FFCCCB;
        }
        
    </style>
</head>
<body>
  <br>  <h1>Claims</h1> <br>
    
    <form action="" method="post">
        <input type="text" name="keyword" placeholder="Seach here..." autocomplete="off">
        <button type="submit" name="search">Search</button>
    </form> <br>
    
    <table>
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
                    
    <?php  
        
        //Execute the Query
        $res = mysqli_query($conn, $sql);
        $res2 = mysqli_query($conn, $sql2);

        //Check whether the Query is executed or not
        if($res==true){
            //Count rows to check whether we have data in database or not
            $count = mysqli_num_rows($res); //Function to get all the rows in database

            $sn = 1; //create a variable for id (auto increment)
            $totalprice = 0;
            $grandtotal = 0;

            //Check the num of rows
            if($count>0){
                
                
                //we have data in database
                while($rows = mysqli_fetch_assoc($res))
                {
                    //using while loop to get all the data from database
                    //and while loop will run as long as we have data in database

                    //get individual data
                    $id = $rows['id'];
                    $vendor = $rows['vendor'];
                    $orlig = $rows['orlig'];
                    $quotation = $rows['quotation'];
                    $date = $rows['date'];
                    $location = $rows['location'];
                    $problems = $rows['Problem'];
                    $unit = $rows['unit'];
                    $price = $rows['price'];
                    $total = $rows['total'];
                    $details = $rows['details'];
                    
                    while($special = mysqli_fetch_assoc($res2))
                    {
                        $specialtotal = $special['total'];
                        $grandtotal = $grandtotal + $specialtotal;
                    }
                    
                    

                    //display the values in our table
    ?>
                
            <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $vendor; ?></td>
                <td><?php echo $date; ?></td>
                <td><?php echo $quotation; ?></td>
                <td><?php echo $location; ?></td>
                <td><?php echo $orlig; ?></td>
                <td><?php echo str_replace(',', '<br /><br />', $rows['Problem']); ?></td>
                <td><?php echo $details; ?></td>
                <td><?php echo str_replace(',', '<br /><br />', $rows['unit']); ?></td>
                <td><?php echo str_replace(',', '<br /><br />', $rows['price']); ?></td>
                <td><?php echo str_replace(',', '<br /><br />', $rows['total']); ?></td>
                
                <td>
                    <!---------------------------DELETE FORM---------------------------->
                    <form action="adminsystem.php" method="post">
                        <a href="edit.php?id=<?= $rows['id']; ?>">Edit</a>
                        <input type="hidden" name="toDelete" value="<?php echo $rows['id'] ?>">
                        <input type="submit" name="delete" value="Delete" class="btn-delete">
                    </form>
                </td>
            </tr>
              
                    
                
                    

    <?php
                }
            }
        }
        else{
            echo "wrong database or table";
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
    
    <br>
    <a href="excel.php" target="_blank"><button>Export to Excel</button></a>
    <br>
    
</body>
</html>