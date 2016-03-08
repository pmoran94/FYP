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
									<span class="glyphicon glyphicon-th-list"></span>
									</a>
								</li>
								<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown">Profile<span class="caret"></span></a>
	     							<ul class="dropdown-menu">
										<li><a href="?eUserValue=viewDetails"><span class="glyphicon glyphicon-user"></span>View Profile</a></li>
										<li><a href="?eUserValue=editDetails"><span class="glyphicon glyphicon-cog"></span>Edit Profile</a></li>
									</ul>
								</li>
								<li class=""><a href='?empButton=liopenScanner'>___Open Parking Data___</a></li>
								<li class=""><a href='#'></a></li>
								<li class=""><a href='?empButton=lireportIssue'>Report Issue</a></li>
								<li class=""><a href='?empButton=liPassChange' name="changePass">Change Pin</a></li>
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

		<h3 class="text-center" ><?php echo $appName;?> </h3>
		<ul class="sidebar-nav">
			<li class="btn-block"><a href="?eUserValue=viewIssues">View Issues</a></li>
			<li class="btn-block"><a href="?eUserValue=deleteCustomer">Delete Customer</a></li>
			<li class="btn-block"><a href="?eUserValue=viewScannedCodes">View Scanned Data</a></li>
		</ul>
	</div>
	

			<div id="main-content" class="blog-main">
				<div style="width:100%;height:80px">
					<?php echo "<h2 class='text-center'>" . $introTop . "</h2>";?>		
				</div>
				<div class="col-lg-1">
				</div>
				<div class="col-lg-5 text-left">
					<div class='jumbotron'>
						<?php
								//include_once "./BarcodeTest.php" ;
							echo $empLeftBox;
						?>
					</div>
				</div>
				<div class="col-lg-5">
					<?php 
						$userDropMenu;
						
						if (! empty($_GET['eUserValue'])) $userDropMenu = $_GET['eUserValue'];
						else $userDropMenu = "";

						

						if( isset($userDropMenu))
							if($userDropMenu=='viewDetails')
								include_once 'employeeDetails.php';
							else if($userDropMenu=='editDetails')
								include_once 'editEmployeeDetails.php';
						else if(isset($_POST['editUserDetailsP']))
							include_once 'editUserDetails.php';
						echo $middleBox ;
					?>
					
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



