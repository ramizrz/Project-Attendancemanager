<?php

    session_start();

    $error = "";
    $display = "none";
    $total = 0;
    $average = 0;

    include("connection.php");
    $query = "SELECT `full_name` FROM `student` WHERE `username` = '$_SESSION[username]'";
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

    if(array_key_exists("submit",$_POST)){

    }

    if(array_key_exists("studentsubmit",$_POST)){

        if (!$_POST['startDate']) {
            
            $error .= "A Starting date is required<br>";
            
        }
        if (!$_POST['endDate']) {
            
            $error .= "A Ending Date is required<br>";
            
        }
        if (!$_POST['subject']) {
            
            $error .= "A Subject is required<br>";
            
        }
        if (!$_POST['type']) {
            
            $error .= "A Type is required<br>";
            
        }

    }

?>

<html>

    <head>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


        <style type = "text/css">
        
        .adjust{
            margin-top:10px;
        }
        .change{
            margin-top:7px;
            margin-right:5px;
        }
        .compress{
            
            padding-left:200px;
            width:800px;

        }
        #hiding{

            display:none;
        }
        .just{
            top:6px;
        }
        #myself{
            margin-top:10px;
        }
        
        </style>
        

        
        <title><?php echo $_SESSION['username'] ?></title>
    
    </head>
    <body>

<div class = "container-fluid">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">AIKTC</a>
    </div>
    <div class="navbar-right change">
        <a href ='index.php?logout=1'>
        <button class="btn btn-success-outline" type="submit">Logout</button></a>
    </div>

    
  </div>
