<?php
require'function.php';

if(isset($_POST["register"])){

    if(registrasi($_POST) > 0 ){
        echo "<script>
            alert('user baru berhasil ditambahkan!');
        </script>";
    } else{
        echo mysqli_error($conn);
    }
}


?>





<!DOCTYPE html>
<html>
<head>
    <title>User Register Form</title>
    <style>
        label{
            display: block;
        }
    </style>

</head>
<body>

<h1> User Register Form </h1>

<form action="" method="post">
    <ul>
        <li>
            <label for="username":>Username : </label>
            <input type="text" name="username" id="username">
        </li>
        <li>
            <label for="password":>Password : </label>
            <input type="password" name="password" id="password">
        </li>
        <li>
            <label for="password2":>Konfirmasi password : </label>
            <input type="password" name="password2" id="password2">
        </li>
        <li>
            <label for="email":>Email : </label>
            <input type="text" name="email" id="email">
        </li><br>
        <li>
            <button type="submit" name="register"> Register! </button>
        </li>
    </ul>

</form>

</body>
</html>