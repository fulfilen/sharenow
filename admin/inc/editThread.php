<?php 
use Classes\Core\Flash;
use Classes\Core\Request;
use Classes\Core\FormValidator;
use Classes\Model\Thread;
use Classes\Model\Forum;


$tid = (isset($_GET['tid'])) ? (int) $_GET['tid'] : NULL;

$forum = new Forum;
$validate = new FormValidator;
$thread = new Thread;

$singleThread = $thread->single($tid);

if (Request::method('post')) {
    
    
    $validate->addField('content')->validate(['required' => true, 'min' => 3]);
    $validate->addField('title')->validate(['required' => true]);
    $validate->addField('tags')->validate(['required' => true]);

    if ($validate->passed()) {

        if ($thread->update($tid, [
            'title' => Request::get('title'),
            'tags' => Request::get('tags'), 
            'content' => Request::get('content') ])) {

            Flash::set('successm', 'Thread updated Successfully');
        } else {
           
            Flash::set('errorm', 'an error occcured');
        }
    }

    
}

?>



<!-- comment form -->
<div class="article-comment-form">
    <div class="card">
        <div class="card-header">Edit Topic</div>
        <div class="card-body">
            <?php Flash::show(); ?>
            <form action='' method = 'POST'>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" value="<?php echo $singleThread->title; ?>" aria-describedby="titleHelp" placeholder="Enter title">
                    <small class="form-text text-danger"><?php $validate->showFieldError('title') ; ?></small>
                </div>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <small class="form-text text-danger">Sepreated by comma(s) e.g Wizkid,Davido,Olamide</small>
                    <input type="text" class="form-control" name="tags" value="<?php echo $singleThread->tags; ?>" aria-describedby="tagsHelp" placeholder="Enter tags">
                    <small class="form-text text-danger"><?php $validate->showFieldError('tags') ; ?></small>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" name="content" placeholder="What's on your mind?"><?php echo $singleThread->content; ?></textarea>
                    <small class="form-text text-danger"><?php $validate->showFieldError('content') ; ?></small>
                </div>
                <button type="submit" class="btn btn-outline-primary btn-lg">Update Thread</button>
            </form>
        </div>
    </div>
</div>