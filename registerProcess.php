<?php
/*
step 1: to receive the email and password data from register.php
step 2: to store the data within the database
step 3: if data store is successful then forward to login.php
        else forward to register.php
*/


if($_SERVER['REQUEST_METHOD']=='POST'){

    if(   isset($_POST['username'])
       && isset($_POST['mypass'])
       && isset($_POST['myname'])
       && isset($_POST['contact'])
       && isset($_POST['country'])
       && isset($_POST['district'])
       && isset($_POST['city'])
       && isset($_POST['address'])
       && isset($_POST['NID_Number'])
       && isset($_POST['Passport_Number'])

       && !empty($_POST['username'])
       && !empty($_POST['mypass'])
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
        $username=$_POST['username'];
        $pass=$_POST['mypass'];
        $name=$_POST['myname'];
        $contact=$_POST['contact'];
        $country=$_POST['country'];
        $district=$_POST['district'];
        $city=$_POST['city'];
        $address=$_POST['address'];
        $NID_Number=$_POST['NID_Number'];
        $Passport_Number=$_POST['Passport_Number'];
        $Joining_Date=date('d-m-y');


            ///store the data to database
        try{
            // PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=go_travel;","root","");
            ///setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $signupquery="SELECT * FROM user WHERE username = '".$username."'";


            $returnobj = $conn->query($signupquery);
            $returntable = $returnobj->fetchAll();

            if($returnobj->rowCount() == 1)
            {
                ?>
                <script>alert("username already exists.");</script>
                <script>location.assign("register.php");</script>
                <?php
            }
            else
            {
                // $enc_password = md5($pass);

               
                $signupquery="INSERT INTO user VALUES(Null, '$username','$pass','$name',$Passport_Number, '$country','$city',$NID_Number,$contact,Null,'$address',$Joining_Date,'$district')";
                // $signupquery="INSERT INTO user VALUES(Null, 'Taru','$enc_password','fdff',$Passport_Number, 'dddd','dddd',$NID_Number,$contact,Null,'ccffc',Null,'ddddd')";

                $conn->exec($signupquery);

                ?>
                <script>alert("Registration Successful.\nNow login!");</script>
                <script>location.assign("login.php");</script>
                <?php
            }

            }
            catch(PDOException $ex){
            ?>
                <script>alert("Database Error.\n");</script>
                <script>location.assign("register.php");</script>
            <?php
            }

        }

        else{
        ///if email and password data is empty or not set
        /// register.php --> registeruser.php --> register.php
        ?>
        <script>alert("Fill up all the information.");</script>
        <script>location.assign("register.php");</script>
        <?php

        }

    }
    else{
        ///if email and password data is empty or not set
        /// register.php --> registeruser.php --> register.php
        ?>
        <script>location.assign("register.php");</script>
        <?php

        }


?>