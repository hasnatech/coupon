<div class="container">
	<h2>Manage Post</h2>
	<a href="<?php echo base_url('blog/add') ?>" class="btn btn-primary">New Post</a>
	<br><br>
	<?php if($this->session->flashdata('success')){ ?>
	<div class="alert alert-success">
		<strong><span class="glyphicon glyphicon-ok"></span>
			<?php echo $this->session->flashdata('success'); ?></strong>
	</div>
	<?php } ?>

	<?php if(!empty($blogs)) {?>
	<!-- <table class="table table-hover">
		<thead>
			<tr>
				<th>SL No</th>
				<th>title</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1; foreach($blogs as $blog) { ?>
			<tr>
				<td> <?php echo $i; ?> </td>
				<td> <a href="<?php echo base_url('blog/view/')?><?php echo $blog->id?>"> <?php echo $blog->title ?> </a>
				</td>

				<td>
					<a href="<?php echo base_url('blog/edit/')?><?php echo $blog->id?>">Edit</a>
					<a href="<?php echo base_url('blog/delete/')?><?php echo $blog->id?>"
						onclick="return confirm('are you sure to delete')">Delete</a>
				</td>

			</tr>
			<?php $i++; } ?>
		</tbody>
	</table> -->
	<div class="d-flex flex-wrap">
		<?php $i=1; foreach($blogs as $blog) { ?>
			<div class="card" style="width: 18rem; margin-right:20px; margin-bottom:20px;">
				<?php if($blog->image){?>
				<img src="<?php echo $blog->image?>" class="card-img-top" alt="">
				<?php } ?>
				<div class="card-body">
					<h5 class="card-title"> <?php echo $blog->title ?></h5>
					<div class="card-text"><?php echo $blog->content ?></div>
					<a class="btn btn-sm btn-primary"
						href="<?php echo base_url('blog/edit/') . $blog->id ?>"
					>Edit</a>
				</div>
			</div>
		<?php $i++; } ?>
	</div>
	<?php } else {?>
	<div class="alert alert-info" role="alert">
		<strong>No Blogs Found!</strong>
	</div>
	<?php } ?>
</div>
