<!--
Credit to the Layout with the shaded Border
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/

Code written by the Salty Groundhogs Team
Senior Project
True Course Website
This page allows a professional to view another professionals full bio
-->

<?php
#Error Reporting that can be uncommented when a developer is testing queries or anything PHP related
#error_reporting(-1); // display all faires
#ini_set('display_errors', 1);  // ensure that faires will be seen
#ini_set('display_startup_errors', 1); // display faires that didn't born

#Verifies that a professional is logged in.
#This page is only viewable if you have the proper crednetials and are logged in.     
include('loginValidate.php');
session_start();
if(!isset( $_SESSION['prof_id'])){
     load('index.php');
}
else if( isset( $_SESSION['prof_id'])) : ?>

<html lang="en">
<head>
 <title>Customer Profile</title>
  <link href="style.css" rel="stylesheet" type="text/css" media="all"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <!--web-fonts-->
  <link href='//fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!--web-fonts-->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
</head>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
       </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="home.php"><img src="true.jpg" class="img-rounded"  width="70" height="30"></a></li>
        <li><a href="clientPage.php">Clients</a></li>
        <li class="active"><a href="professionalPage.php">Professionals</a></li>
        <li><a href="newClientPage.php">Add Client</a></li>
        <li><a href="addAppointment.php">Add Appointment</a></li>
        <li><a href="addLifeEvent.php">Add Life Event</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="myProfile.php"><span class="glyphicon glyphicon-user"></span></a></li>
        <li><a href="settings.php"><span class="glyphicon glyphicon-cog"></span></a></li>
        <li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<body>
<?php
 $connect = pg_connect("host=10.10.7.159 dbname=maindb user=postgres password=SaltyGroundhogs");
 $identity=$_GET['id'];
 if (!$connect) {
    die(pg_error());
 }
 #Pass in URL ID for query to show correct professional information
 $results = pg_query("SELECT * from professionals where prof_id = ' $identity '");
 while($row = pg_fetch_array($results)) {
	#Changes phone number format for printing -- from 1231231234 to (123)-123-1234
        $phone_number = $row['phone_number'];
        $phone_number = '('.substr($phone_number, 0, 3).')-'.substr($phone_number, 3,3).'-'.substr($phone_number, 6,10);
	#Checks to see what is loaded in database for the picture URL
	#if it is the generic notUploaded then it will load the noProfile photo else load profile photo saved on database
	 if ($row['prof_picture_url'] == "notUploaded"){
                      $prof_picture_url = "/uploads/noProfilePhoto.png";
                  } else {
                      $prof_picture_url = $row['prof_picture_url'];
                 }
?>
  <h1 align="center"><?php echo $row['first_name']?> <?php echo $row['last_name']?></h1>
  <!---Here we are outputting all information about a professional that is saved in the database -->
  <div class="main">
    <div class="main-section agile">
       <div class="login-form">
	   <ul>
		<li><img src="<?php echo $prof_picture_url?>" style="width:100px;height:100px;"></img></center></li><br>
	   </ul>
           <ul>
               <li><b>Email</b></li>
           </ul>
           <ul>
               <li><?php echo $row['email']?></li>
          </ul>
          <ul>
               <li><b>Address</b></li>
          </ul>
          <ul>
               <li><?php echo $row['street_address']?></li> 
	       <li><?php echo $row['city']?> <?php echo $row['state']?>, <?php echo $row['zipcode']?></li>
	       <li> <?php echo $row['country']?></li>
         </ul>
         <ul>
               <li><b>Phone Number</b></li>
         </ul>
         <ul>
               <li><?php echo $phone_number?></li>
         </ul>
         <ul>
               <li><b>Gender</b></li>
         </ul>
         <ul>
               <li><?php echo $row['gender']?></li>
         </ul>
         <ul>
               <li><b>Professional Bio</b></li>
         </ul>
         <ul>
               <li><?php echo $row['bio']?></li>
        </ul>
<?php
   } #Close While Loop
?>
       </div>
    </div>
  </div>
<br>
<footer class="container-fluid text-center">
    <p>True Course Life &copy; 2016. True Course Life and Leadership Development includes True Course Living, Learning, Leading, LLC and True Course Minisulies, Inc.
       True Course Minisulies, True Course Living, Learning, Leading; and True Course Life & Leadership Development are all registered Trademarks.</p>
</footer>
</body>
</html>

<?php endif; ?>

