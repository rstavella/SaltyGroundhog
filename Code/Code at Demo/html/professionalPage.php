<?php
include('loginValidate.php'); 
session_start();
error_reporting(-1); // display all faires
ini_set('display_errors', 1);  // ensure that faires will be seen
ini_set('display_startup_errors', 1); // display faires that didn't born
if(!isset( $_SESSION['prof_id'])){
  load('index.php');
}
else if( isset( $_SESSION['prof_id'])) : ?>

<html lang="en">
<head>
  <title>Professionals</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <style media="screen" type="text/css">
  .table th, .table td {
     border-top: none !important;
     font-size:25px;
     border-collapse:separate;
     border-spacing:3em;
  }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }

    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 800px}

    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #008b8b;
      height: 100%;
    }

     body {
        background: -webkit-linear-gradient( #48d1cc, #afeeee, white); /* For Safari 5.1 to 6 */
        background: -o-linear-gradient(#48d1cc,#afeeee, white); /* For Opera 11.1 to 12.0/ */
        background: -moz-linear-gradient(#48d1cc,#afeeee, white); /* For Firefox 3.6 to 15  */
        background: linear-gradient(#48d1cc,#afeeee, white); /* Standard syntax (must be la st) */

  }

   /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      font-size: 10px;
      padding: 15px;
   }
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;}
    }
  </style>
</head>
<body>

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
        <li><a href="home.php"><img src="http://10.10.7.164/img/true.jpg" class="img-rounded"  width="70" height="30"></a></li>
        <li><a href="clientPage.php">Clients</a></li>
	<li class="active"><a href="professionalPage.php">Professionals</a></li>
        <li><a href="\Calendar\sample.php">Calendar</a></li>
        <li><a href="newClientPage.php">Add Client</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="myProfile.php"><span class="glyphicon glyphicon-user"></span></a></li>
        <li><a href="settings.php"><span class="glyphicon glyphicon-cog"></span></a></li>
        <li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>



<body id="public" onorientationchange="window.scrollTo(0, 1)">
  <div id="container" class="ltr">
  <header id="header" class="info">
  <center><h1>Professionals</h1></center>
  <div></div>
</header>
<div id="no-more-tables">
<table class="table-condensed cf" style="border-collapse:separate; border-spacing:1em; border-top: none !important;">
        <thead>
            <tr>
                <td></td>
            </tr>
        </thead>
        <tbody>
        <?php
            $connect = pg_connect("host=10.10.7.159 dbname=maindb user=postgres password=SaltyGroundhogs");
            if (!$connect) {
                die(pg_error());
            }
            $results = pg_query("SELECT p.prof_id, p.prof_picture_url, p.first_name, p.last_name FROM professionals as p WHERE p.prof_id != " . $_SESSION['prof_id'] . " ORDER BY p.prof_id ASC");
            while($row = pg_fetch_array($results)) {
          	echo "<td><h2><a href=\"professionalFullBio.php?id={$row['prof_id']}\">{$row['first_name']} {$row['last_name']}</a></h2></td>";
            ?>
              <tr>
		<td><img src="/uploads/lindsay-lohan.jpg"style="width:140px;height:100px;"></img></td>
	     </tr>
            <?php
            }
            ?>
            </tbody>
  </table>
  </div>

<footer class="container-fluid text-center">
  <p>True Course Life © 2016. True Course Life and Leadership Development includes True Course Living, Learning, Leading, LLC and True Course Ministries, Inc.
True Course Ministries, True Course Living, Learning, Leading; and True Course Life & Leadership Development are all registered trademarks.</p>
</footer>

</body>
</html>

<?php endif; ?>
</html>

