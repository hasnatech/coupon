<div class="container">

    <h2>Update Category</h2>
    <?php if($this->session->flashdata('error')){ ?>
    	<div class="alert alert-warning" role="alert">
	    	<?php echo $this->session->flashdata('error') ?>
	    </div>
	<?php } ?>
	<form role="form" method="post" action="<?php echo base_url('category/editPost')?>" enctype="multipart/form-data">
		<input type="hidden" value="<?php echo $category[0]->id ?>" name="category_id">
		<div class="form-group">
            <label for="username">Name:
			<input type="text" value="<?php echo $category[0]->name ?>" class="form-control" id="username"
				name="name"> 
        </div>
		<button type="submit" class="btn btn-primary mt-3">Submit</button>

		<a class="btn btn-danger mt-3" href="<?php echo base_url('category/delete/')?><?php echo $category[0]->id?>"
						onclick="return confirm('Are you sure to delete')">Delete</a>
	</form>
</div>
