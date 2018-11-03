<?php

    session_start();

    $error = "";  
    

    if (array_key_exists("logout", $_GET)) {
        
        unset($_SESSION);
        setcookie("username", "", time() - 60*60);
        setcookie("type", "", time() - 60*60);
        $_COOKIE["username"] = "";
        $_COOKIE["type"] = "";  
        
        session_destroy();
        
    } else if ((array_key_exists("username", $_SESSION) AND $_SESSION['username']) OR (array_key_exists("username", $_COOKIE) AND $_COOKIE['username'])) {

        if($_SESSION['type'] == "teacher"){

            //echo $_COOKIE['type'];

            header("Location: facultyloggedinpage.php");

        }else if($_SESSION['type'] == 'student'){

            echo "im here";

            header("Location: studentloggedinpage.php");

        }
       
        
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
            
                $query = "SELECT * FROM `teacher` WHERE username = '".mysqli_real_escape_string($link, $_POST['username'])."'";
            
                $result = mysqli_query($link, $query);
            
                $row = mysqli_fetch_array($result);
            
                if (isset($row)) {
                    
                    // $hashedPassword = md5(md5($row['id']).$_POST['password']);
                    $hashedPassword = $_POST['password'];
                    
                    if ($hashedPassword == $row['password']) {
                        
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['type'] = $row["type"];
                        
                        if (isset($_POST['stayLoggedIn']) AND $_POST['stayLoggedIn'] == '1') {

                            setcookie("username", $row['username'], time() + 60*60*24*365);
                            setcookie("type", $row['type'], time() + 60*60*24*365);

                        } 

                        header("Location: facultyloggedinpage.php");
                            
                    } else {
                        
                        $error = "That username/password combination could not be found.";
                        
                    }
                    
                } else {
                    
                    $error = "That username/password combination could not be found.";
                    
                }
                    
                
            } else  {
                    
                    $query = "SELECT * FROM `student` WHERE username = '".mysqli_real_escape_string($link, $_POST['username'])."'";
                
                    $result = mysqli_query($link, $query);
                
                    $row = mysqli_fetch_array($result);
                
                    if (isset($row)) {
                        
                        //$hashedPassword = md5(md5($row['id']).$_POST['password']);
                        $hashedPassword = $_POST['password'];
                        
                        if ($hashedPassword == $row['password']) {
                            
                            $_SESSION['username'] = $row['username'];
                            $_SESSION['type'] = $row['type'];
                            
                            if (isset($_POST['stayLoggedIn']) AND $_POST['stayLoggedIn'] == '1') {

                                setcookie("username", $row['username'], time() + 60*60*24*365);
                                setcookie("type", $row['type'], time() + 60*60*24*365);

                            } 

                            header("Location: studentloggedinpage.php");
                                
                        } else {
                            
                            $error = "That email/password combination could not be found.";
                            
                        }
                        
                    } else {
                        
                        $error = "That email/password combination could not be found.";
                        
                    }
                    
                }
            
        }
        
        
    }
    


?>

<?php include("header.php"); ?>
      
      <div class="container" id="homePageContainer">
      
    <h1>AIKTC</h1>
          
          <p><strong>Manage And Watch Yours Attendance.</strong></p>
          
          <div id="error"><?php if ($error!="") {
    echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
    
} ?></div>

<form method="post" id = "facultyLogIn">
    
    <p>Respected Faculty, Please Enter Your Username And Password.</p>
    
    <fieldset class="form-group">

        <input class="form-control" type="text" name="username" placeholder="Username">
        
    </fieldset>
    
    <fieldset class="form-group">
    
        <input class="form-control" type="password" name="password" placeholder="Password" value="">
        
    </fieldset>
    
    <div class="checkbox">
    
        <label>
    
        <input type="checkbox" name="stayLoggedIn" value=1> Stay logged in
            
        </label>
        
    </div>
    
    <fieldset class="form-group">
    
        <input type="hidden" name="login" value="1">
        
        <input class="btn btn-success" type="submit" name="submit" value="Log In!">
        
    </fieldset>
    
    <p><a class="toggleForms">Student Login</a></p>

</form>

<form method="post" id = "studentLogIn">
    
    <p>Respected Student, Please Enter Your Username And Password.</p>
    
    <fieldset class="form-group">

        <input class="form-control" type="text" name="username" placeholder="Username">
        
    </fieldset>
    
    <fieldset class="form-group">
    
        <input class="form-control" type="password" name="password" placeholder="Password" value="">
        
    </fieldset>
    
    <div class="checkbox">
    
        <label>
    
            <input type="checkbox" name="stayLoggedIn" value=1> Stay logged in
            
        </label>
        
    </div>
        
        <input type="hidden" name="login" value="0">
    
    <fieldset class="form-group">
        
        <input class="btn btn-success" type="submit" name="submit" value="Log In!">
        
    </fieldset>
    
    <p><a class="toggleForms">Faculty Login</a></p>

</form>
          
      </div>

<?php include("footer.php"); ?>


