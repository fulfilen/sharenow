<?php
require __DIR__ . '/init.php';

if (userIsLoggedIn())
  Redirect::to('dashboard.php');


require ROOT_PATH . '/views/header.php';
require ROOT_PATH . '/views/nav.php';
?>

<div class="">
	
	<div class="landing">
	<div id="particles"></div>
		<div class="landing-content text-center">
			<h1 class="header">File Sharing and Storing Made Effortlessly Simple</h1>
			<h2 class="sub-header">The secure file sharing and storage solution for almost internet user!</h2>
			<!-- <p class="lead mb-5"> Maximum Allowed size <strong>(100mb)</strong> </p> -->
			<div class="landing-links">
				<button class="btn btn-outline-primary p-2"style="width: 300px; color: #ffffff;" data-toggle="modal" data-target="#registerModal"><strong>Sign Up</strong></button>
				<button class="btn btn-primary p-2"style="width: 300px; color: #ffffff;" data-toggle="modal" data-target="#loginModal"><strong>Sign In</strong></button>
				
			</div>
		</div>
	</div>
</div>

<?php include ROOT_PATH . '/views/modals/loginModal.php'; ?>
<?php include ROOT_PATH . '/views/modals/registerModal.php'; ?>
<?php require ROOT_PATH . '/views/footer.php';?>