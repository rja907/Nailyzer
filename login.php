
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Sign-Up/Login Form</title>
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body background='img/header.jpg' >
  <div class="form">
      
      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Sign Up</a></li>
        <li class="tab"><a href="#login">Log In</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">   
          <h1>Sign Up for Free</h1>
          
          <form action="" method="post">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                First Name<span class="req">*</span>
              </label>
              <input type="text" name='fname' required autocomplete="off" />
            </div>
        
            <div class="field-wrap">
              <label>
                Last Name<span class="req">*</span>
              </label>
              <input type="text" name='lname' required autocomplete="off"/>
            </div>
          </div>

          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email" name='mail' required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Set A Password<span class="req">*</span>
            </label>
            <input type="password" name='pass' required autocomplete="off"/>
          </div>
          
          <input type="submit" value='SignUp' class="button button-block" name='signup' />
          
          </form>

        </div>
        
        <div id="login">   
          <h1>Welcome Back!</h1>
          
          <form action="" method="post">
          
            <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email" name='mailid' required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" name='passw' required autocomplete="off"/>
          </div>
          
          <p class="forgot"><a href="#">Forgot Password?</a></p>
          
          <input type='submit' name='login' value='Login' class="button button-block"/>

        </div>
        
      </div><!-- tab-content -->
      
       <?php
      
      require_once 'db/db_config.php';
      $db_link=Connect_DB();
      $flag1=0;
      $flag2=0;
      $flag=0;
      if(isset($_POST['signup']))
      { 
        if(empty($_POST['mail'])||empty($_POST['pass']))
          {$flag=1;}
        else
        {
        $fname=$_POST['fname'];    
        $lname=$_POST['lname'];
        $mail=$_POST['mail'];
        $pass=md5($_POST['pass']);
        $query="SELECT mailid from users";
        if($query_run=mysqli_query($db_link,$query))
          {
            while($row=mysqli_fetch_assoc($query_run))
                {
                if($mail==$row['mailid'])
                  $flag=2;

                  
                }
          if($flag==1)
            echo "<div class='field-wrap'>
              <label>Invalid email or password.
              </label>
              </div>";
          if($flag==2)
            echo "<div class='field-wrap'>
              <label>Email id already exists
              </label>
              </div>";
          if($flag==0)
          {
          $query="INSERT into users(fname,lname,mailid,pass) VALUES('$fname','$lname','$mail','$pass')";      
           if($query_run=mysqli_query($db_link,$query))
              {
              echo "<div class='field-wrap'>
              <label>
              Account Created!  ------Click on login <span class='req'></span>
              </label>
              </div>";
              }
          }
      }
      }
      }
      if(isset($_POST['login']))
      {
        if(empty($_POST['mailid'])||empty($_POST['passw']))
          echo "Please fill in the details";
        else
        {
          $mailid=$_POST['mailid'];
          $passw=$_POST['passw'];
          $passw=md5($passw);
          
          $query="SELECT * FROM users where pass='$passw' AND mailid='$mailid'";
          if($result=mysqli_query($db_link,$query))
          {
            if($row=mysqli_fetch_assoc($result))
          {
            $fname=$row['fname'];
            $mail=$row['mailid'];
            $pass=$row['pass'];
            $_SESSION['name']=$fname;
            
            header("location:index2.php");
          }
          }
          else
          echo "Invalid username or password.";
        }
      }
      ?>
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
