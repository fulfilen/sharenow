<?php
require __DIR__ . '/../core/init.php';
use Classes\Core\Flash;
use Classes\Model\Video;

$video = new Video;

require get('path/root') . '/views/header.php';
require get('path/root') . '/views/nav.php';
?>

<?php $source = ($_GET['action']) ?? NULL; ?>
<div class="container-fluid">

  <div class="row">
    <div class="col-md-3">
       <?php include 'left-sidebar.php'; ?>
    </div>
    <div class="col-md-9">
      <?php  
      switch ($source) {

        case 'edit':
          include 'inc/editVideo.php';
          break;
        
        default:
          include 'inc/viewVideo.php';
          break;
      }
      ?>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('#posts').DataTable();
});
</script>
<?php require get('path/root') . '/views/footer.php'; ?>
