<?php

    session_start();

    $error = "";  
    

    if (array_key_exists("logout", $_GET)) {
        
        unset($_SESSION);
        
        session_destroy();
        
    } else if ((array_key_exists("dusername", $_SESSION) AND $_SESSION['dusername'])) {

            header("Location: departmentloggedinpage.php"); 
    }

    if (array_key_exists("submit", $_POST)) {
        
        include("connection.php");
        
        if (!$_POST['username']) {
            
            $error .= "Username is required<br>";
            
        } 
        
        if (!$_POST['password']) {
            
            $error .= "A password is required<br>";
            
        } 
        
        if ($error != "") {
            
            $error = "<p>There were error(s) in your form:</p>".$error;
            
        } else {
            
            if ($_POST['login'] == '1') {
            
                $query = "SELECT * FROM `superuser` WHERE username = '".mysqli_real_escape_string($link, $_POST['username'])."'";
                
                    $result = mysqli_query($link, $query);
                
                    $row = mysqli_fetch_array($result);
                
                    if (isset($row)) {
                        
                         $hashedPassword = md5($row['id'].$_POST['password']);
                         echo $row['id'].$_POST['password'];
                         echo $hashedPassword."    ".$_POST['password'];
                        
                        if (strtoupper($hashedPassword) == $row['password']) {
                            
                            $_SESSION['dusername'] = $row['username'];
                            $_SESSION['department'] = $row["department"];

                            header("Location: departmentloggedinpage.php");
                                
                        } else {
                            
                            $error = "That username/password combination could not be found.";
                            
                        }
                        
                    } else {
                        
                        $error = "That username/password combination could not be found.";
                        
                    }  
                
            }
            
        }
        
        
    }


?>

<?php include("header.php"); ?>
      
      <div class="container" id="homePageContainer">
      
    <h1>AIKTC</h1>
          
          <p><strong>Manage Faculty And Student Date.</strong></p>
          
          <div id="error"><?php if ($error!="") {
    echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
    
} ?></div>

<form method="post" id = "departmentyLogIn">
    
    <p>Respected Department Admin, Please Enter Your Username And Password.</p>
    
    <fieldset class="form-group">

        <input class="form-control" type="text" name="username" placeholder="Username">
        
    </fieldset>
    
    <fieldset class="form-group">
    
        <input class="form-control" type="password" name="password" placeholder="Password" value="">
        
    </fieldset>
    
    <fieldset class="form-group">
    
        <input type="hidden" name="login" value="1">
        
        <input class="btn btn-success" type="submit" name="submit" value="Log In!">
        
    </fieldset>

</form>
          
      </div>

<?php include("footer.php"); ?>
