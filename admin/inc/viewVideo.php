<?php
use Classes\Core\Flash;
use Classes\Model\Video;
$video = new Video;
?>
<!-- Website Overview -->
<div class="card">
  <div class="card-header">View All Videos</div>
  <div class="card-body">
    <table class="table table-striped table-hover" id="posts">
      <thead>
        <tr>
          <th><input type="checkbox" name="checkbox" id="checkAllBoxes"></th>
          <th>S/N</th>
          <th>Author</th>
          <th>Category</th>
          <th>Music Title</th>
          <th>Views</th>
          <th>DLoads</th>
          <th>Date</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($video->getAllpost() as $video): ?>
        <tr>
          <td><input type="checkbox" name="checkboxArray[]" class="checkboxes"></td>
          <td>#<?php echo $video->id; ?></td>
          <td><a href="<?php echo get('url/root'); ?>/user/@<?php echo $video->author; ?>" class="card-link"><?php echo $video->author; ?></a></td>
          <td><a href="" class="card-link"><?php echo $video->categoryTitle; ?></a></td>
          <td><a href="" class="card-link"><?php echo $video->title; ?></a></td>
          <td><div class="badge badge-pill badge-danger"><i class="fa fa-eye"></i> <?php echo $video->views; ?> Views</div></td>
          <td><div class="badge badge-pill badge-success"><i class="fa fa-download"></i> <?php echo $video->downloads; ?> Downloads</div></td>
          <td><?php echo timeAgo($video->created_at); ?></td>
          <td><a class="btn btn-outline-primary" href="?action=edit&vid=<?php echo $video->id; ?>"><i class="fa fa-edit"></i></a></td>
          <td><a class="btn btn-outline-danger" href="edit.html"><i class="fa fa-remove"></i></a></a></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<script>
$(document).ready(function() {
  let allCheckBoxes = $('#checkAllBoxes');
  let checkboxes = $('.checkboxes');

  allCheckBoxes.on('change', function(){
    if (this.checked) {
      checkboxes.each(function(){
        this.checked = true;
      });
    } else {
      checkboxes.each(function(){
        this.checked = false;
      });
    }

  });
  $('#posts').DataTable();
});
</script>