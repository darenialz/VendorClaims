<?php 

require('function.php');

//take id data from url
$id = $_GET['id'];

$edit = query("SELECT * FROM problem WHERE id = $id")[0];

if(isset($_POST['submit'])){
    
    if(edit($_POST) > 0){
        echo "<script>
                alert('Data has been edited');
                document.location.href = 'adminsystem.php';
            </script>
        ";
    } else {
        echo "<script>
                alert('Failed to edit');
                document.location.href = 'adminsystem.php';
            </script>
        ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Register</title>
    
    
    <style>
        /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

body{
    display: flex;
    flex-direction: column;
    align-items: center;
}

table{
    border: 1px solid black;
    padding: 25px;
    width: 50vw;
    background-color: #E2E5DE;
}

td:nth-child(1){
    width: 25%;

}

input[type=text], input[type=date], input[type=number]{
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit], button{
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input.united:nth-child(1){
    width: 20%;
    margin: 0 50px 0 10px;
}

input.united:nth-child(2){
    width: 20%;
    margin: 0 0 0 0px;
}

button.remove{
    width: 60%;
    background-color: blue;
    margin: 140px 0 0 50px;
}

input.unitednext{
    width: 100%;
    margin: 0 0 0 0px;
}

input.test{
    width: 410%;
}

td.spacing{
    width: 20%; 
    padding-top: 130px;
}
    </style>
</head>
<body>
    <h1>Edit</h1> <br>
    
    <form name="insert-data" id="insert-data" action="" method="post">
      <input type="hidden" name="id" value="<?= $edit["id"]; ?>">
       <table>
           <tr>
              <td>Vendor Name: </td>
               <td>
                   <input type="text" name="vendor" value="<?= $edit["vendor"]; ?>">
               </td>
           </tr>
           <tr>
              <td>No Orlig: </td>
               <td>
                   <input type="number" name="orlig" value="<?= $edit["orlig"]; ?>">
               </td>
           </tr>
           <tr>
              <td>No Quotation: </td>
               <td>
                   <input type="text" name="quotation" value="<?= $edit["quotation"]; ?>">
               </td>
           </tr>
           <tr>
              <td>Date: </td>
               <td>
                   <input type="date" name="date" value="<?= $edit["date"]; ?>">
               </td>
           </tr>
           <tr>
              <td>Location: </td>
               <td>
                   <input type="text" name="location" value="<?= $edit["location"]; ?>">
               </td>
           </tr>
           <tr>
              <td>Problem: </td>
               <td>
                   <input type="text" name="problem[]" value="<?= $edit["problems"]; ?>">
               </td>
           </tr>
           <tr>
              <td></td>
               <td>
                   Unit: <input class="united" type="number" name="unit[]" value="<?= $edit["unit"]; ?>">
                   Price (RM): <input class="united" type="number" name="price[]" value="<?= $edit["price"]; ?>">
               </td>
           </tr>
           <tr id="dynamic">
               <td>Additional Problems:</td>
           </tr>
           <tr>
              <td></td>
               <td>
                   <button name="add" id="add">Add Problems</button>
               </td>
           </tr>
           <tr>
              <td>Details: </td>
               <td>
                   <input type="text" name="details" value="<?= $edit["details"]; ?>">
               </td>
           </tr>
           <tr>
               <td></td>
               <td>
                   
                   <input type="submit" value="Submit" name="submit" id="submit">
               </td>
           </tr>
       </table>
        
    </form>
    
</body>
</html>


<script>
    $(document).ready(function(){
        var i = 1;
        $('#add').click(function(){
            i++;
            $('#dynamic').append('<tr id="row'+i+'"><td><input class="test" type="text" name="problem[]" required></td><td class="spacing">Unit: <input class="unitednext" type="number" name="unit[]" ></td><td class="spacing">Price (RM): <input class="unitednext" type="number" name="price[]" ></td><td><button name="remove" id="'+i+'" class="remove">Remove</button></td></tr>');
        });
        
        $(document).on('click', '.remove', function(){
            var button_id = $(this).attr("id");
            $("#row"+button_id+"").remove();
        });
        
        
        
    });
</script>