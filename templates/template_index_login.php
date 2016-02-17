<!DOCTYPE html>
<?php include_once 'html_doctype_and_head.php'; ?>
<body>

<?php ?>
	<div class="container-fluid">
		<div class="row-fluid" style="margin-top: 20px">
			<div class="span12" style="background-color:lavender;margin-top:40px;padding:10px;margin-bottom:10px; background:rgba(255,255,255,0.1);">
					<div id="hideContent">
						<div class="col-lg-4">
							<h3 class="algerian">Text Heading One</h3>
							<p style="color:white">
								View our latest list of movie title, search by title, cast member, date, ratings.
								ADD A QUESTION BUTTON TO EXPLAIN THE DIFFERENT OPTIONS TO SEARCH
							</p>
						</div>
						<div class="col-lg-4">
							<h3 class="algerian">Text Heading 2</h3>
							<p style="color:white">
								Our system is linked alongside the IMDB Database. So feel free to search through their movies to view , compare and comment(if your registered) on any 
								movie, series, game you wish.  
							</p>
						</div>
						<div class="col-lg-4">
							<h3 class="algerian">Text Heading 3</h3>
							<p style="color:white">
								Why not have your say about your favourite movies. Register with us so you too can rate, comment and even add your own movie titles.
								Its just a step away until your opinion matters to us and other viewers.
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
      				<a class="navbar-brand" href="#">Online Generic Barcode System</a>
    			</div>
					<!-- Start of navbar unordered list-->
					<ul class="nav nav-tabs navbar-right">
						<li><a href="#"  class="redundant"></a></li>
						<li><a href="?buttonLogin=searchButton" class="#">Search</a></li>
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

