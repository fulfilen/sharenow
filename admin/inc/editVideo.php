<?php 
use Classes\Core\Flash;
use Classes\Core\Request;
use Classes\Core\FormValidator;
use Classes\Model\Video;



$vid = (isset($_GET['vid'])) ? (int) $_GET['vid'] : NULL;

$validate = new FormValidator;
$Video = new Video;

$singleVideo = $Video->single($vid);

if (Request::method('post')) {
    
    $validate->addField('category')->validate(['required' => true]);
    $validate->addField('description')->validate(['required' => true, 'min' => 3]);
    $validate->addField('title')->validate(['required' => true]);
    $validate->addField('slug')->validate(['required' => true]);
    $validate->addField('tags')->validate(['required' => true]);

    if ($validate->passed()) {

        if ($Video->updatePost($vid, [
            'category_id' => Request::get('category'), 
            'title' => Request::get('title'),
            'slug' => createSlug(Request::get('title')),
            'tags' => Request::get('tags'), 
            'description' => Request::get('description') ])) {

            Flash::set('successm', 'Video updated Successfully');
        } else {
           
            Flash::set('errorm', 'an error occcured');
        }
    }

    
}

?>



<!-- comment form -->
<div class="article-comment-form">
    <div class="card">
        <div class="card-header">Edit Video</div>
        <div class="card-body">
            <?php Flash::show(); ?>
            <form action='' method = 'POST'>

                <div class="form-group">
                    <label for="title">Category</label>
                    <select name="category" id="category" class="form-control">
                        <option value=''>--Choose--</option>
                        <?php foreach ($Video->categories() as $category): ?>
                            <option value='<?php echo $category->id; ?>'><?php echo $category->title; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <small class="form-text text-danger"><?php $validate->showFieldError('category') ; ?></small>
                </div>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" value="<?php echo $singleVideo->title; ?>" aria-describedby="titleHelp" placeholder="Enter title">
                    <small class="form-text text-danger"><?php $validate->showFieldError('title') ; ?></small>
                </div>

                <div class="form-group">
                    <label for="slug">Video Slug</label>
                    <small class="form-text text-danger"></small>
                    <input type="text" class="form-control" name="slug" value="<?php echo $singleVideo->slug; ?>" aria-describedby="slugHelp" placeholder="Enter slug">
                    <small class="form-text text-danger"><?php $validate->showFieldError('slug') ; ?></small>
                </div>

                <div class="form-group">
                    <label for="tags">Tags</label>
                    <small class="form-text text-danger">Sepreated by comma(s) e.g Wizkid,Davido,Olamide</small>
                    <input type="text" class="form-control" name="tags" value="<?php echo $singleVideo->tags; ?>" aria-describedby="tagsHelp" placeholder="Enter tags">
                    <small class="form-text text-danger"><?php $validate->showFieldError('tags') ; ?></small>
                </div>
                <div class="form-group">
                    <label for="description">description</label>
                    <textarea class="form-control" name="description" placeholder="What's on your mind?"><?php echo $singleVideo->description; ?></textarea>
                    <small class="form-text text-danger"><?php $validate->showFieldError('description') ; ?></small>
                </div>
                <button type="submit" class="btn btn-outline-primary btn-lg">Update Video</button>
            </form>
        </div>
    </div>
</div>