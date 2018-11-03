<?php

    session_start();

    $error = "";
    $display = "none";
    $username = $_SESSION['username'];
    $type = $_SESSION['type'];

    include("connection.php");
    $query = "SELECT `full_name`, `id`, `department` FROM `teacher` WHERE `username` = '$_SESSION[username]'";
    $result = mysqli_query($link,$query);
    $row = mysqli_fetch_array($result);
    $name = $row['full_name'];
    $tid = $row['id'];
    $department = $row['department'];


    if (array_key_exists("username", $_COOKIE) && $_COOKIE ['username']){
        
        $_SESSION['username'] = $_COOKIE['username'];
        
    }

    if (array_key_exists("username", $_SESSION)) {
      
    } else {
        
        header("Location: index.php");
        
    }

    if(array_key_exists("tsubmit",$_POST)){

        $_SESSION['year'] = $_POST['year'];
        $_SESSION['sem'] = $_POST["sem"];
        $_SESSION['slot'] = $_POST['slot'];
        $_SESSION['date'] = $_POST["date"];
        $_SESSION['subject'] = $_POST["subject"];
        $_SESSION['stype'] = $_POST["type"];

        if (!$_POST['sem']) {
                
            $error .= "Semester is required<br>";
            
        }
        
        if (!$_POST['subject']) {
                
            $error .= "Subject is required<br>";
            
        }
        
        if (!$_POST['year']) {
            
            $error .= "Year is required<br>";
            
        }

        if (!$_POST['date']) {
                
            $error .= "Date is required<br>";
            
        } 
        
        if (!$_POST['slot']) {
            
            $error .= "Slot is required<br>";
            
        }

        if (!is_numeric($_POST['sem'])) {
                
            $error .= "Semester must be Numeric<br>";
            
        }

        if (!is_numeric($_POST['slot'])) {
                
            $error .= "Time Slot must be Numeric<br>";
            
        }

        if (!(strtoupper($_POST['year']) == 'F.E' OR strtoupper($_POST['year']) == 'S.E' OR strtoupper($_POST['year']) == 'T.E' OR strtoupper($_POST['year']) == 'B.E')) {
                
            $error .= "Invalid Year<br>";
            
        }

    }

    if(isset($_POST['submit'])){
        
        foreach($_POST['attendance_status'] as $id => $attendance_status){

            $student_name = $_POST['student_name'][$id];
            $roll_no = $_POST['roll_no'][$id];

            $squery = "SELECT `id` FROM `student` where `full_name` = '$student_name'";
            $sresult = mysqli_query($link, $squery);
            $srow = mysqli_fetch_array($sresult);

            $suquery = "SELECT * FROM `classroom` WHERE `teacher_id` = $tid AND `subject` = '$_SESSION[subject]'";
            //echo "$tid";
            $suresult = mysqli_query($link, $suquery);

            $surow = mysqli_fetch_array($suresult);

            $query = "INSERT INTO `attendance_record` (`class_id`, `teacher_id`, `student_id`, `date`, `time_slot`,`type`, `status`) VALUES ('$surow[id]','$tid','$srow[id]','$_SESSION[date]','$_SESSION[slot]','$_SESSION[stype]', '$attendance_status')";
            $result = mysqli_query($link, $query);
            

        }
        unset($_SESSION);
        $_SESSION['username'] = $username;
        $_SESSION['type'] = $type;
        header( "Refresh:0; url=facultyloggedinpage.php ", true, 0);
        
    }

?>

<html>

    <head>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title><?php echo $_SESSION['username'] ?></title>
    
    </head>
    <body>

        <div class="container">

            <?php if($error != ""){
            $error = "<p>There were error(s) in your form:</p>".$error;
            ?>

            <div id="error"><?php
            echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
            echo '<div class="alert alert-danger" role="alert">You will be Redirect to logged in page</div></div>';
            header( "Refresh:5; url=facultyloggedinpage.php ", true, 303);
            }
            
            else{
            ?>
            
        
            <h2><div class="well text-center">Welcome <?php echo $name?></div></h2>
            <div class="panel panel-default">

                <div class="panel-heading text-center">
                
                    <h3>Students of Year/Sem : <?php if(array_key_exists("year",$_POST)){ echo $_SESSION['year']."/"; echo $_SESSION['sem'];}else{echo "N.A/N.A";} ?></h3>
                
                </div>
            
                <div class="panel panel-body">
                <form method = "post">
                
                <table class="table table-striped">
                    <tr>
                        <th>#serial no</th><th>Student Name</th><th>Roll No</th><th>Attendance Status</th>
                    </tr>
                    <?php 
                        include("connection.php");
                        $serialno = 0;
                        $counter = 0;
                        if(array_key_exists("sem",$_SESSION)){
                        $ssem = $_SESSION['sem'];
                        
                        

                        $query = "SELECT * FROM `student` where `sem` = '$ssem' AND `department` = '$department'";
                        
                        $result = mysqli_query($link, $query);
                        
                        while($row=mysqli_fetch_array($result)){
                            $serialno++;
        
                    ?>
                    
                    <tr>
                        <td><?php echo $serialno ?></td>
                        <td><a href = "details.php?username=<?php echo $row['full_name'] ?>"><?php echo $row['full_name'] ?></a></td>
                        <input type = "hidden" value = "<?php echo $row['full_name']; ?>" name = "student_name[]">
                        <td><?php echo $row['roll_no'] ?></td>
                        <input type = "hidden" value = "<?php echo $row['roll_no']; ?>" name = "roll_no[]">   
                        <td>

                            <input type = "radio" name = "attendance_status[<?php echo $counter; ?>]" value ="present">Present
                            <input type = "radio" name = "attendance_status[<?php echo $counter; ?>]" value ="absent">Absent

                        </td>
                    </tr>

                    <?php

                        $counter++;
                            }
                        }

                    ?>

                </table>
                <input type = "submit" value = "submit" name = "submit" class = "btn btn-primary">
                </form>

                
                </div>
            
            </div>
            <?php
            }
            ?> 
        
        </div>

    </body>


</html>