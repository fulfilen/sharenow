<?php
require __DIR__ . '/init.php';

require ROOT_PATH . '/views/header.php';
require ROOT_PATH . '/views/nav.php';
?>
<?php 

$datas = $db->query('SELECT * FROM file ORDER BY fileCreatedDate DESC LIMIT 20')->resultSet(); 

?>


<div class="container">
	<h1>Latest: <small>Sorted by recently added</small></h1>
	<div class="row">
		<?php foreach ($datas as $data):?>
			<div class="col-md-4">
				<div class="file-info">
					<a href=" <?= ROOT_URI; ?>/view/<?= $data->fileToken; ?> "><strong><?= $data->fileName; ?></strong></a><br>
					Size: <span class="text-muted"><?= getSize($data->fileSize); ?></span><br>
					Downloads: <span class="text-muted"><?= $data->fileDownloadCount; ?></span>
				</div>	
			</div>
		<?php endforeach; ?>

	</div>
</div>
<br>
<br>

<?php require ROOT_PATH . '/views/footer.php';?>