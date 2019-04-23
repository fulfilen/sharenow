<?php  

use Classes\Core\Flash;
use Classes\Model\Thread;

$thread = new Thread;

?>


<!-- Website Overview -->
<div class="card">
  <div class="card-header">Posts</div>
  <div class="card-body">
    <table class="table table-striped table-hover" id="posts">
      <thead>
        <tr>
          <th>S/N</th>
          <th>Author</th>
          <th>Forum</th>
          <th>Category</th>
          <th>Post_Title</th>
          <th>Views</th>
          <th>Created Date</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($thread->getAll() as $thread): ?>
        <tr>
          <td>#<?php echo $thread->topic_id; ?></td>
          <td><a href="<?php echo get('url/root'); ?>/user/@<?php echo $thread->author; ?>" class="card-link"><?php echo $thread->author; ?></a></td>
          <td><a href="" class="card-link"><?php echo $thread->forum_title; ?></a></td>
          <td><a href="" class="card-link"><?php echo $thread->category_title; ?></a></td>
          <td><a href="" class="card-link"><?php echo $thread->title; ?></a></td>
          <td><div class="badge badge-pill badge-danger"><i class="fa fa-eye"></i> <?php echo $thread->views; ?> Views</div></td>
          <td><?php echo timeAgo($thread->created_at); ?></td>
          <td><a class="btn btn-primary" href="?action=edit&tid=<?php echo $thread->topic_id; ?>"><i class="fa fa-edit"></i></a></td>
          <td><a onclick="javascript: return confirm('You want to Delete <?php echo $thread->category_title; ?> Category')" class="btn btn-danger" href=""><i class="fa fa-remove"></i></a></a></td>
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