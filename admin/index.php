<?php
require __DIR__ . '/../init.php';


$totalFiles = $db->get('file')->rowCount();
$recentFiles = $db->query('SELECT * FROM `file`ORDER BY id DESC LIMIT 10')->resultSet();


require ADMIN_PATH . '/../views/header.php';
require ADMIN_PATH . '/../views/nav.php';
?>
<div class="container-fluid">

  <div class="row">
    <div class="col-md-3">
      <?php include 'left-sidebar.php'; ?>
    </div>

    <div class="col-md-9">
      <!-- Website Overview -->
      <div class="card mb-2">
        <div class="card-header"> Website Overview</div>
        <div class="card-body  row">
          <div class="col-md-3">
            <div class="well dash-box">
              <h2><i class="fa fa-user"></i> <?php echo $totalFiles; ?></h2>
              <h4>Users</h4>
            </div>
          </div>
          <div class="col-md-3">
            <div class="well dash-box">
              <h2><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> <?php echo "string"; ?></h2>
              <h4>Pages</h4>
            </div>
          </div>
          <div class="col-md-3">
            <div class="well dash-box">
              <h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> <?php echo $totalFiles; ?></h2>
              <h4>Posts</h4>
            </div>
          </div>
          <div class="col-md-3">
            <div class="well dash-box">
              <h2><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> 12,334</h2>
              <h4>Visitors</h4>
            </div>
          </div>
        </div>
      </div>
      <!-- Latest Users -->
      <div class="card mb-5">
        <div class="card-header">Latest Files</div>
        <div class="card-body">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>FIle Name</th>
                <th>Uploaded By</th>
                <th>Date Uploaded</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              
              <?php foreach ($recentFiles as $file ): ?>
              <tr id="data-id-<?= $file->id; ?>">
                <td><a href=" <?= ROOT_URI; ?>/view/<?= $file->fileToken; ?> " class="card-link"><?= $file->fileName; ?></a></td>
                <td><a href="" class="card-link"> Rocky</a></td>
                <td><?= date('d/m/Y', $file->fileCreatedDate); ?></td>
                <td><button id="btn-id-<?= $file->id; ?>" onclick="deleteRecent(<?= $file->id; ?>)" class="btn btn-danger"><i class="fa fa-trash-o"></i></button></td>
              </tr>
              <?php endforeach; ?>
              
            </tbody>
           
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require ADMIN_PATH . '/../views/footer.php'; ?>
<script>

  function deleteRecent(id)
  {
    var dataID  = $('#data-id-'+id);
     var btnID  = $('#btn-id-'+id);
    $.ajax({
      url: 'ajax.php',
      data: 
      {
        fileID: id,
        deleteRecent: 1
      },
      type: 'POST',
      success: function(response)
      {
        console.log(response);
        if (response == 'deleted')
          dataID.hide(2000);
          btnID.text('Deleting...');
      }
    });
  }

</script>