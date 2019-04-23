<?php

use Classes\Core\Flash;
use Classes\Model\Music;

$music = new Music;

?>

<!-- Website Overview -->
<div class="card">
  <div class="card-header">View All Songs</div>
  <div class="card-body">
    <table class="table table-striped table-hover" id="posts">
      <thead>
        <tr>
          <th>S/N</th>
          <th>Author</th>
          <th>Category</th>
          <th>Music Title</th>
          <th>Views</th>
          <th>DLoads</th>
          <th>Created Date</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($music->getAllpost() as $music): ?>
        <tr>
          <td>#<?php echo $music->id; ?></td>
          <td><a href="<?php echo get('url/root'); ?>/user/@<?php echo $music->author; ?>" class="card-link"><?php echo $music->author; ?></a></td>
          <td><a href="" class="card-link"><?php echo $music->categoryTitle; ?></a></td>
          <td><a href="" class="card-link"><?php echo $music->title; ?></a></td>
          <td><div class="badge badge-pill badge-danger"><i class="fa fa-eye"></i> <?php echo $music->views; ?> Views</div></td>
          <td><div class="badge badge-pill badge-success"><i class="fa fa-eye"></i> <?php echo $music->downloads; ?> Downloads</div></td>
          <td><?php echo timeAgo($music->created_at); ?></td>
          <td><a class="btn btn-outline-primary" href="?action=edit&mid=<?php echo $music->id; ?>"><i class="fa fa-edit"></i></a></td>
          <td><a class="btn btn-outline-danger" href=""><i class="fa fa-remove"></i></a></a></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<script>
$(document).ready(function() {
$('#posts').DataTable();
});
</script>