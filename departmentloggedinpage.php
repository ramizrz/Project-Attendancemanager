<?php

    session_start();
    $error ="";

    if (array_key_exists("dusername", $_SESSION)) {
              
      include("connection.php");
      
      $query = "SELECT * FROM superuser WHERE username = '".mysqli_real_escape_string($link, $_SESSION['username'])."' LIMIT 1";
      $row = mysqli_fetch_array(mysqli_query($link, $query));
 
      $name = "Welcome ".$row['username'];                                                                                                                                                                                                                

    } else {
        
        header("Location: departmentLandingPage.php");
        
    }

    if (array_key_exists("submit", $_POST)) {
        
        if (!$_POST['fullname']) {
            
            $error .= "Name is required<br>";
            
        }
        
        if(array_key_exists("rollno",$_POST)){

            if (!$_POST['rollno']) {
            
                $error .= "Roll No is required<br>";
                
            }

        }
        
        if (!$_POST['email']) {
            
            $error .= "A Email is required<br>";
            
        }
        
        if (!$_POST['username']) {
            
            $error .= "Username is required<br>";
            
        }

        if (!$_POST['address']) {
            
            $error .= "Address is required<br>";
            
        }

        if (!$_POST['password']) {
            
            $error .= "Password is required<br>";
            
        }

        if (!$_POST['cnfpassword']) {
            
            $error .= "Password is required<br>";
            
        }

        if (!$_POST['department']) {
            
            $error .= "Department is required<br>";
            
        }

        if (!$_POST['dob']) {
            
            $error .= "Date of Birth is required<br>";
            
        }

        if (!$_POST['mobileno']) {
            
            $error .= "Mobile No is required<br>";
            
        }

        if($_POST['cnfpassword'] != $_POST['password']){

            $error .= "Password Not Matched<br>";
            
        }
        
        if ($error != "") {
            
            $error = "<p>There were error(s) in your form:</p>".$error;
            
        } else {
            
            if ($_POST['enter'] == '1') {

                $pass = md5($_POST['password']);
            
                $query = "SELECT id FROM `teacher` WHERE username = '".mysqli_real_escape_string($link, $_POST['username'])."' LIMIT 1";

                $result = mysqli_query($link, $query);

                if (mysqli_num_rows($result) > 0) {

                    $error = "That email address is taken.";

                } else {

                    $query = "INSERT INTO `teacher`(`full_name`, `department`, `username`, `password`, `dob`, `mobile_no`, `address`, `email`, `type`) VALUES ('$_POST[fullname]','$_POST[department]','$_POST[username]','$pass','$_POST[dob]','$_POST[mobileno]','$_POST[address]','$_POST[email]','teacher');";

                    if (!mysqli_query($link, $query)) {

                        $error = "<p>Could not sign you up - please try again later.</p>";

                    } 

                }

            } else  {
                    
                $query = "SELECT id FROM `student` WHERE username = '".mysqli_real_escape_string($link, $_POST['username'])."' LIMIT 1";

                $result = mysqli_query($link, $query);

                if (mysqli_num_rows($result) > 0) {

                    $error = "That Username is taken.";

                } else {

                    $pass = md5($_POST['password']);

                    $query = "INSERT INTO `student`(`full_name`, `roll_no`, `department`, `username`, `password`, `email`, `address`, `dob`, `mobile_no`, `type`, `year`, `sem`) VALUES ('$_POST[fullname]','$_POST[rollno]','$_POST[department]','$_POST[username]','$pass','$_POST[email]','$_POST[address]','$_POST[dob]','$_POST[mobileno]','student','$_POST[year]','$_POST[sem]')";

                    if (!mysqli_query($link, $query)) {

                        $error = "<p>Could not sign you up - please try again later.</p>";

                    }

                }
                    
            }
            
        }
        
        
    }
?>

<?php include("header.php"); ?>
<nav class="navbar navbar-light bg-faded navbar-fixed-top">
  

  <a class="navbar-brand" href="#">AIKTC</a>

    <div class="pull-xs-right">
      <a href ='departmentLandingPage.php?logout=1'>
        <button class="btn btn-success-outline" type="submit">Logout</button></a>
    </div>

