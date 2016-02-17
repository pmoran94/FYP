<!DOCTYPE html>
<?php include_once 'html_doctype_and_head.php'; ?>
<body>

			
<?php ?>
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
								
								<li><a href="?button=liEditInfo" class="active" >Update Info</a></li>
								<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown">My Info <span class="caret"></span></a>
	     							<ul class="dropdown-menu">
										<li><a href="#"><img src="./images/facebook_logo.png" style="width:10px;height:10px"> Facebook</a></li>
										<li><a href="#"><img src="./images/Twitter_button.png" style="width:10px;height:10px"> Twitter</a></li>
										<li><a href="#"><img src="./images/linkedin_icon.png" style="width:10px;height:10px"> LinkedIn</a></li>
										<li><a href="#"><img src="./images/github_logo.png" style="width:10px;height:10px"> Github</a></li>
										<li><a href="#"><img src="./images/iphone.png" style="width:10px;height:10px"> Mobile</a></li>
										<li><a href="#"><img src="./images/gmail_logo.png" style="width:10px;height:10px"> Email</a></li>
									</ul>
								</li>
								<li class=""><a href='?button=liOrder' name="makeOrder">Make Order</a></li>
								<li class=""><a href='?button=liTopUp' name="topUp">Top Up</a></li>
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
			<div class="container-fluid">
				<a href="#"><?php echo $appName;?></a>
			</div>
		</div>

	<div id="sidebar">

		<h3 class="algerian text-center" >Online Postal Service</h3>
		<ul class="sidebar-nav">
			<li class="btn-block"><a href="educationFull.html">View Customers</a></li>
			<li class="btn-block"><a href="experienceFull.html">View Employees</a></li>
			<li class="btn-block"><a href="interestsFull.html">View Orders</a></li>
			<li class="btn-block"><a href="achievementsFull.html">View Issues</a></li>
			<li class="btn-block"><a href="skillsFull.html">Skills</a></li>
		</ul>
		<p style="color:white">Find me on:</p>
		<div style="padding-left:5em">
			<a href="#"><img src="./images/facebook_logo.png" style="height:30px;width:30px"></a>
			<a href="#"><img src="./images/Twitter_button.png" style="height:30px;width:30px"></a>
			<a href="#"><img src="./images/linkedin_icon.png" style="height:30px;width:30px"></a>
			<a href="#"><img src="./images/github_logo.png" style="height:30px;width:30px"></a>
		</div>
	</div>
	

			<div id="main-content" class="blog-main">
				<div style="width:100%;height:80px">
					<?php echo "<h2 class='algerian text-left'>" . $introTop . "</h2>"; ?>		
				</div>
				<div class="col-lg-6 text-center">
						<?php

							if(isset($_POST["viewCustomers"])){
								include_once "./templates/view_users.php";
							}
							else if(isset($_POST["viewOrders"])){
								include_once "./templates/view_orders.php";
							}
							else if(isset($_POST["viewIssues"])){
								include_once "./templates/view_issues.php";
							}
							else if(isset($_POST["viewEmployees"])){
								include_once "./templates/view_employees.php";
							}
							else
								//include_once "./BarcodeTest.php" ;
								echo $leftBox;
						?>
				</div>
				<div class="col-lg-3">
					<?php 
						echo $middleBox ;
					?>
				</div>
				<div class="col-lg-3">
					<?php 
						echo $rightBox ;
					?>
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



