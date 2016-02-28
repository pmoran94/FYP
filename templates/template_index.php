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
						<div class="collapse navbar-collapse" id="navBar1">
							<ul class="nav nav-tabs">
								<li><a href="#" class="" id="toggle-menu">
									<span class="caret"></span>
									</a>
								</li>
								
								<!--li><a href="?button=liEditInfo" class="active" >Update Info</a></li-->
								<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown">Profile<span class="caret"></span></a>
	     							<ul class="dropdown-menu">
										<li><a href="?userValue=viewDetails"><span class="glyphicon glyphicon-user"></span> View Profile</a></li>
										<li><a href="?userValue=editDetails"><span class="glyphicon glyphicon-cog"></span> Edit Profile Info.</a></li>
									</ul>
								</li>
								<li class=""><a href='?button=liOrder' name="viewActiveTickets">View Active QR's</a></li>
								<li class=""><a href='?button=liTopUp' name="topUp">MyStripe</a></li>
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

	<div id="sidebar" style="margin-top:2%">

		<h3 class="text-center" ><?php echo $appName;?> </h3>
		<ul class="sidebar-nav">
			<li class="btn-block "><a href="?button=topUpParkingTicket">Top Up Car Ticket</a></li>
			<li class="btn-block "><a href="experienceFull.html">View My Events</a></li>
			<li class="btn-block "><a href="interestsFull.html"></a></li>
			<li class="btn-block "><a href="achievementsFull.html">View Issues</a></li>
			<li class="btn-block "><a href="skillsFull.html">Skills</a></li>
		</ul>
		<p>Find me on:</p>
		<div style="padding-left:5em">
			<a href="#"><span class="glyphicon glyphicon-facebook"></span></a>
			<a href="#"><span class="glyphicon glyphicon-github"></span></a>
			<a href="#"><span class="glyphicon glyphicon-linkedin"></span></a>
			<a href="#"><span class="glyphicon glyphicon-twitter"></span></a>

			<?php echo $rightBox; ?>
		</div>
	</div>
	

			<div id="main-content" class="container" style="margin-top: 2%">
				<div class="col-lg-2">
					<div>
						<ul class="nav nav-pills nav-stacked">
						    <li><a data-toggle="pill" href="#stampdiv">Postal Stamp</a></li>
						    <li><a a data-toggle="pill" href="#cparkdiv">Parking Ticket</a></li>
						    <li><a a data-toggle="pill" href="#eventdiv">Create Event</a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-8 tab-content" style="background-color:lavender; background:rgba(255,255,255,0.3)">
					<!--div class=''-->
						<?php echo "<h2 class='text-center'>" . $introTop . "</h2>"; 
						echo	"<form method='post' index=''>";


						echo 	"<div class='tab-pane fade in active' id='stampdiv'>";
						echo 	"<button class='btn-info' type='button' style='margin-left:40%' name='postalStamp'>  <a href='?button=liCreateStamp'>Generate Postal Stamp</a></button>";
						echo	"</div>";


						echo	"<div class='tab-pane fade' id='cparkdiv'>";
						echo	"<button class='btn-info' type='button' style='margin-left:40%' name='cparking'> <a href='./phpqrcode/index.php?genButton=cpark&ponumber=$ponumber'>Generate Parking Ticket</a></button>";
						echo	"</div>";


						echo	"<div class='tab-pane fade' id='eventdiv'>";
						echo	"<button class='btn-info' type='button' style='margin-left:40%' name='events'> <a href='?button=liCreateEvent'>Create Event</a></button>";
						echo	"</div>";


						echo	"</form>";
						?>
					<!--/div-->
					<?php
						$userDropMenu = $_GET['userValue'];

						if( isset($userDropMenu))
							if($userDropMenu=='viewDetails')
								include_once 'usersDetails.php';
							else if($userDropMenu=='editDetails')
								include_once 'editUserDetails.php';
						else if(isset($_POST['editUserDetailsP']))
							include_once 'editUserDetails.php';
						echo $leftBox;
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



