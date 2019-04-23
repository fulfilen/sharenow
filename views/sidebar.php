<?php 

?>

 <div class="card">
    <div class="card-header">Search</div>
    <div class="card-body">
        <form action='<?php ROOT_URI; ?>/forum/search.php' method ='POST'>
            <div class="form-group">
                <label for="search"></label>
                <input type="text" class="form-control" name="search" placeholder="Enter search" required>
                <small class="form-text text-muted form-error"></small>
            </div>
            <input type="submit" value="Search Website" class="btn btn-outline-primary btn-lg">
        </form>
    </div>
</div>

<!-- adsense -->
<div class="card mt-2">
    <div class="card-header">Advertisements</div>
    <div class="card-body">
        
    </div>
</div>


<!-- <div class="card mt-2">
    <div class="card-header">NewsLetter.</div>
    <div class="card-body">
        <p class="card-text">
            Receive our latest articles, songs and videos to your email. We promise we do not spam.
        </p>
        <form action='' method ='POST'>
            <div class="form-group">
                <label for="search"></label>
                <input type="email" class="form-control" name="search" placeholder="Email">
            </div>
            <button type="submit" class="btn btn-outline-primary btn-lg">Subscribe</button>
            <div class="form-text text-muted text-center"></div>
        </form>
    </div>
</div> -->

<!-- <div class="card mt-2">
    <div class="card-header">Suggessions</div>
    <div class="card-body text-center">
        <img class="rounded-circle" src="http://localhost/mini-forum/storage/post_media_files/pp.jpg" width="50">
    
        <span class="card-title"><strong>John Doe</strong></span>
        <p class="card-text"><span class="">10 photos</span> <span class="">89 followers</span></p>
        
        <a href="#" class="btn btn-xs btn-outline-primary"><i class="fa fa-comment"></i> Message</a>
        <a href="#" class="btn btn-xs btn-primary">following <i class="fa fa-check-circle"></i></a> 
    </div>
    <div class="card-body text-center">
        <img class="rounded-circle" src="http://localhost/mini-forum/storage/post_media_files/pp.jpg" width="50">
    
        <span class="card-title"><strong>John Doe</strong></span>
        <p class="card-text"><span class="">10 photos</span> <span class="">89 followers</span></p>
        
        <a href="#" class="btn btn-xs btn-outline-primary"><i class="fa fa-comment"></i> Message</a>
        <a href="#" class="btn btn-xs btn-outline-primary"><i class="fa fa-check-circle"></i> follow</a> 
    </div>
</div> -->


<?php
//mkdir('uploads/' . date('Y/m'), 0777, true);?>
       