</nav>

    <div class="container-fluid entry">

        <div class = "jumbotron">
        
            <form method = "Post" id = "facultydetails">

                <div class="centroid">
                    <h3>Enter Faculty Details</h3>
                </div>

                <div id="error"><?php if ($error!="") {
                    echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';} ?>
                </div>
    
                <div class="form-group col-md-6">
                    <label for="full-name">Full Name</label>
                    <input type="text" class="form-control" id="full-name" placeholder="Full Name" name ="fullname">
                </div>

                <div class="form-group col-md-6">
                    <label for="emailid">Email Id</label>
                    <input type="email" class="form-control" id="emailid" placeholder="Email" name ="email">
                </div>

                <div class="form-group col-md-6">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Username" name ="username">
                </div>

                <div class="form-group col-md-6">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="AIKTC, New Panvel" name ="address">
                </div>

                <div class="form-group col-md-6">
                    <label for="inputCity">Password</label>
                    <input type="password" class="form-control" id="password" placeholder = "Password" name ="password">
                </div>

                <div class="form-group col-md-6">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm-password" placeholder = "Password" name ="cnfpassword">
                </div>

                <div class="form-group col-md-4">
                    <label for="department">Department</label>
                    <select id="department" class="form-control" name = "department">
                        <option>Choose One</option>
                        <option value = "Civil">Civil</option>
                        <option value = "Mechanical">Mechanical</option>
                        <option value = "EXTC">EXTC</option>
                        <option value = "Computer">Computer</option>
                        <option value = "Electrical">Electrical</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="dob">Date of Birth</label>
                    <input type="date" class="form-control" id="dob" placeholder = "Mobile No" name ="dob">
                </div>

                <div class="form-group col-md-4">
                    <label for="mobile">Mobile No</label>
                    <input type="text" class="form-control" id="mobile" placeholder = "Mobile No" name ="mobileno">
                </div>

                <div class = "container">
    
                    <input type="hidden" name="enter" value="1">
                    <input class="btn btn-success" type="submit" name="submit" value="Submit!">
                    <p><a class="toggleForms">Or, Enter Student Details</a></p>
                </div>
                
            </form>

            <form method = "Post" id = "studentdetails">

                <div class="centroid">
                    <h3>Enter Student Details</h3>
                </div>
    
                <div class="form-group col-md-4">
                    <label for="full-name">Full Name</label>
                    <input type="text" class="form-control" id="full-name" placeholder="Full Name" name ="fullname">
                </div>

                <div class="form-group col-md-4">
                    <label for="rollno">Roll No</label>
                    <input type="text" class="form-control" id="rollno" placeholder="Roll No" name ="rollno">
                </div>

                <div class="form-group col-md-4">
                    <label for="emailid">Email Id</label>
                    <input type="email" class="form-control" id="emailid" placeholder="Email" name ="email">
                </div>

                <div class="form-group col-md-4">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Username" name ="username">
                </div>

                <div class="form-group col-md-2">
                    <label for="year">Year</label>
                    <select id="year" class="form-control" name = "year">
                        <option>Choose One</option>
                        <option value = "S.E">S.E</option>
                        <option value = "T.E">T.E</option>
                        <option value = "B.E">B.E</option>
                    </select>
                </div>

                <div class="form-group col-md-2">
                    <label for="sem">Semester</label>
                    <select id="sem" class="form-control" name = "sem">
                        <option>Choose One</option>
                        <option value = "3">3</option>
                        <option value = "4">4</option>
                        <option value = "5">5</option>
                        <option value = "6">6</option>
                        <option value = "7">7</option>
                        <option value = "8">8</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="AIKTC, New Panvel" name ="address">
                </div>

                <div class="form-group col-md-6">
                    <label for="inputCity">Password</label>
                    <input type="password" class="form-control" id="password" placeholder = "Password" name ="password">
                </div>

                <div class="form-group col-md-6">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm-password" placeholder = "Password" name ="cnfpassword">
                </div>

                <div class="form-group col-md-4">
                    <label for="department">Department</label>
                    <select id="department" class="form-control" name = "department">
                        <option>Choose One</option>
                        <option value = "Civil">Civil</option>
                        <option value = "Mechanical">Mechanical</option>
                        <option value = "EXTC">EXTC</option>
                        <option value = "Computer">Computer</option>
                        <option value = "Electrical">Electrical</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="dob">Date of Birth</label>
                    <input type="date" class="form-control" id="dob" placeholder = "Mobile No" name ="dob">
                </div>

                <div class="form-group col-md-4">
                    <label for="mobile">Mobile No</label>
                    <input type="text" class="form-control" id="mobile" placeholder = "Mobile No" name ="mobileno">
                </div>

                <div class = "container">
                    <input type="hidden" name="enter" value="0">
                    <input class="btn btn-success" type="submit" name="submit" value="Submit!">
                    <p><a class="toggleForms">Or, Enter Faculty Details</a></p>
                </div>
                
            </form>
        </div>
    </div>
<?php
    
    include("footer.php");
?>