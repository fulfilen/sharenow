<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header" style="border: none;">
				<h2 class="modal-title" id="title">Sign In</h2>
				<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button> -->
			</div>
			<div class="modal-body">
				<div id="loginError" class="alert alert-danger">ERROR: Username or Password is Incorrect</div>
				<div id="loginSuccess" class="alert alert-success">Login was successful!!! <a href="" class="alert-link">CLICK HERE</a> if you're not redirected automatically</div>
				<form action='login.php' method='POST' id="loginForm">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" id="loginUsername" placeholder="Enter Username">
                        <small class="form-text text-danger" id="usernameError"></small>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="loginPassword" placeholder="Password">
                        <small class="form-text text-danger" id="passwordError"></small>
                    </div>
                    <button type="submit" class="btn btn-primary mt-1" id="loginSubmit" style="width: 300px;">Sign In</button>
                </form>
			</div>
			<div class="modal-footer" style="background: #ccc;">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

	// Wait for the DOM to be ready
$(function() {
	$('#loginError').hide();
	$('#loginSuccess').hide();

	$('#loginForm').submit(function() { 
		var username = $('#loginUsername').val();
		var password = $('#loginPassword').val();

	    if (username == ''){ 
	    	$('#usernameError').text('Username is required');
	    } else {
	    	$('#usernameError').text('');
	    }
	  

	    if (password == ''){ 
	    	$('#passwordError').text('Password is required');
	    } else {
	    	$('#passwordError').text('');
	    }
	    

	

	    $.ajax({
	      url: '<?= ROOT_URI ?>/login.php',
	      data: 
	      {
	        username: $('#loginUsername').val(),
	        password: $('#loginPassword').val()
	      },
	      type: 'POST',
	      success: function(response)
	      {
	      	console.log(response);
	        if (response == 'error'){
	          $('#loginError').show();
	        }
	      	
	      	if (response == 'loggedin'){
	      		$('#loginError').hide();
			    $('#loginSuccess').show();
			    $('#loginForm').hide();
	      	}
	          

	      }
	    });
	    return false;   
	});
});
</script>