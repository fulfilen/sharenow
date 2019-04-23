<!-- Modal -->
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="commentModalLongTitle">Add Comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <?php Core\Classes\Flash::show(); ?>
            <form action = '' method = 'POST'>
                <div class="form-group">
                    <label for="author"></label>
                    <input type="hidden" class="form-control" name="author" value="<?php echo 'Rocky'; ?>" aria-describedby="authorHelp" placeholder="Enter author">
                    <small class="form-text text-muted form-error"><?php $validate->showFieldError('author') ; ?></small>
                </div>
                <div class="form-group">
                    <label for="comment">comment</label>
                    <textarea class="form-control" name="comment" placeholder="What's on your mind?"></textarea>
                    <small class="form-text text-muted form-error"><?php $validate->showFieldError('comment') ; ?></small>
                </div>
                <button type="submit" class="btn btn-outline-primary btn-block mt-5">Login</button>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>