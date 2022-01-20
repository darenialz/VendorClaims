<?php
    
    $conn = mysqli_connect('localhost', 'root', '', 'bank');

    if(isset($_POST['delete'])){
        
        $delete = mysqli_real_escape_string($conn, $_POST['toDelete']);
        $sequel = "DELETE FROM problem WHERE id = $delete";
        
        if(mysqli_query($conn, $sequel)){
            header('Location: adminsystem.php');
        }
        else {
            echo 'query error: ' . mysqli_error($conn);
        }
    }


//function query
function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    
    return $rows;
}


//function search
function search($keyword){
    $query = "SELECT id, vendor, orlig, quotation, date, location, GROUP_CONCAT(problems) AS Problem, GROUP_CONCAT(unit) AS unit, GROUP_CONCAT(price) AS price, GROUP_CONCAT(total) AS total, details FROM problem WHERE orlig = '$keyword' GROUP BY orlig ORDER BY quotation";
    
    return $query;
}


//function calculate for search
function calculate($keyword){
    $query = "SELECT * FROM problem WHERE vendor = '$keyword'";
    
    return $query;
}


//function edit
function edit($edit){
    global $conn;
    
    $id = $edit['id'];
    $vendor = $_POST['vendor'];
    $orlig = $_POST['orlig'];
    $quotation = $_POST['quotation'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $details = $_POST['details'];

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
                
                $sql = "UPDATE problem SET vendor = '$vendor', orlig = '$orlig', quotation = '$quotation', date = '$date', location = '$location', details = '$details', price = '$prices', unit = '$units', problems = '$problems', total = '$total' WHERE id = $id";
                
                mysqli_query($conn, $sql);
                
            }
        } 
        
    }
    
    return mysqli_affected_rows($conn);
    
}


//function register

function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn,$data["password"]);
    $password2 = mysqli_real_escape_string($conn,$data["password2"]);
    $email = strtolower(stripslashes($data["email"]));


//cek username sudah ade atau belum
$result = mysqli_query($conn,"SELECT username FROM users WHERE username = '$username'");

if($result == true){
    if(mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username sudah terdaftar!')
        </script>";
        return false;
    }
}
    


//cek konfirmasi password
if( $password !== $password2) {

    echo "<script>
            alert('konfirmasi password tidak sesuai!');
          </script>";
    return false;
    } 

//enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    


//tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO users VALUES('','$username','$password','$email')");

    return mysqli_affected_rows($conn);
}

?>