<!-- <div>
	<div class="card">
		<div class="card-header">Navigation</div>
		<div class="card-body">
			<div class="list-group list-group-flush">
				<a href="index.php" class="list-group-item mb-2">
					<i class="fa fa-cog"></i> Dashboard
				</a>
				<a href="threads.php" class="list-group-item mb-2">
				<i class="fa fa-clone"></i> Threads </a>
				<a href="music.php" class="list-group-item mb-2">
				<i class="fa fa-music"></i> Music </a>
				<a href="users.html" class="list-group-item mb-2">
				<i class="fa fa-camera"></i> Video </a>
			</div>
		</div>
	</div>
</div> -->



<!-- <div class="sibar-nav">
	<div class="card">
		<div class="card-header">Navigation</div>
		<div class="card-body">
			<ul class="list-group list-group-flush">
			  <li class="list-group-item"><a href="index.php" class="list-group-item"><i class="fa fa-cog"></i> Dashboard</a></li>
			  <li class="list-group-item"><a href="javascript:void();" class="list-group-item"><i class="fa fa-clone"></i> Threads </a>
			  		<ul class="list-group list-group-flush">
					  <li class="list-group-item"><a href="fcategories.php" class="list-group-item"><i class="fa fa-edit"></i> Add Category</a></li>
					  <li class="list-group-item"><a href="threads.php" class="list-group-item"><i class="fa fa-eye"></i> View All </a></li>
					</ul>
			  </li>
			  <li class="list-group-item"><a href="javascript:void();" class="list-group-item"><i class="fa fa-music"></i> Music </a>
			  		<ul class="list-group list-group-flush">
					  <li class="list-group-item"><a href="mcategories.php" class="list-group-item"><i class="fa fa-edit"></i> Add Category</a></li>
					  <li class="list-group-item"><a href="music.php" class="list-group-item"><i class="fa fa-eye"></i> View All </a></li>
					</ul>
			  </li>
			  <li class="list-group-item"><a href="javascript:void();" class="list-group-item"><i class="fa fa-camera"></i> Video </a>
			  		<ul class="list-group list-group-flush">
					  <li class="list-group-item"><a href="vcategories.php" class="list-group-item"><i class="fa fa-edit"></i> Add Category</a></li>
					  <li class="list-group-item"><a href="video.php" class="list-group-item"><i class="fa fa-eye"></i> View All </a></li>
					</ul>
			  </li>
			</ul>
		</div>
	</div>
</div> -->

<div class="sibar-nav">
	<div class="card">
		<div class="card-header">Navigation</div>
		<div class="card-body">
			  <div class="dd-accordion-cotainer">
				    <button class="dd-accordion"><i class="fa fa-comment"></i> Threads</button>
				    <ul class="dd-accordion-content">
				      <li class="dd-item"><a href="fcategories.php"><i class="fa fa-edit"></i> Add Category</a></li>
					  <li class="dd-item"><a href="threads.php"><i class="fa fa-eye"></i> View All </a></li>
				    </ul>


				    <button class="dd-accordion"><i class="fa fa-music"></i> Music</button>
				    <ul class="dd-accordion-content">
				      	<li class="dd-item"><a href="mcategories.php"><i class="fa fa-edit"></i> Add Category</a></li>
						<li class="dd-item"><a href="music.php"><i class="fa fa-eye"></i> View All </a></li>
				    </ul>


				    <button class="dd-accordion"><i class="fa fa-camera"></i> Video</button>
				    <ul class="dd-accordion-content">
				      	<li class="dd-item"><a href="vcategories.php"><i class="fa fa-edit"></i> Add Category</a></li>
						<li class="dd-item"><a href="video.php"><i class="fa fa-eye"></i> View All </a></li>
				    </ul>
			  </div>
		</div>
	</div>
</div>

<script>
var accordions = document.getElementsByClassName("dd-accordion");
for (var i = 0; i < accordions.length; i++) {
  accordions[i].onclick = function() {
    this.classList.toggle('dd-is-open');

    var content = this.nextElementSibling;
    if (content.style.maxHeight) {
      // accordion is currently open, so close it
      content.style.maxHeight = null;
    } else {
      // accordion is currently closed, so open it
      content.style.maxHeight = content.scrollHeight + "px";
    }
  }
}
</script>






