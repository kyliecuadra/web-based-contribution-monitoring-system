<?php 
require ("../config/db_connection.php");
session_start();
require ("../config/session_timeout.php");

if(!isset($_SESSION['id'])){
	header("location: ../config/not_login-error.html");
}
else{
	if($_SESSION['userLvl'] == "Admin"){
		header("location: ../config/user_level-error.html");
	}
	if($_SESSION['userLvl'] == "Collector"){
		header("location: ../config/user_level-error.html");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Contribution Summary</title>
		<link rel="icon" href="../assets/img/html_icon.png">
	<meta name="viewport" content="width=device-witdth, initial-scale=1.0">
	<!-- BOOTSTRAP 4 CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- LOCAL CSS -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!-- TOASTR CONFIGS -->
	<script src="js/jquery-1.9.1.min.js"></script>
	<link href="css/toastr.css" rel="stylesheet"/>
	<script src="js/toastr.js"></script>
	<script type="text/javascript" src="../config/toastr_config.js"></script>
	<!-- JQUERY CDN -->
	<script src="js/jquery-3.6.0.min.js"></script>
</head>
<body>
	<div class="sidebar" style="border-right: 1px solid #003860;">
		<div class="menu-details">
			<i class='sidebarBtn'><img src="../assets/icons/menu.png" style="filter: invert(1);"></i>
			<span class="menu-name">Menu</span>
		</div>
		<ul class="nav-links">
			<li>
				<a href="dashboard.php">
					<i><img src="../assets/icons/grid-alt.png" style="filter: invert(1);"></i>
					<span class="link-name">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="summary.php">
					<i class="fa-solid fa-clipboard" style="color:#00FFF3;"><img src="../assets/icons/clipboard-solid.svg" style="height: 24px; filter: invert(92%) sepia(19%) saturate(4902%) hue-rotate(106deg) brightness(106%) contrast(105%);"></i>
					<span class="link-name" style="color:#00FFF3;">Summary</span>	
				</a>
			</li>
			<li>
				<a href="../logout.php">
					<i><img src="../assets/icons/right-from-bracket-solid.svg" style="height: 24px; filter: invert(1);"></i>
					<span class="link-name">Logout</span>
				</a>
			</li>
		</ul>
	</div>
	<!-- Main Content -->
	<section class="home-section">
		<nav>
			<div class="sidebar-button">
				<span class="dashboard">CONTRIBUTION SUMMARY</span>
			</div>
			<div class="btn-group">
				<span class="name d-flex flex-column"><?php echo $_SESSION['fname']; ?><span style="font-size: 15px;">CONTRIBUTOR</span></span>
				<button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span><img src="../assets/icons/user-solid.svg" style="height: 24px; filter: invert(1);"></span>
				</button>
				<div class="dropdown-menu dropdown-menu-right" style="cursor: pointer;">
					<a class="dropdown-item" onclick="edit_userProfile()">User Profile</a>
					<a class="dropdown-item" href="../logout.php">Logout</a>
				</div>
			</div>
		</nav>
		<div class="d-flex justify-content-end">
			<input style="padding: 6px 12px; margin-right: 25px;" type="text" class="mt-4 year-search" id="year-search" placeholder="Search Year" onkeyup="search_year()">
		</div>
		<!-- EDIT USER PROFILE MODAL START -->
			<div class="modal fade" id="userProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header text-white" style="background-color: #023047;">
							<h5 class="modal-title">EDIT USER PROFILE</h5>
							<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form method="POST" action="userProfile.php">
							<div class="modal-body" id="edit-userProfile">
								...
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary" name="update" onclick="updateProfile()">Update Profile</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- EDIT USER PROFILE MODAL END -->
		<div class="container-fluid" id="contribution-records">
			<script>
					// RUN FUNCTION WHEN PAGE IS LOADED
					$(document).ready(function(){
						displayContributionSummary();
					});

					// DISPLAY CONTRIBUTION RECORDS START
					function displayContributionSummary(){
						var displayContributionSummary = "displayContributionSummary";
						$.ajax({
							url: "displayContributionSummary.php",
							type: "POST",
							data: {displayContributionSummary:displayContributionSummary},
							success:function(data,status){
								$('#contribution-records').html(data);
							}
						});
					}
					// DISPLAY CONTRIBUTION RECORDS END

					// DISPLAY EDIT USER PROFILE MODAL START
					function edit_userProfile(){
						var userProfile = "userProfile";

						$.ajax({
							url: "userProfile.php",
							type: "POST",
							data: {userProfile:userProfile},
							success:function(data,status){
								$('#userProfile').modal('show');
								$('#edit-userProfile').html(data);
							}
						});
					}

					function updateProfile(){
						$('#userProfile').modal('hide');
						toastr.success("Profile Updated!");
					}
					// DISPLAY EDIT USER PROFILE MODAL END
				</script>
			</div>

	</section>
	<!-- BOOTSTRAP JS -->
	<script src="js/jquery-3.6.0.min.js"></script>
	<script src="js/bootstrap.bundle.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<!-- DATATABLE -->
	<script type="text/javascript" src="js/datatable/simple-datatables.js"></script>
	<script type="text/javascript" src="js/datatable/tinymce.min.js"></script>
	<script type="text/javascript" src="js/datatable/datatable.js"></script>
	<!-- LOCAL JS -->
	<script type="text/javascript" src="js/year-search.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</body>
</html>