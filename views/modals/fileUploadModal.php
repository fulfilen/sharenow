<!-- Modal -->
<div class="modal fade" id="fileUploadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header" style="border: none;">
				<h2 class="modal-title" id="title">Upload File</h2>
				<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button> -->
			</div>
			<div class="modal-body">
				<div class="text-center">
					<div id="status"></div>
					<!-- progress bar -->
					<div class="progress">
						<div class="progress-bar .progress-bar-animated progress-bar-striped bg-primary" role="progressbar" style="width: 0%; height: 20px;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
					</div>
					<!-- upload form -->
					<form action='<?= ROOT_URI; ?>/upload.php' method='POST' enctype="multipart/form-data" id="browse">
						<div class="form-group">
							<input type="file" class="form-control-file" name="file" id="file" aria-describedby="titleHelp" required>
							<small class="form-text text-danger"></small>
						</div>
						<!-- submit button -->
						<button type="submit" class="btn btn-primary" name="submit" id="upload" style="width: 300px;"><strong>Uplod File</strong></button>
					</form>
				</div>
			</div>
			<div class="modal-footer" style="background: #ccc;">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script>
	
	$(function() {
	var bar = $('.progress-bar');
	var percent = $('.progress-bar');
	var progress = $('.progress');
	var status = $('#status');
	var button = $('#upload');
	var file = $('#file');
	var title = $('#title');
	$('#browse').ajaxForm({
		beforeSend: function() {
			status.empty();
			var percentVal = '0%';
			var intVal = '0';
			bar.width(percentVal).attr('aria-valuenow', intVal);
			percent.html(percentVal);
			progress.css('display', 'flex');
			// button.attr('disabled', 'disabled');
			// file.attr('disabled', 'disabled');
		},
		uploadProgress: function(event, position, total, percentComplete) {
			var percentVal = percentComplete + '%';
			var intVal = percentComplete;
			bar.width(percentVal).attr('aria-valuenow', intVal);
			percent.html(percentVal);
			progress.css('display', 'flex');
			// button.attr('disabled', 'disabled');
			// file.attr('disabled', 'disabled');
			if (intVal == '100') {
				progress-bar.removeClass('bg-primary');
				progress-bar.addClass('bg-success');
				status.html('<div class="alert alert-danger" role="alert">Generating Details</div>');
			}
		},
		complete: function(xhr) {
			bar.width('100%');
			percent.html('100%');
			file.val('');
			// $('#browse').remove();
			$('.progress').remove();
			// $('#desc').remove();
			title.html('<h1>File Details</h1>');
			status.html('<div class="file-info  text-left">'+xhr.responseText+'</div>');
		}
	});
	
});
</script>