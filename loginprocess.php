<?php
/*
    1. collect the data from login.php page
    2. encrypt the collected password
    3. match the collected data with the database data
    4. if match, we will forward to the home page
    5. if not found, we'll forward to log in page
*/

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(
        isset($_POST['username'])
        && isset($_POST['mypass'])
        && !empty($_POST['username'])
        && !empty($_POST['mypass'])
    ){

        $username=$_POST['username'];
        $pass=$_POST['mypass'];
        

        try{
            // PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=go_travel;","root","");
            ///setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // $enc_password = md5($pass);
            // $enc_password = '1234';

            $myquery="SELECT * FROM user WHERE username = '$username' and password ='$pass'";


            $returnobj = $conn->query($myquery);  // the return object is pdo statement object

            if($returnobj->rowCount() == 1){
                session_start();
                $_SESSION['username'] = $username;
                ?><script>window.location.assign("profile.php");</script><?php
               
            }
            else {
            ?>
                <script>alert("Wrong username and password.");</script>
                <script>window.location.assign("login.php");</script>
            <?php
            }

            }
            catch(PDOException $ex){
                ?>
                    <script>alert("Database error.");</script>
                    <script>window.location.assign("login.php");</script>
                <?php
            }
        }

    else
    {
        ?>
        <script>alert("Fill up all the information.");</script>
        <script>location.assign("login.php");</script>
    <?php
    }

}
else
{
    ?>
        <script>location.assign("login.php");</script>
    <?php
}


?>