</nav>
<div>

        <div class="container">

            <?php if($error != ""){
            $error = "<p>There were error(s) in your form:</p>".$error;
            ?>

            <div id="error"><?php
            echo '<div class="alert alert-danger" role="alert">'.$error.'</div></div>';
            }
            
            else{
            ?>
            
        
            <h2><div class="well text-center">Welcome <?php echo $name?></div></h2>
            <div class="panel panel-default">

                <div class="panel-heading text-center">
                
            <div class = "adjust">
               <form method = "post" id = "hiding">
                    <div class="form-group">
                        <label for="startDate" class = "col-md-4 just">StartDate</label>
                        <div class = "col-md-8">
                        <input type="date" class="form-control" id="startDate" placeholder="StartDate" name = "startDate">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="endDate" class = "col-md-4 just">EndDate</label>
                        <div class = "col-md-8">
                        <input type="date" class="form-control" id="endDate" placeholder="EndDate" name = "endDate">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="subject" class = "col-md-4 just">subject</label>
                        <div class = "col-md-8">
                        <select id="subject" class="form-control" name = "subject">
                            <option value = "ALL">ALL</option>

                            <option value = "AM3">Applied Maths 3</option>
                            <option value = "AM4">Applied Maths 4</option>

                            <option>----Civil Engineering Subjects----</option>

                            <option value = "SUR1">Survey 1</option>
                            <option value = "SOM">SOM</option>
                            <option value = "BMC">BMC</option>
                            <option value = "EG">EG</option>
                            <option value = "PCT">PCT</option>
                            <option value = "FM1">FM1</option>

                            <option value = "SUR2">Survey 2</option>
                            <option value = "SA1">SA1</option>
                            <option value = "BDD1">BDD1</option>
                            <option value = "CT">CT</option>
                            <option value = "FM2">FM2</option>
                            
                            <option value = "SA2">SA2</option>
                            <option value = "GE1">GE1</option>
                            <option value = "BDD2">BDD2</option>
                            <option value = "AH1">AH1</option>
                            <option value = "TE1">TE1</option>
                            <option value = "EM">EM</option>

                            <option value = "GE2">GE2</option>
                            <option value = "DDSS">DDSS</option>
                            <option value = "AH2">AH2</option>
                            <option value = "TE2">TE2</option>
                            <option value = "EE1">EE1</option>
                            <option value = "TRPC">TRPC</option>

                            <option value = "LSMRCS">LSMRCS</option>
                            <option value = "QSEV">QSEV</option>
                            <option value = "IE">IE</option>
                            <option value = "EE2">EE2</option>
                            
                            <option value = "DDRCS">DDRCS</option>
                            <option value = "CE">CE</option>
                            <option value = "CM">CM</option>
                            
                            <option>----Mechanical Engineering Subjects----</option>

                            <option value = "TD">TD</option>
                            <option value = "SOM">SOM</option>
                            <option value = "PS1">PS1</option>
                            <option value = "CAD">CAD</option>
                            <option value = "DBIRS">DBIRS</option>
                            <option value = "MSP1">MSP1</option>

                            <option value = "FM">FM</option>
                            <option value = "TM1">TM1</option>
                            <option value = "PS2">PS2</option>
                            <option value = "MT">MT</option>
                            <option value = "IE">IE</option>
                            <option value = "MSP2">MSP2</option>
                            
                            <option value = "MMC">MMC</option>
                            <option value = "PP3">PP3</option>
                            <option value = "TM2">TM2</option>
                            <option value = "HT">HT</option>
                            <option value = "BCE">BCE</option>

                            <option value = "MQE">MQE</option>
                            <option value = "MD1">MD1</option>
                            <option value = "MV">MV</option>
                            <option value = "TFPE">TFPE</option>
                            <option value = "MCT">MCT</option>
                            <option value = "FEA">FEA</option>

                            <option value = "MD2">MD2</option>
                            <option value = "CAM">CAM</option>
                            <option value = "MUS">MUS</option>
                            <option value = "PPC">PPC</option>
                            
                            <option value = "DMS">DMS</option>
                            <option value = "IEM">IEM</option>
                            <option value = "RAC">RAC</option>

                            <option>----EXTC Subjects----</option>

                            <option value = "AE1">AE1</option>
                            <option value = "DE">DE</option>
                            <option value = "CTL">CTL</option>
                            <option value = "EIM">EIM</option>
                            <option value = "OOPM">OOPM</option>

                            <option value = "AE2">AE2</option>
                            <option value = "MPP">MPP</option>
                            <option value = "WTP">WTP</option>
                            <option value = "SS">SS</option>
                            <option value = "CS">CS</option>
                            
                            <option value = "MA">MA</option>
                            <option value = "AC">AC</option>
                            <option value = "RSA">RSA</option>
                            <option value = "RFMA">RFMA</option>
                            <option value = "BCE">BCE</option>

                            <option value = "DC">DC</option>
                            <option value = "DTSP">DTSP</option>
                            <option value = "CCTN">CCTN</option>
                            <option value = "TE">TE</option>
                            <option value = "OS">OS</option>
                            <option value = "VLSI">VLSI</option>

                            <option value = "IVP">IVP</option>
                            <option value = "MC">MC</option>
                            <option value = "MRE">MRE</option>
                            
                            <option value = "WN">WN</option>
                            <option value = "SCN">SCN</option>
                            <option value = "IVC">IVC</option>

                            <option>----Computer Engineering Subjects----</option>

                            <option value = "OOPM">OOPM</option>
                            <option value = "DS">DS</option>
                            <option value = "DLDA">DLDA</option>
                            <option value = "DIS">DIS</option>
                            <option value = "ECCF">ECCF</option>

                            <option value = "AOA">AOA</option>
                            <option value = "COA">COA</option>
                            <option value = "DBMS">DBMS</option>
                            <option value = "TCS">TCS</option>
                            <option value = "CG">CG</option>
                            
                            <option value = "MP">MP</option>
                            <option value = "OS">OS</option>
                            <option value = "SOOAD">SOOAD</option>
                            <option value = "CN">CN</option>
                            <option value = "WDL">WDL</option>
                            <option value = "BCE">BCE</option>

                            <option value = "SPCS">SPCS</option>
                            <option value = "SE">SE</option>
                            <option value = "DD">DD</option>
                            <option value = "MCC">MCC</option>

                            <option value = "DSP">DSP</option>
                            <option value = "CSS">CSS</option>
                            <option value = "AI">AI</option>
                            
                            <option value = "DWM">DWM</option>
                            <option value = "HMI">HMI</option>
                            <option value = "PDS">PDS</option>

                            <option>----Electrical Engineering Subjects----</option>

                            <option value = "PPE">PPE</option>
                            <option value = "BE">BE</option>
                            <option value = "EN">EN</option>
                            <option value = "EMMI">EMMI</option>
                            <option value = "NT">NT</option>
                            <option value = "PCT">PCT</option>

                            <option value = "EPS">EPS</option>
                            <option value = "EM1">EM1</option>
                            <option value = "ECD">ECD</option>
                            <option value = "ADIC">ADIC</option>
                            <option value = "EII">EII</option>
                            
                            <option value = "PSE">PSE</option>
                            <option value = "EM2">EM2</option>
                            <option value = "EFW">EFW</option>
                            <option value = "PE">PE</option>
                            <option value = "CE">CE</option>
                            <option value = "BCE">BCE</option>

                            <option value = "PSA">PSA</option>
                            <option value = "EM3">EM3</option>
                            <option value = "UEE">UEE</option>
                            <option value = "CS1">CS1</option>
                            <option value = "MA">MA</option>
                            <option value = "PM">PM</option>

                            <option value = "EMD">EMD</option>
                            <option value = "PSOC">PSOC</option>
                            <option value = "HVDCT">HVDCT</option>
                            <option value = "CS2">CS2</option>
                            
                            <option value = "DMAES">DMAES</option>
                            <option value = "DC">DC</option>
                            <option value = "PSPR">PSPR</option>

                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="type" class = "col-md-4 just">Type</label>
                        <div class = "col-md-8">
                        <select id="type" class="form-control" name = "type">
                            <option>Type</option>
                            <option value = "lab">lab</option>
                            <option value = "theory">theory</option>
                        </select>
                        </div>
                    </div>
                    
                    <button id = "myself" type="submit" class="btn btn-primary" name = "studentsubmit">Submit</button>
                </form>
                <button id = "hiding1" type="submit" class="btn btn-primary" name = "studentsubmit">Enter Details!</button>
            </div>
                
                </div>
            
                <div class="panel panel-body">
                <form method = "post">
                
                <table class="table table-striped">
                    <tr>
                        <th>#serial no</th><th>Student Name</th><th>Roll No</th><th>Subject</th><th>Attendance Status</th>
                    </tr>
                    <?php 
                        if(array_key_exists("studentsubmit",$_POST)){
                        include("connection.php");
                        $serialno = 0;
                        $count = 0;

                        $query = "SELECT `student_id`, `status`, `class_id`, `type` FROM `attendance_record` WHERE `student_id` = (SELECT `id` FROM `student` WHERE `username` = '$_SESSION[username]') AND (`date` BETWEEN '$_POST[startDate]' AND '$_POST[endDate]'); ";
                        
                        $result = mysqli_query($link, $query);
                        if(mysqli_num_rows($result) == 0){
                            
                        }else{
                                        
                        while($row=mysqli_fetch_array($result)){   

                            $subjectquery = "SELECT `subject` FROM `classroom` WHERE `id` = '$row[class_id]'";
                            //echo $row['class_id'];
                        
                            $subjectresult = mysqli_query($link, $subjectquery);

                            $subjectrow = mysqli_fetch_array($subjectresult);
                            
                            if($_POST['subject'] == "ALL" AND $_POST['type'] == $row['type']){
                                $count++;
                                $serialno++;
                                $total++;
                                if($row['status'] == "present"){
                                    $average++;
                                }


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
                        <td><?php echo $srow['full_name'] ?></td>
                        <td><?php echo $srow['roll_no'] ?></td>
                        <td><?php echo $subjectrow['subject'] ?></td>   
                        <td><?php echo $row['status'] ?></td>
                    </tr>

                    <?php
                        }elseif($subjectrow['subject'] == $_POST['subject'] AND $_POST['type'] == $row['type']){
                            

                            $count++;
                            $serialno++;
                            $total++;
                            if($row['status'] == "present"){
                                $average++;
                            }


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
                    <td><?php echo $srow['full_name'] ?></td>
                    <td><?php echo $srow['roll_no'] ?></td>
                    <td><?php echo $subjectrow['subject'] ?></td>   
                    <td><?php echo $row['status'] ?></td>
                </tr>
                <?php

                        }
                        
                            }
                            if($count == 0){
                                echo "Sorry No Data Found";
                            }

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
        <?php 
            if(array_key_exists("studentsubmit",$_POST) AND $total != 0){
                
            $ans = ($average/$total)*100;
            if($ans >=75){
        
        ?>
        <div class = "container alert alert-success compress" id = "enabling">
                    <h3>Your Average Attendance Is : <?php 
                        echo $ans."%";
                    ?></h3>
                </div>
            <?php }else{ ?>
                <div class = "container alert alert-danger compress" id= "enabling1">
                    <h3>Your Average Attendance Is : <?php 
                        echo $ans."%";
                    ?></h3>
                </div>
            <?php } } ?>

                
                </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script type="text/javascript">
        

                $("#myself").click(function() {
                    
                    $("#hiding").css("display","none");
                    $("#hiding1").css("display","block");
                
                });

                $("#hiding1").click(function() {
                    
                    $("#hiding").css("display","block");
                    $("#hiding1").css("display","none");
                    $("#enabling").css("display","none");
                    $("#enabling1").css("display","none");
                
                });

        </script>

    </body>

</html>