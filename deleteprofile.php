<?php

session_start();
if(
    isset($_SESSION['username'])
    && !empty($_SESSION['username'])
    )
{
    
    $username = $_SESSION['username'];


        try{
            ///PDO = PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=go_travel;","root","");
            ///setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            ///mysql query string
            $mysqlquerystring="SET foreign_key_checks = 0;
            DELETE FROM user WHERE username = '$username';
            SET foreign_key_checks = 1;";


            $conn->exec($mysqlquerystring);
            unset($_SESSION['username']);
            
            session_destroy();

            ?>
            <script>alert("Account deleted successfully!");</script>
            <script>location.assign("login.php");</script>
            <?php
        }
        catch(PDOException $ex){
            ?>
                <script>location.assign("login.php");</script>
            <?php
        }

    }
    else{
        ?>
            <script>location.assign("updateprofile.php");</script>
        <?php
    }


?>