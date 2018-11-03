<?php 

include("connection.php");
$query = "SELECT * FROM `student` WHERE `full_name` = '$_GET[username]'";
$result = mysqli_query($link,$query);
$row = mysqli_fetch_array($result);

?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"  ></script>
    
    <title>student details</title>
 </head>
  <body >

    <div class="profile-wrapper container">
	<div class="row">
		<div class="col-md-6 left">
			<img class="user-photo"  src="student.jpg">
		</div>
		<div class="col-md-6 right text-center">
		<h6>STUDENT DETAIL</h6>
			<table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Name:</td>
                        <td><?php echo $row['full_name']; ?></td>
                      </tr>
                      <tr>
                        <td>Roll No:</td>
                        <td><?php echo $row['roll_no']; ?></td>
                      </tr>
                      <tr>
                        <td>Date of Birth:</td>
                        <td><?php echo $row['dob']; ?></td>
                      </tr>
                      <tr>
                        <td>Year:</td>
                        <td><?php echo $row['year']; ?></td>
                      </tr>
                      <tr>
                        <td>Semester:</td>
                        <td><?php echo $row['sem']; ?></td>
                      </tr>                   
                       <tr>
                        <td>Gender:</td>
                        <td>Male</td>
                      </tr>
                        <tr>
                        <td>Address:</td>
                        <td><?php echo $row['address']; ?></td>
                      </tr>
                      <tr>
                        <td>Email:</td>
                        <td><?php echo $row['email']; ?></td>
                      </tr>
                        <td>Phone Number:</td>
                        <td><?php echo $row['mobile_no']; ?></td>
                           
                      </tr>
                     
                    </tbody>
                  </table>
                  </div>
		</div>
	</div>
    </div>



    <style>
body{
	margin:0;
	font:normal 16px 'Roboto Slab', sans-serif;
	background-color:#d2d6de;}
.profile-wrapper{
	max-width:700px;
	margin-left:auto;
	margin-right:auto;
	margin-bottom: 5%;
	margin-top:5%;}
.user-photo{
	border-radius:10px;
	width:100%;
	height: 100%;

	box-shadow: 0 0 1px 2px rgba(75, 62, 115,.1);}
.left{
	width:auto;
	padding:1px;
	border-left: solid 1px rgba(75, 62, 115,.4);
	height:auto;
	margin-top:10px;
	border-radius:10px;
	webkit-box-shadow: 0px 0px 47px -4px rgba(75, 62, 115,1);
	-moz-box-shadow: 0px 0px 47px -4px rgba(75, 62, 115,1);
	box-shadow: 0px 0px 47px -4px rgba(75, 62, 115,1);
	}
div.links a{
	color:#8e8e8e;
	}
div.links a:hover{
	color:#343a40;

	}
div.links a:active{
	color:#6c757d;
	}
.right{
	border-left: solid 1px rgba(75, 62, 115,.4);
	height:auto;
	margin-top:10px;
	border-radius:50px;

	-webkit-box-shadow: 0px 0px 47px -4px rgba(75, 62, 115,1);
	-moz-box-shadow: 0px 0px 47px -4px rgba(75, 62, 115,1);
	box-shadow: 0px 0px 47px -4px rgba(75, 62, 115,1);
	background-color:#fff;width:350px;padding:0;border-radius:0 10px 10px 0;
	padding:60px 10px 10px 10px;
}
@media (max-width: 767.67px) {
.user-photo{
	box-shadow:none;
	}
.right{
	border-radius:0 0 10px 10px;
	padding-top:15px;
	margin-top:-10px;
	}
.profile-wrapper{
	max-width:350px;
	}
		}


  </body>
</html>