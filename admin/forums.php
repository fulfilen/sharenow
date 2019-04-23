<?php
require __DIR__ . '/../core/init.php';

use Classes\Core\Flash;
use Classes\Model\Forum;
use Classes\Core\FormValidator;

$forum = new Forum;
$validator =  new FormValidator;

require get('path/root') . '/views/header.php';
require get('path/root') . '/views/nav.php';
?>
<?php  

if (isset($_POST['create-new'])) {

  $validator->addField('title')->validate(['required' => true, 'unique' => 'forums', 'min' => 5]);

  if ($validator->passed()) {

    try {

      $forum->createNew(array(
        'title' => $_POST['title'],
        'slug' => createSlug($_POST['title'])
      ));
      Flash::set('successm', 'Forum Added Successfully');
      unset($_POST);
    } catch (Exception $e) {
      
    }
  }
}


?>

<div class="container-fluid">
  <div class="row">

    <!-- Website left sidebar -->
    <div class="col-md-4">
      <?php include 'left-sidebar.php'; ?>
    </div>

    <!-- Website Overview -->
    <div class="col-md-8">
      <div class="card mb-2">
        <h4 class="card-header"><i class="fa fa-lock"></i> Add Forums</h4>
        <div class="card-body">
          <!-- Form Error Flash Message -->
          <?php Flash::show(); ?>
          <form action='' method='POST' enctype="multipart/form-data">
            <div class="form-group">
              <label for="title">Forum Title</label>
              <input type="text" class="form-control" name="title" aria-describedby="titleHelp" placeholder="Enter Title">
              <small class="form-text text-danger"><?php $validator->showFieldError('title') ; ?></small>
            </div>
            
            <button type="submit" name="create-new" class="btn btn-outline-primary mt-1">Create New</button>
            <div class="form-group">
            </div>
          </form>
        </div>
      </div>
      
      <div class="card">
        <div class="card-header">View All Forums</div>
        <div class="card-body">
          <table class="table table-striped table-hover" id="forum">
            <thead>
              <tr>
                <th>S/N</th>
                <th>Title</th>
                <th>Created</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($forum->lists() as $forum): ?>
              <tr>
                <td><?php echo $forum->id; ?></td>
                <td><?php echo $forum->title; ?></td>
                <td><?php echo timeAgo($forum->created_at); ?></td>
                <td><a class="btn btn-outline-primary" href="edit.html"><i class="fa fa-edit"></i></a> <a class="btn btn-outline-danger" href="#"><i class="fa fa-remove"></i></a></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script>

  $(document).ready(function() {
    $('#forum').DataTable();
});

</script>
<?php require get('path/root') . '/views/footer.php'; ?>