<!DOCTYPE html>
<?php include_once 'html_doctype_and_head.php'; ?>
<body>

			
<?php// include_once '../phpqrcode/index.php'; ?>


<div id="wrapper">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class='navbar navbar-inverse navbar-fixed-top' style="padding-top:6px">
				<div class='navbar-inner'>
					<div class='container-fluid'>
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navBar1">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div>
						<div style='width:100%:height:15%'>
							<h2 style='font-family:"Lucida Console", Monaco, monospace'><img src='./images/head.jpg' style='height:90px;width:90px;padding-bottom: 5px'>
							Qr Coding System</h2>
						</div>
						</div>
						<div class="collapse navbar-collapse" id="navBar1">

							<ul class="nav nav-tabs">
								<li><a href="#" class="" id="toggle-menu">
									<span class="glyphicon glyphicon-th-list"></span>
									</a>
								</li>

								<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown">Profile<span class="caret"></span></a>
	     							<ul class="dropdown-menu">
										<li><a href="?userValue=viewDetails"><span class="glyphicon glyphicon-user"></span> View Profile</a></li>
										<li><a href="?userValue=editDetails"><span class="glyphicon glyphicon-cog"></span> Edit Profile Info.</a></li>
									</ul>
								</li>
								<li class=""><a href='?button=liOrder' name="viewActiveTickets">View Active QR's&nbsp&nbsp<span class='glyphicon glyphicon-qrcode'></span></a></li>
								<li class=""><a href='?button=liTopUp' name="topUp">MyStripe<span class='glyphicon glyphicon-euro'></span></a></li>
								<li class=""><a href='?button=liReport' name="reportIssue">Report Issue</a></li>
								<li class=""><a href='?button=liPassChange' name="changePass">Change Password</a></li>
							</ul>

							<div class="navbar-form pull-right">
								<div class="navbar-form pull-left"> 
									<?php echo "<font color='red'>" . $authenticationErrorMessage . "</font>"; ?>	
								</div>
							<div class="navbar-form pull-right">  <?php echo $loginBox ?> </div>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="screenTop">
		</div>

	<div id="sidebar" style="margin-top:10%">

		<h3 class="text-center" ><?php echo $appName;?> </h3>
		<ul class="sidebar-nav">
			<li class="btn-block "><a href="?button=topUpParkingTicket"><span class="glyphicon glyphicon-chevron-right"></span>&nbsp&nbspTop Up Car Ticket</a></li>
			<li class="btn-block "><a href="?userValue=allEventsForUser"><span class="glyphicon glyphicon-chevron-right"></span>&nbsp&nbspView My Events</a></li>
			<li class="btn-block "><a href="?userValue=viewTrackedStamps"><span class="glyphicon glyphicon-chevron-right"></span>&nbsp&nbspTrack Sent Stamps</a></li>
			<li class="btn-block "><a href="skillsFull.html"><span class="glyphicon glyphicon-chevron-right"></span>&nbsp&nbspNotifications</a></li>
			<li class="btn-block "><a href="?userValue=viewExpiryTime"><span class="glyphicon glyphicon-chevron-right"></span>&nbsp&nbspView Current Expiry Time</a></li>
		</ul>
	</div>
	

			<div id="main-content" class="container" style="margin-top: 10%">
				<div class="col-lg-2">
					<div style='position: fixed'>
						<ul class="nav nav-pills nav-stacked">
						    <li><a data-toggle="pill" href="#stampdiv"><span class="glyphicon glyphicon-chevron-right"></span>Postal Stamp&nbsp&nbsp<span class='glyphicon glyphicon-envelope'></span></a></li>
						    <li><a a data-toggle="pill" href="#cparkdiv"><span class="glyphicon glyphicon-chevron-right"></span>Parking Ticket&nbsp<span class='glyphicon glyphicon-barcode'></span></a></li>
						    <li><a a data-toggle="pill" href="#eventdiv"><span class="glyphicon glyphicon-chevron-right"></span>Create Event&nbsp&nbsp<span class='glyphicon glyphicon-cutlery'></span></a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-8 tab-content"  style="background-color:lavender; background:rgba(255,255,255,0.3)">
					<!--div class=''-->
						<?php echo "<h2 class='text-center'>" . $introTop. "</h2>";
						echo "<div style='text-align:center'>" ;
						echo	"<form method='post' index=''>";


						echo 	"<div class='tab-pane fade in active' id='stampdiv'>";
						echo 	"<button class='btn-large btn-info' type='button' name='postalStamp'>  <a href='?button=liCreateStamp'>Generate Postal Stamp</a></button>";
						echo	"</div>";

						/*
						echo	"<div class='tab-pane fade' id='cparkdiv'>";
						echo	"<button class='btn-info' type='button' style='margin-left:40%' name='cparking'> <a href='./phpqrcode/index.php?genButton=cpark&ponumber=$ponumber'>Generate Parking Ticket</a></button>";
						echo	"</div>";*/
						

						
						echo	"<div class='tab-pane fade' id='cparkdiv'>";
						echo	"<button class='btn-large btn-info' type='button' name='cparking'> <a href='?button=liCreateParkTicket'>Generate Parking Ticket</a></button>";
						echo	"</div>";

						

						echo	"<div class='tab-pane fade' id='eventdiv'>";
						echo	"<button class='btn-large btn-info' type='button' name='events'> <a href='?button=liCreateEvent'>Create Event</a></button>";
						echo	"</div>";


						echo	"</form>";
						echo  "</div>";
						?>
					<!--/div-->
					<?php

						$userDropMenu;
						
						if (! empty($_GET['userValue'])) $userView = $_GET['userValue'];
						else $userView = "";

						if( isset($userView))
							if($userView=='viewDetails')
								include_once 'usersDetails.php';
							else if($userView=='editDetails')
								include_once 'editUserDetails.php';
							else if($userView=='allEventsForUser')
								include_once 'view_all_events_for_user.php';
							else if($userView=='viewEvent')
								include_once 'viewEventDetails.php';
							else if($userView == 'viewTrackedStamps')
								include_once 'view_trackStamps.php';
							else if($userView == 'viewExpiryTime')
								include_once 'getCurrentCParkExpiry.php';
						else if(isset($_POST['editUserDetailsP']))
							include_once 'editUserDetails.php';
						echo $leftBox ;
					?>
					<br>

				</div>

				<div class="col-lg-1">
				</div>
			</div>
	</div>

</div> <!--End of Wrapper-->
	<footer  class='navbar navbar-fixed-bottom standard'>	</footer>


<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
	$("#toggle-menu").click(function (e){
		e.preventDefault();
		$("#wrapper").toggleClass("menuDisplayed");
	});
</script>
</body>
</html>



