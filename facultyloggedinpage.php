<?php

    session_start();

    $error = "";
    $display = "none";
    $class = "";
    $subject = "";
    $year = "";
    $semester = "";


    if (array_key_exists("username", $_COOKIE) && $_COOKIE ['username']){
        
        $_SESSION['username'] = $_COOKIE['username'];
        
    }

    if (array_key_exists("username", $_SESSION)) {
              
      include("connection.php");
      
      $query = "SELECT * FROM teacher WHERE username = '".mysqli_real_escape_string($link, $_SESSION['username'])."' LIMIT 1";
      $row = mysqli_fetch_array(mysqli_query($link, $query));
 
      
      
    } else {
        
        header("Location: index.php");
        
    }

    if(array_key_exists("asubmit",$_POST)){

        if (!is_numeric($_POST['aclass'])) {
            
            $error .= "Classroom No must be Numeric<br>";
            
        }

        if (!$_POST['aclass']) {
            
            $error .= "Class No is required<br>";
            
        }

        if (!$_POST['asubject']) {
            
            $error .= "Subject is required<br>";
            
        }

        if (!$_POST['ayear']) {
            
            $error .= "Year is required<br>";
            
        }

        if (!$_POST['asemester']) {
            
            $error .= "Semester is required<br>";
            
        }

        if (!is_numeric($_POST['asemester'])) {
            
            $error .= "Semester must be Numeric<br>";
            
        }

        if ($error != "") {
            
            $error = "<p>There were error(s) in your form:</p>".$error;
            
        } else {

          $subject = strtoupper($_POST['asubject']);
          $year = strtoupper($_POST['ayear']);
          $query = "INSERT INTO `classroom` (`class_no`, `teacher_id`, `subject`, `year`, `sem`) VALUES ('$_POST[aclass]','$row[id]','$subject','$year','$_POST[asemester]')";

          $result = mysqli_query($link, $query);
          
          if($result){

            $class = $_POST['aclass'];
            $subject = $_POST['asubject'];
            $year = $_POST['ayear'];
            $semester = $_POST['asemester'];
            $display = "block";

          }else{
              echo "Error";
          }


        }

    }


	include("header.php");

?>

<style type="text/css">

.egx{

display: <?php echo $display; ?>;

}
</style>

<nav class="navbar navbar-light bg-faded navbar-fixed-top">
  

  <a class="navbar-brand" href="#">AIKTC</a>

    <div class="pull-xs-right">
        <a href ='index.php?logout=1'>
        <button class="btn btn-success-outline" type="submit">Logout</button></a>
    </div>

</nav>

<div class = "col-md-6">

        <div class = "jumbotron entry">

            <div id="error"><?php if ($error!="") {
                echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
    
            } ?></div>



            <div class = "container eg">

            <button id ="hello" type="button" class="btn btn-primary">Enter Subject</button><br/>

            </div>

        <div class = "maketoggle">
            <form method = "post" id = "addsubject">
            <div class="form-group">
                <label for="classroom">Classroom No</label>
                <select id="classroom" class="form-control" name = "aclass">
                    <option selected>Choose One</option>
                    <option value = "101">Civil Shift 1: 101</option>
                    <option value = "102">Civil Shift 1: 102</option>
                    <option value = "103">Civil Shift 1: 103</option>
                    <option value = "104">Civil Shift 1: 104</option>
                    <option value = "107">Civil Shift 2: 107</option>
                    <option value = "108">Civil Shift 2: 108</option>
                    <option value = "109">Civil Shift 2: 109</option>
                    <option value = "110">Civil Shift 2: 110</option>
                    <option value = "201">Mechanical: 201</option>
                    <option value = "202">Mechanical: 202</option>
                    <option value = "203">Mechanical: 203</option>
                    <option value = "204">Mechanical: 204</option>
                    <option value = "301">EXTC: 301</option>
                    <option value = "302">EXTC: 302</option>
                    <option value = "303">EXTC: 303</option>
                    <option value = "304">EXTC: 304</option>
                    <option value = "401">Computer: 401</option>
                    <option value = "402">Computer: 402</option>
                    <option value = "403">Computer: 403</option>
                    <option value = "404">Computer: 404</option>
                    <option value = "407">Electrical: 407</option>
                    <option value = "408">Electrical: 408</option>
                    <option value = "409">Electrical: 409</option>
                    <option value = "410">Electrical: 410</option>
                </select>
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <select id="subject" class="form-control" name = "asubject">
                    <option>----Commom Subjects----</option>

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
            <div class="form-group">
                <label for="year">Year</label>
                <select id="year" class="form-control" name = "ayear">
                    <option>Choose One</option>
                    <option value = "S.E">S.E</option>
                    <option value = "T.E">T.E</option>
                    <option value = "B.E">B.E</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sem">Semester</label>
                <select id="sem" class="form-control" name = "asemester">
                    <option>Choose One</option>
                    <option value = "3">3</option>
                    <option value = "4">4</option>
                    <option value = "5">5</option>
                    <option value = "6">6</option>
                    <option value = "7">7</option>
                    <option value = "8">8</option>
                </select>
            </div>
            
        <div class = "container eg">

            <button type="submit" name="asubmit" id="button" class="btn btn-md btn-primary check" disabled>Submit</button><br/>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="accept">
                    <label class="form-check-label" for="accept">I accept the terms and condition.</label>
                </div>

            </div>
            </form>
        </div>



        <div class = "container egx">
        <div class="card" style="width: 18rem;">
        <div class="card-header">
            Subject Saved successfully
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Classroom : <?php echo $class ?></li>
            <li class="list-group-item">Subject : <?php echo $subject ?></li>
            <li class="list-group-item">Year : <?php echo $year ?></li>
            <li class="list-group-item">Semester : <?php echo $semester ?></li>
        </ul>
        </div>
        </div>

        </div>

