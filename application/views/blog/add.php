<div class="container">
	<form role="form" method="post" action="<?php echo base_url('blog/addBlogPost')?>">
	<div class="row">
		<div class="col-sm-8">
			<div>
		<h2>Add New Blog</h2>
				<?php if($this->session->flashdata('error')){ ?>
				<div class="alert alert-warning" role="alert">
					<?php echo $this->session->flashdata('error') ?>
				</div>
				<?php } ?>
				
					<div class="form-group">
						<label for="title">Title:</label>
						<input type="text" class="form-control" id="title" name="title">
					</div>
					<div class="form-group">
						<label for="url">URL:</label>
						<input type="text" class="form-control" id="url" name="url">
					</div>
					<div class="form-group">
						<label for="author_name">Author Name:</label>
						<input type="text" class="form-control" id="author_name" name="author_name">
					</div>

					<div class="form-group">
						<label for="content">Content:</label>
						<textarea class="form-control" id="content" name="content"></textarea>
					</div>
					

					<div class="form-group">
						<label for="active">Active:</label>
						<input type="checkbox" name="active" value="checked">
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
			
			</div>
		</div>
		<div class="col-sm-4">
			<div class="card">
				<div class="card-body">
				<div class="form-group">
						<label for="image">Image:</label><br>
						<input type="text" class="form-control mb-1" id="image" name="image">
						<div class="blogImage">
							<img id="bImg" src="" alt="">
						</div>
					</div>
				</div>
			</div>
			<div class="card mt-5">
				<div class="card-body">
					<div class="d-flex col">
					<h5 class="card-title flex-1">Category</h5>
					<a class="primary-btn" href="<?php echo base_url('category/add'); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
						<path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
						<path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
					</svg>
					</a>
					</div>
					<div class="internal-scroll">
						<ul class="list-group list-group-flush">
						<?php $i=1; foreach($Categories as $category) { ?>
							<li class="list-group-item d-flex edit-item">
								<div class="">
									<input type="checkbox" name="category[]" value="<?= $category->id ?>"></option> &nbsp;
									<!-- <?php echo $tag->name; ?> -->
								</div>
								<div class="flex-1"><?php echo $category->name; ?></div>
								<div class="icon">
								<a class="primary-btn" href="<?php echo base_url('category/edit/'. $category->id); ?>">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
										<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
										<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
									</svg>
								</a>
								</div>
							</li>
						<?php } ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="card mt-5">
				<div class="card-body">
				<div class="d-flex col">
					<h5 class="card-title flex-1">Tags</h5>
					<a class="primary-btn" href="<?php echo base_url('tag/add'); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
						<path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
						<path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
					</svg>
					</a>
					</div>
					<div class="internal-scroll">
					<ul class="list-group list-group-flush">
					<?php $i=1; foreach($Tags as $tag) { ?>
						<li class="list-group-item d-flex edit-item">
							<div class="">
								<input type="checkbox" name="tag[]" value="<?= $tag->id ?>"></option> &nbsp;
								<!-- <?php echo $tag->name; ?> -->
							</div>
							<div class="flex-1"><?php echo $tag->name; ?></div>
							<div class="icon">
							<a class="primary-btn" href="<?php echo base_url('tag/edit/'. $tag->id); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
									<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
									<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
								</svg>
							</a>
							</div>
						</li>
					<?php } ?>
					</ul>
					<div class="internal-scroll">
				</div>
			</div>
		</div>
	</div>
	</form>
	<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
	<script src="<?php echo base_url('assets/js/configureeditor.js'); ?>"></script>
	<script>
		$().ready(function(){
			$("#image").keyup(function () {
				$("#bImg").attr('src', $(this).val());
			})
		})
	</script>
