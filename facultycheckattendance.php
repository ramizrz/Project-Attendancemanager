<?php

    session_start();

    $error = "";
    $display = "none";

    include("connection.php");
    $query = "SELECT `full_name` FROM `teacher` WHERE `username` = '$_SESSION[username]'";
    $result = mysqli_query($link,$query);
    $row = mysqli_fetch_array($result);
    $name = $row['full_name'];


    if (array_key_exists("username", $_COOKIE) && $_COOKIE ['username']){
        
        $_SESSION['username'] = $_COOKIE['username'];
        
    }

    if (array_key_exists("username", $_SESSION)) {

    } else {
        
        header("Location: index.php");
        
    }

    if(array_key_exists("csubmit",$_POST)){

        if (!$_POST['sem']) {
                
            $error .= "Semester is required<br>";
            
        }
        
        if (!$_POST['subject']) {
                
            $error .= "Subject is required<br>";
            
        }
        
        if (!$_POST['year']) {
            
            $error .= "Year is required<br>";
            
        }

        if (!$_POST['type']) {
                
            $error .= "Type is required<br>";
            
        }

        if (!$_POST['date']) {
                
            $error .= "Date is required<br>";
            
        } 

        if (!is_numeric($_POST['sem'])) {
                
            $error .= "Semester must be Numeric<br>";
            
        }

        if (!(strtoupper($_POST['year']) == 'F.E' OR strtoupper($_POST['year']) == 'S.E' OR strtoupper($_POST['year']) == 'T.E' OR strtoupper($_POST['year']) == 'B.E')) {
                
            $error .= "Invalid Year<br>";
            
        }

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
                
                    <h3>Students of Year/Sem : <?php echo $_POST['year']."/"; echo $_POST['sem']; ?>  </h3>
                
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
                        $count = 0;

                        $query = "SELECT `student_id`, `status`, `class_id`, `type` FROM `attendance_record` WHERE `teacher_id` = (SELECT `id` FROM `teacher` WHERE `username` = '$_SESSION[username]') AND `date` = '$_POST[date]'";
                        
                        $result = mysqli_query($link, $query);
                        if(mysqli_num_rows($result) == 0){
                            echo "Sorry No Data Fount Go Back!!";
                        }else{
                        
                        
                        
                        while($row=mysqli_fetch_array($result)){   
                            $serialno++;

                            $subjectquery = "SELECT `subject` FROM `classroom` WHERE `id` = '$row[class_id]'";
                            //echo $row['class_id'];
                        
                            $subjectresult = mysqli_query($link, $subjectquery);

                            $subjectrow = mysqli_fetch_array($subjectresult);
                            
                            if($subjectrow['subject'] == $_POST['subject'] AND $_POST['type'] == $row['type']){
                                $count++;


                                $query = "SELECT * FROM `student` WHERE `id` = '$row[student_id]' LIMIT 1";
                                $sresult = mysqli_query($link, $query);
                                if($sresult){
                                    $srow = mysqli_fetch_array($sresult);
                                }else{
                                    echo "error";
                                }
                            
                    ?>  
                    
                    <tr>
                        <td><?php echo $serialno ?></td>
                        <td><a href = "details.php?username=<?php echo $srow['full_name'] ?>"><?php echo $srow['full_name'] ?></td>
                        <td><?php echo $srow['roll_no'] ?></td>   
                        <td><?php echo $row['status'] ?></td>
                    </tr>

                    <?php
                        }
                            }
                            if($count == 0){
                                echo "Sorry No Data Fount Go Back!!";
                            }

                                }

                    ?>

                </table>
                </form>

                
                </div>
            
            </div>
            <?php
            }
            ?> 
        
        </div>

    </body>


</html>