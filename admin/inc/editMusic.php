<?php 
use Classes\Core\Flash;
use Classes\Core\Request;
use Classes\Core\FormValidator;
use Classes\Model\Music;



$mid = (isset($_GET['mid'])) ? (int) $_GET['mid'] : NULL;

$validate = new FormValidator;
$music = new Music;

$singleMusic = $music->single($mid);

if (Request::method('post')) {
    
    $validate->addField('category')->validate(['required' => true]);
    $validate->addField('content')->validate(['required' => true, 'min' => 3]);
    $validate->addField('title')->validate(['required' => true]);
    $validate->addField('name')->validate(['required' => true]);
    $validate->addField('artiste')->validate(['required' => true]);
    $validate->addField('tags')->validate(['required' => true]);

    if ($validate->passed()) {

        if ($music->updatePost($mid, [
            'category_id' => Request::get('category'), 
            'title' => Request::get('title'),
            'artiste' => Request::get('artiste'),
            'name' => Request::get('name'),
            'slug' => createSlug(Request::get('title')),
            'tags' => Request::get('tags'), 
            'content' => Request::get('content') ])) {

            Flash::set('successm', 'Music updated Successfully');
        } else {
           
            Flash::set('errorm', 'an error occcured');
        }
    }

    
}

?>



<!-- comment form -->
<div class="article-comment-form">
    <div class="card">
        <div class="card-header">Edit Music</div>
        <div class="card-body">
            <?php Flash::show(); ?>
            <form action='' method = 'POST'>

                <div class="form-group">
                    <label for="title">Category</label>
                    <select name="category" id="category" class="form-control">
                        <option value=''>--Choose--</option>
                        <?php foreach ($music->categories() as $category): ?>
                            <option value='<?php echo $category->id; ?>'><?php echo $category->title; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <small class="form-text text-danger"><?php $validate->showFieldError('category') ; ?></small>
                </div>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" value="<?php echo $singleMusic->title; ?>" aria-describedby="titleHelp" placeholder="Enter title">
                    <small class="form-text text-danger"><?php $validate->showFieldError('title') ; ?></small>
                </div>

                <div class="form-group">
                    <label for="name">Music Name</label>
                    <small class="form-text text-danger"></small>
                    <input type="text" class="form-control" name="name" value="<?php echo ''; ?>" aria-describedby="nameHelp" placeholder="Enter name">
                    <small class="form-text text-danger"><?php $validate->showFieldError('name') ; ?></small>
                </div>


                <div class="form-group">
                    <label for="artiste">Artiste(s)</label>
                    <small class="form-text text-danger"></small>
                    <input type="text" class="form-control" name="artiste" value="<?php echo ''; ?>" aria-describedby="artisteHelp" placeholder="Enter artiste">
                    <small class="form-text text-danger"><?php $validate->showFieldError('artiste') ; ?></small>
                </div>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <small class="form-text text-danger">Sepreated by comma(s) e.g Wizkid,Davido,Olamide</small>
                    <input type="text" class="form-control" name="tags" value="<?php echo $singleMusic->tags; ?>" aria-describedby="tagsHelp" placeholder="Enter tags">
                    <small class="form-text text-danger"><?php $validate->showFieldError('tags') ; ?></small>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" name="content" placeholder="What's on your mind?"><?php echo $singleMusic->content; ?></textarea>
                    <small class="form-text text-danger"><?php $validate->showFieldError('content') ; ?></small>
                </div>
                <button type="submit" class="btn btn-outline-primary btn-lg">Update Music</button>
            </form>
        </div>
    </div>
</div>