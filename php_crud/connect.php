<?php 
        $servername = "localhost";
        $username = "root";
        $password = "Renu#2022";
        $dbname = "phpform";
        $connect = mysqli_connect($servername,$username,$password,$dbname);

        if($connect) {
            echo "Connected";
        } else {
            echo "error";
        }
?>