</div>


<div class = "col-md-6">

<div class = "jumbotron entry">



<div class = "attenButton">
    <div class = "col-md-6">

            <div class = "container eg">

            <button id="hi" type="button" class="btn btn-primary">Add Attendance</button>

            </div>

    </div>
    

    <div class = "col-md-6 left" >

            <div class = "container">

            <button id="cAtten" type="button" class="btn btn-primary">Check Attendance</button>

            </div>

    </div>

<div class = "baketoggle">
<form action="facultycheckattendance.php" method = "post" id = "addtheoryattendance">
  <div class="form-group">
    <label for="year">Year</label>
    <select id="year" class="form-control" name = "year">
        <option>Choose One</option>
        <option value = "S.E">S.E</option>
        <option value = "T.E">T.E</option>
        <option value = "B.E">B.E</option>
    </select>
  </div>
  <div class="form-group">
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
  <div class="form-group">
    <label for="subject">Subject</label>
    <select id="subject" class="form-control" name = "subject">
        <option>----Commom Subjects----</option>

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
  <div class="form-group">
    <label for="type">Type</label>
    <select id="type" class="form-control" name = "type">
        <option>Choose One</option>
        <option value = "lab">lab</option>
        <option value = "theory">theory</option>
    </select>
  </div>
  <div class="form-group">
    <label for="date">Date</label>
    <input type="date" name="date" class="form-control" id="date">
  </div>

  <div class = "container eg">

<button type="submit" name="csubmit" id="button" class="btn btn-md btn-primary">Submit</button>

</div>
</div>


</form>
</div>


<div class = "saketoggle">
<form action="attendance.php" method = "post" id = "addtheoryattendance">
  <div class="form-group">
    <label for="year">Year</label>
    <select id="year" class="form-control" name = "year">
        <option>Choose One</option>
        <option value = "S.E">S.E</option>
        <option value = "T.E">T.E</option>
        <option value = "B.E">B.E</option>
    </select>
  </div>
  <div class="form-group">
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
  <div class="form-group">
    <label for="subject">Subject</label>
    <select id="subject" class="form-control" name = "subject">
        <option>----Commom Subjects----</option>

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
  <div class="form-group">
    <label for="type">Type</label>
    <select id="type" class="form-control" name = "type">
        <option>Choose One</option>
        <option value = "lab">lab</option>
        <option value = "theory">theory</option>
    </select>
  </div>
  <div class="form-group">
    <label for="time">Time-Slot</label>
    <select id="time" class="form-control" name = "slot">
        <option>Choose One</option>
        <option value = "1">1</option>
        <option value = "2">2</option>
        <option value = "3">3</option>
        <option value = "4">4</option>
        <option value = "5">5</option>
        <option value = "6">6</option>
        <option value = "7">7</option>
        <option value = "8">8</option>
    </select>
  </div>
  <div class="form-group">
    <label for="date">Date</label>
    <input type="date" name="date" class="form-control" id="date">
  </div>
  <input type="hidden" name = "attendance" value ="1">


  <div class = "container eg">

<button type="submit" name="tsubmit" id="button" class="btn btn-md btn-primary">Submit</button>

</div>
</div>

</form>

</div>
</div>

<?php
    
    include("footer.php");

?>