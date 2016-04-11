<!DOCTYPE html>
<?php include_once 'html_doctype_and_head.php'; ?>
<body>
<style>
    .appear #ref p {display:none;}
    .appear #ref:hover p {display:block;}
</style>

<?php ?>
	<div class="container-fluid">
		<div class="row-fluid" style="margin-top: 20px">
			<div class="span12" style="margin-top:40px;padding:10px;margin-bottom:10px; background:rgba(255,255,255,0.1);">
					<div id="hideContent">
						<div class="col-lg-4">
							<h3 style='font-family:"Lucida Console", Monaco, monospace'>Create Your Own Stamps</h3>
							<div class="appear">
								
								<p id=ref>With the generic QR Coding system you will be able to create your own postal stamps from your own home.
								       
									<p>
									
											<span class="glyphicon glyphicon-chevron-right"></span>&nbsp&nbspEnsure you have a Stripe account setup.<br>
										
											<span class="glyphicon glyphicon-chevron-right"></span>&nbsp&nbspStamps only last a limited time.<br>
										
											<span class="glyphicon glyphicon-chevron-right"></span>&nbsp&nbspOnce the stamp has been scanned and approved you will not have to worry about dealing with payments.<br>
									</p>
								</p>
							</div>

						</div>
						<div class="col-lg-4">
							<h3 style='font-family:"Lucida Console", Monaco, monospace'>Create Your Own Events</h3>
							<p>
								Host events for your close friends (Max 20 invites).
								<p>
									<span class="glyphicon glyphicon-chevron-right"></span>&nbsp&nbspCreate events with your friends and email them the invites.<br>
									<span class="glyphicon glyphicon-chevron-right"></span>&nbsp&nbspView your own events whether you be the host or the guest.<br>
									<span class="glyphicon glyphicon-chevron-right"></span>&nbsp&nbspManage your events and maintain control of attendence.<br>
								</p>
							</p>
						</div>
						<div class="col-lg-4">
							<h3 style='font-family:"Lucida Console", Monaco, monospace'>Create Your Own Parking Tickets</h3>
							<p>
								Create a dynamic car park ticket to allow you to top up and extend your stay using our online application.
								<p>
									<span class="glyphicon glyphicon-chevron-right"></span>&nbsp&nbspGenerate your ticket to display in your car.<br>

									<span class="glyphicon glyphicon-chevron-right"></span>&nbsp&nbspChoose an expiry date at a later time on during creation.(Remember failure to top up this ticket within the 24hrs will result in it being deactivated)<br>

									<span class="glyphicon glyphicon-chevron-right"></span>&nbsp&nbspYou will receive a reminder text approaching your expiry time.
								</p>		  
							</p>
						</div>
					</div>
					<br>
					<br>
				
			</div>
			
			<div class="col-lg-4">
			</div>

			<div class="col-lg-4">
			
			<?php
				echo $middleBox;
			?>	
			</div>
			
			<div class="col-lg-4">
			</div>

		<!-- Start navbar div-->
		<div class="navbar navbar-fixed-top navbar-inverse">
			<!-- Start  of container div-->
			<div class="container-fluid">
				<!-- navbar header-->
				<div class="navbar-header">
					
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navBar1">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div> <!-- End of Navbar Header-->
					
				<!-- Start of navbar-collapse div-->
				<div class="collapse navbar-collapse" id="navBar1">
				<div class="navbar-header">
      				<h2 style='font-family:"Lucida Console", Monaco, monospace'>Qr Coding System</h2>
    			</div>
					<!-- Start of navbar unordered list-->
					<ul class="nav nav-tabs navbar-right" style='padding-top: 17px'>
						<li><a href="#"  class="redundant"></a></li>
						<li><a href="?buttonLogin=searchButton" class="#">About</a></li>
						<li><a href="?buttonLogin=login" >Login</a></li>
						<li><a href="?buttonLogin=registerbutton">Register</a></li>
						<li><a href="#"  class="redundant"></a></li>
					</ul>	
				</div><!-- End of navbar-collapse div-->
			</div><!-- End of container div-->
		</div><!-- End of navbar div-->

	</div>
	</div>
</body>
<script>
/*
$(function () {
    $('.loginFormButton').live('click', function () {
        $('#hideContent').toggle();
    });
});*/

$( "#notSearch" ).click(function() {
  $( "#hideContent" ).slideToggle( "slow", "linear" );
});
</script>

</html>

