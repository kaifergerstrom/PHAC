<link rel="stylesheet" type="text/css" href="css/header.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<?php include("includes/upload.php"); ?>

<header class="header">
	

	<div class="header-options">
		<a href="">Home</a>
		<div class="option-spacer"></div>
		<a href="">Membership</a>
		<div class="option-spacer"></div>
		<a href="">Mission</a>
		<div class="option-spacer"></div>
		<a href="">History</a>
		<div class="option-spacer"></div>
		<a href="">Archive</a>
	</div>


	<div class="header-search">
		<input type="text" class="header-search-input" placeholder="Search for anything">
		<i class="fas fa-search"></i>
	</div>

	<button class="open-upload-header" type="button" id="open-upload-header"><i class="fas fa-plus"></i> ADD POST</button>

	<div class="header-notifications">
		<i class="far fa-user"><div class="notifications-amount">7</div></i>
		<div class="icon-spacer"></div>
		<i class="far fa-comment-alt"></i>
		<div class="icon-spacer"></div>
		<i class="far fa-bell"></i>
	</div>

	<img src="/PHAC/img/profiles/default.png" class="header-profile-img">

</header>

<script src="js/upload.js"></script>