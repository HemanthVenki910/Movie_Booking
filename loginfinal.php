<!DOCTYPE html>
<html>
<head>
  
  <?php
  $display=" ";
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
        $display=" ";
        extract($_POST);
        $db=mysqli_connect('localhost:3306','root','','MOVIEDATA');
        if(isset($db))
        {
          $create_table = "CREATE TABLE IF NOT EXISTS USERS (EMAIL VARCHAR(100),PHONENUMBER VARCHAR(100),PASSWORD VARCHAR(100),PRIMARY KEY (EMAIL));";
          $result_create_table = mysqli_query($db,$create_table);
          $str="SELECT * FROM USERS WHERE EMAIL='".$email."' AND PASSWORD='".$password."';";
          if($email!='' && $password!='')
          {
            $res=mysqli_query($db,$str);
            if(mysqli_num_rows($res)>=1)
            {
              header('Location:list.html');
            }
            else
             {
              $display="<br>&nbsp;&nbsp;Invalid Email or Password<br></br>";
            }
          }
          else {
            $display="Fill in all the Details<br></br>";
        }
      }
  }
  ?>
  <script type="text/javascript">
  <!--
  function func()
  {
    var email=document.getElementById('Email');
    var element=email.value;
    window.localStorage.setItem('Usermail',element);
    //document.write(email);
  }
  -->
  </script>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="login.css" />
    <script src=""></script>
</head>
<body style="background-color:black">
        <div id="container">


        <form id="form"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
              <h1>Login</h1>
              <hr>

            <div class="label">Email Id <br/>
            <input id="Email" type="text" placeholder="example123@email.com" name="email">
            </div>
            <br>
            <div class="label">Password <br/>
            <input id="Password"  type="password" placeholder="Enter Your Password Here" name="password" style="padding-left:1px;">
        </div>
            <br/>
            <hr>
            <span id="password" style="text-align:center;"><?php echo $display?></span>
            <br>
            <input onclick="func()" onmouseover="func()"type="submit" id="button1" value="SIGN-IN"></input>
            <br/>
            <br/>
            <br/> <a href="." style="";id ="signin" class="button">New User? Register Here</a>
            <br/>
            <br/>
        </div>

        </form>
    </div>

</body>
</html>
