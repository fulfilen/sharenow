<?php
require __DIR__ . '/../core/init.php';

use Classes\Core\Flash;
use Classes\Model\Music;
use Classes\Core\FormValidator;
use Classes\Core\FileUploader;

$music = new Music;
$validator =  new FormValidator;

require get('path/root') . '/views/header.php';
require get('path/root') . '/views/nav.php';
?>
<?php  

if (isset($_POST['create-new'])) {

  $validator->addField('title')->validate(['required' => true, 'unique' => 'music_categories', 'min' => 5]);

  if ($validator->passed()) {

    try {

      if (! empty($_FILES["thumbnail"]["name"]) || !empty($_FILES["thumbnail"]["tmp_name"])){
        $photoUploader = new FileUploader;
        $photoUploader->setMaxSize(6);
        $photoUploader->setAllowedExtensions(['png', 'jpeg', 'jpg']);
        $photoInfo = $photoUploader->getFileInfo('thumbnail');
        $photoUploader->setCustomName(createSlug($_POST['title']));
        $photoDir = 'uploads/' . $photoUploader->getCustomName();
        $photoUploader->upload(get('path/root') .'/'. $photoDir);
      }

      $music->createNewCategory(array(
        'title' => $_POST['title'],
        'slug' => createSlug($_POST['title']),
        'thumbnail' => $photoDir
      ));

      Flash::set('successm', 'Category Added Successfully');
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
        <h4 class="card-header"><i class="fa fa-lock"></i> Add Music Categories</h4>
        <div class="card-body">
          <!-- Form Error Flash Message -->
          <?php Flash::show(); ?>
          <form action='' method='POST' enctype="multipart/form-data">
          
            <div class="form-group">
              <label for="title">Category Title</label>
              <input type="text" class="form-control" name="title" aria-describedby="titleHelp" placeholder="Enter Title">
              <small class="form-text text-danger"><?php $validator->showFieldError('title') ; ?></small>
            </div>
            
            <div class="form-group">
                <label for="title">Featured Image</label>
                <small class="form-text text-muted"></small>
                <input type="file" class="form-control-file" name="thumbnail" value="" aria-describedby="titleHelp" placeholder="Enter title">
                <small class="form-text text-danger"></small>
            </div>

            <button type="submit" name="create-new" class="btn btn-outline-primary mt-1">Create New</button>
            <div class="form-group">
            </div>
          </form>
        </div>
      </div>
      
      <div class="card">
        <div class="card-header">View All Music Categories</div>
        <div class="card-body">
          <table class="table table-striped table-hover" id="forum">
            <thead>
              <tr>
                <th>S/N</th>
                <th>Title</th>
                <th>Created</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($music->getAllCategories() as $category): ?>
              <tr>
                <td><?php echo $category->id; ?></td>
                <td><a href="" class="card-link"><?php echo $category->title; ?></a></td>
                <td><?php echo timeAgo($category->created_at); ?></td>
                <td><a class="btn btn-outline-primary" href="edit.html"><i class="fa fa-edit"></i></a></td>
                <td><a class="btn btn-outline-danger" href="#"><i class="fa fa-remove"></i></a></td>
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
  // DataTable
  $('#forum').DataTable();
  
});

</script>
<?php require get('path/root') . '/views/footer.php'; ?>