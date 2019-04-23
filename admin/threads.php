<?php
require __DIR__ . '/../core/init.php';
require get('path/root') . '/views/header.php';
require get('path/root') . '/views/nav.php';
?>

<?php  $action = ($_GET['action']) ?? NULL ?>


<div class="container-fluid">

  <div class="row">
    <div class="col-md-3">
       <?php include 'left-sidebar.php'; ?>
    </div>
    <div class="col-md-9">
      <?php 

      switch ($action) {

        case 'edit':
          include 'inc/editThread.php';
          break;
        
        default:
          include 'inc/viewThread.php';
          break;
      }


      ?>
    </div>
  </div>
</div>
<?php require get('path/root') . '/views/footer.php'; ?>