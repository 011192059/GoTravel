<?php
session_start();
if(
    isset($_SESSION['username'])
    && !empty($_SESSION['username'])
   
)
{
   
    $username = $_SESSION['username'];
    ?>

    <!DOCTYPE html>

    <html lang="en">
        <head>
        <title>Update Profile</title>
        <style>

            body {
            background-color: lightblue;
            }

            .text{

            height: 25px;
            border-radius: 5px;
            padding: 2px;
            border: solid thin #aaa;
            width: 90%;
            }


            #button{

            padding: 10px;
            width: 120px;
            color: white;
            background-color: #010d31;
            border: none;
            }

            #box{

            background-color: AliceBlue;
            margin: auto;
            width: 300px;
            padding: 20px;
            }


                                .text{
                                    height: 25px;
                                    border-radius: 5px;
                                    padding: 2px;
                                    border: solid thin #aaa;
                                    width: 90%;
                                }

                                .header {
                                  background-color: #333;
                                  overflow: hidden;
                                }

                                .header left {
                                  float: left;
                                  color: #f2f2f2;
                                  text-align: center;
                                  padding: 14px 16px;
                                  text-decoration: none;
                                  font-size: 30px;
                                }

                                .header right {
                                  float: right;
                                  color: #f2f2f2;
                                  text-align: center;
                                  padding: 14px 16px;
                                  text-decoration: none;
                                  font-size: 20px;
                                }

        </style>
        </head>

        <body>

          <h1 class="header">
            <left>GoTravel</left>
            <right>
              <!-- <input id="button" type="button" value="Home Page" onclick="home()"> -->
              <!-- <input id="button" type="button" value="My Notifications" onclick="notification()"> -->
              
              <input type="button" id="button" value="Logout" onclick="logout();">
            </right>

          </h1>



        <br>
        <div id="box"style="font-size: 20px;margin: 10px;"><b>Welcome </b><?php echo $username?>





        <?php

        try{
            // PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=go_travel;","root","");
            ///setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            ///executing mysql query
            $signupquery="SELECT * FROM user WHERE username = '$username'";


            $returnobj = $conn->query($signupquery);
            $returntable = $returnobj->fetchAll();

            if($returnobj->rowCount() == 1)
            {
                foreach($returntable as $row){
                ?>


                <form action="updateprofileProcess.php" method="POST">
                <br>

                <label for="myname">Name</label>:
                <input class="text" type="text" id="myname" name="myname" value="<?php echo $row['Name'];?>">

                <br>

                <label for="oldpass">Old Password</label>:
                <input class="text" type="password" id="oldpass" name="oldpass" placeholder=" fill it if changing the password">

                <br>

                <label for="mypass">New Password</label>:
                <input class="text" type="password" id="mypass" name="mypass" placeholder=" fill it if changing the password">

                <br>

        

                <label for="contact">Contact No</label>:
                <input class="text" type="number" id="contact" name="contact" value="<?php echo "0".$row['Contact_no'];?>">

                <br>


                <br>
                <label for="country"><b>Country</b></label>:
    <select class="text" id="country" name="country" onchange="selectcountry()">
        <option selected="selected" value="<?php echo $row['District'];?>"><?php echo $row['District'];?></option>
        <option value="Bangladesh">Bangladesh</option>
        <option value="India">India</option>
        <option value="UK">UK</option>
        <option value="USA">USA</option>
        <option value="China">China</option>
    </select>
    <br>
                <label for="district">District</label>:
                <select class="text" id="input" name="district" onchange="selectCity()">
                  <option selected="selected" value="<?php echo $row['District'];?>"><?php echo $row['District'];?></option>
                  <option value="Dhaka">Dhaka</option>
                  <option value="Chittagong">Chittagong</option>
                  <option value="Rajshahi">Rajshahi</option>
                  <option value="Sylhet">Sylhet</option>
                  <option value="Khulna">Khulna</option>
                </select>

                <div>
                <label for="city">City</label>:
                <select class="text" name="city" id="output">
                    <option selected="selected" value="<?php echo $row['City'];?>"><?php echo $row['City'];?></option>
                </select>
                </div>

                <br>

                <label for="address">Address</label>:
                <input class="text" type="text" id="address" name="address" value="<?php echo $row['Address'];?>">

                <br>
                <br>

                <label for="NID_Number">NID Number</label>:
                <input class="text" type="text" id="NID Number" name="NID_Number" value="<?php echo $row['NID Number'];?>">

                <br>
                <label for="Passport_Number">Passport Number</label>:
                <input class="text" type="text" id="Passport Number" name="Passport_Number" value="<?php echo $row['Passport Number'];?>">

                <br> <br>
                <input id="button" type="submit" value="Save Changes">
                <input id="button" type="button" value="Back" onclick="profile()">
                <br><br>
                <input id="button" type="button" value="Delete Account" onclick="deletefn();">

                </form>

                <?php

            }
            }
        }
        catch(PDOException $ex){
            ?>
                <script>location.assign("login.php");</script>
            <?php
        }

        ?>
        </div>

        <br>





        <br>

        <script>
                    // function home(){
                    //     location.assign('home.php');   ///default GET method
                    // }

                    function profile(){
                        location.assign('profile.php');   ///default GET method
                    }
                    function logout(){
                        location.assign('logout.php');   ///default GET method
                    }
                    function deletefn(){
                        ///for multiple values: file.php?varname=value&var1=value1
                        location.assign('deleteprofile.php');
                    }
                    function selectCity(){
                        var a=document.getElementById("district").value;
                        if(a === "Dhaka")
                        {
                            var arr=["Mohammadpur","Mirpur","Badda", ];
                        }
                        else if(a === "Chittagong")
                        {
                            var arr=["Pahartali","Chawk Bazar", "Patenga"];
                        }
                        else if(a === "Rajshahi")
                        {
                            var arr=["Shaheb Bazar","Chhota Banagram", "Shiroil"];
                        }
                        else if(a === "Sylhet")
                        {
                            var arr=["coming soon"];
                        }
                        else if(a === "Khulna")
                        {
                            var arr=["coming soon"];
                        }

                        var string="";

                        for(i=0;i<arr.length;i++)
                        {
                            string=string+"<option value="+arr[i]+">"+arr[i]+"</option>";
                        }
                        document.getElementById("output").innerHTML=string;
                    }




        </script>



        </body>
    </html>

    <?php
}
else
{
    ?>
            <script>location.assign("login.php");</script>
    <?php
}

?>