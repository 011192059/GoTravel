<?php
/*
step 1: to receive the email and password data from register.php
step 2: to store the data within the database
step 3: if data store is successful then forward to login.php
        else forward to register.php
*/

session_start();

if(
    isset($_SESSION['username'])
    && !empty($_SESSION['username']) )
   
    {

    
    $username = $_SESSION['username'];


    if($_SERVER['REQUEST_METHOD']=='POST'){

        if(isset($_POST['myname'])
        && isset($_POST['contact'])
        && isset($_POST['country'])
        && isset($_POST['district'])
        && isset($_POST['city'])
        && isset($_POST['address'])
        && isset($_POST['NID_Number'])
        && isset($_POST['Passport_Number'])

            && !empty($_POST['myname'])
            && !empty($_POST['contact'])
            && !empty($_POST['country'])
            && !empty($_POST['district'])
            && !empty($_POST['city'])
            && !empty($_POST['address'])
            && !empty($_POST['NID_Number'])
            && !empty($_POST['Passport_Number'])
            )
            {

                $name=$_POST['myname'];
                $contact=$_POST['contact'];
                $country=$_POST['country'];
                $district=$_POST['district'];
                $city=$_POST['city'];
                $address=$_POST['address'];
                $NID_Number=$_POST['NID_Number'];
                $Passport_Number=$_POST['Passport_Number'];


                    ///store the data to database
                try{
                    // PHP Data Object
                    $conn=new PDO("mysql:host=localhost:3306;dbname=go_travel;","root","");
                    ///setting 1 environment variable
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                if( isset($_POST['oldpass'])
                    && isset($_POST['mypass'])
                    && !empty($_POST['oldpass'])
                    && !empty($_POST['mypass'])
                ){
                    $oldpass=$_POST['oldpass'];
                    $pass=$_POST['mypass'];

                    // $enc_password = md5($oldpass);
                    // $new_enc_password = md5($pass);

                    $myquery="SELECT * FROM user WHERE username = '".$username."' and password ='pass'";

                    $returnobj = $conn->query($myquery);  // the return object is pdo statement object

                    if($returnobj->rowCount() == 1){

                        ///executing mysql query
                        // if($role == 'user'){
                        //   $signupquery="UPDATE ".$role." SET Name='$name', password='$new_enc_password', Contact_no=$contact, Country='$country', District='$district', City='$city' ,Address='$address', NID_Number=$NID_Number, Passport_Number=$Passport_Number WHERE ".$role[0]."_username='$username'";

                        //   $conn->exec($signupquery);
                        // }
                        // else{
                        //   $signupquery="UPDATE ".$role." SET Name='$name', password='$new_enc_password', Contact_no=$contact, Country='$country',District='$district', City='$city',Address='$address', NID_Number=$NID_Number, Passport_Number=$Passport_Number WHERE ".$role[0]."_username='$username'";
                          $signupquery="UPDATE  SET Name='$name', password='$pass', Contact_no=$contact, Country='$country', District='$district', City='$city' ,Address='$address', NID Number=$NID_Number, Passport Number=$Passport_Number WHERE username='$username'";
                          $conn->exec($signupquery);
                        }


                        ?>
                        <script>alert("Profile Updated!");</script>
                        <script>location.assign("login.php");</script>
                        <?php
                    }

                

                // if($role == 'user'){
                //   $signupquery="UPDATE ".$role." SET Name='$name', Contact_no=$contact, Country='$country', District='$district', City='$city',Address='$address',NID_Number=$NID_Number,Passport_Number=$Passport_Number WHERE ".$role[0]."_username='$username'";

                //   $conn->exec($signupquery);
                // }
                // else{
                //   $signupquery="UPDATE ".$role." SET Name='$name', Contact_no=$contact, Country='$country',District='$district', City='$city',Address='$address',NID_Number=$NID_Number,Passport_Number=$Passport_Number WHERE ".$role[0]."_username='$username'";

                //   $conn->exec($signupquery);
                // }

                $signupquery="UPDATE SET Name='$name', Contact_no=$contact, Country='$country', District='$district', City='$city',Address='$address',NID_Number=$NID_Number,Passport_Number=$Passport_Number WHERE username='$username'";

                  $conn->exec($signupquery);
                ?>
                    <script>alert("Profile Updated!");</script>
                    <script>location.assign("profile.php");</script>
                <?php






                }
                catch(PDOException $ex){
                    ?>
                        <script>alert("Database Error!");</script>
                        <script>location.assign("updateprofile.php");</script>
                    <?php
                }

                }

                else{
                ///if email and password data is empty or not set
                /// register.php --> registeruser.php --> register.php
                ?>
                <script>alert("Fill up all required fields!");</script>
                <script>location.assign("updateprofile.php");</script>
                <?php

                }

            }
            else{
                ///if email and password data is empty or not set
                /// register.php --> registeruser.php --> register.php
                ?>
                <script>location.assign("updateprofile.php");</script>
                <?php

            }

    }

?>