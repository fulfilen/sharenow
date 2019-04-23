<?php
require __DIR__ . '/init.php';

require ROOT_PATH . '/views/header.php';
require ROOT_PATH . '/views/nav.php';
?>

<?php 
if (isset($_GET['f'])) {
	// echo $_GET['f'];
}

$token = ($_GET['f']) ?? NULL;
//var_dump($db->get('file', array('fileToken', '=', $token)));
$data = $db->get('file', array('fileToken', '=', $token))->result(); 

?>

<br><br>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<h2 class="card-header">File Details</h2>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="file-ino">
								<ul class="list-group">
								  <li class="list-group-item"><i class="fa fa-file"></i> <strong><?= ucwords($data->fileName); ?></strong></li>
								  <li class="list-group-item"><i class="fa fa-file-o"></i> File Size &rarr; <span class="text-muted"><?= getSize($data->fileSize); ?></span></li>
								  <li class="list-group-item"><i class="fa fa-calendar"></i> Uploaded Date &rarr; <span class="text-muted"><?= date('l, jS F, Y',$data->fileCreatedDate); ?></span></li>
								  <li class="list-group-item"><i class="fa fa-download"></i> Downloads &rarr; <span class="text-muted"><?= $data->fileDownloadCount; ?></span></li>
								</ul>
								<div class="text-center"><a href="<?= ROOT_URI. '/download/' .$data->fileToken ; ?>" class="btn btn-primary" style="width:40%; padding: 10px; margin: 10px;">DOWNLOAD</a></div>
							</div>
						</div>
						<div class="col-md-6">
							
							<div class="file-inf">
								<form>
								  <div class="form-group">
								    <label for="exampleInputEmail1">File Link </label>
								    <input type="email" class="form-control" value="<?= ROOT_URI; ?>/view/<?= $data->fileToken; ?>" onclick="this.select()"">
								  </div>
								  <div class="form-group">
								    <label for="html-code">HTML Code (For Websites)</label>
								    <input type="text" class="form-control" value="<a href='<?= ROOT_URI; ?>/view/<?= $data->fileToken; ?>'><?= $data->fileName; ?> (<?= getSize($data->fileSize); ?>)</a>" onclick="this.select()">
								  </div>
								  <div class="form-group">
								    <label for="html-code">Direct Download</label>
								    <input type="text" class="form-control" value="<?= ROOT_URI; ?>/download/<?= $data->fileToken; ?>" onclick="this.select()">
								  </div>
								</form>
							</div>
						</div>
					</div>
					<div class="sharethis-inline-share-buttons pt-3"></div>
				</div>
			</div>
			
		</div>

	</div>
</div>
<br>
<br>
<?php require ROOT_PATH . '/views/footer.php';?>