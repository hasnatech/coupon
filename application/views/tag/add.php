<div class="container">

	<h2>Add New Tag</h2>
	<?php if($this->session->flashdata('error')){ ?>
    	<div class="alert alert-warning" role="alert">
	    	<?php echo $this->session->flashdata('error') ?>
	    </div>
	<?php } ?>
	<form role="form" method="post" action="<?php echo base_url('tag/addPost')?>">
		<div class="form-group">
			<label for="username">Name:</label>
			<input type="text" class="form-control" id="name" name="name">
		</div>
		<button type="submit" class="btn btn-primary mt-3">Submit</button>
	</form>

</div>
