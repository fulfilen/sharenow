<!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header" style="border: none;">
				<h2 class="modal-title" id="title">Sign Up</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div id="registerError"></div>
				<form action='register.php' method='POST' id="registerForm">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" id="registerUsername" placeholder="Enter Username" required>
                        <small class="form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control" name="email" id="registerEmail" placeholder="Enter E-mail" required>
                        <small class="form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="registerPassword" placeholder="Password" required>
                        <small class="form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" name="passwordConfirm" id="registerPasswordConfirm" placeholder="Confirm Password" required>
                        <small class="form-text text-danger"></small>
                    </div>

                    <button type="submit" class="btn btn-primary mt-1" id="registerSubmit" style="width: 300px;">Sign Up</button>
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

});
</script>