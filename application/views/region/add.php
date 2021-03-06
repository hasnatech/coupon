<div class="container">
	<h2>Add Region</h2>
	<?php if($this->session->flashdata('error')){ ?>
    	<div class="alert alert-warning" role="alert">
	    	<?php echo $this->session->flashdata('error') ?>
	    </div>
	<?php } ?>
	<form role="form" method="post" action="<?php echo base_url('region/addRegionPost')?>">
		<div class="form-group mb-3">
			<label for="name">Name:</label>
			<input type="text" class="form-control" id="name" name="name">
		</div>
		<div class="form-group mb-3">
			<label for="name">Code:</label>
			<input type="text" max="2" min="2" class="form-control" id="code" name="code" placeholder="Eg: US for United States America">
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>
