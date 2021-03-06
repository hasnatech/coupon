<div class="container">

	<h2>Update Region</h2>
	<?php if($this->session->flashdata('error')){ ?>
    	<div class="alert alert-warning" role="alert">
	    	<?php echo $this->session->flashdata('error') ?>
	    </div>
	<?php } ?>
	<form role="form" method="post" action="<?php echo site_url('region/editRegionPost')?>" enctype="multipart/form-data">
		<input type="hidden" value="<?php echo $region[0]->id ?>" name="region_id">
		<div class="form-group mb-3">
			<label for="name">Name:</label>
			<input type="text" value="<?php echo $region[0]->name ?>" class="form-control" id="name" name="name">
		</div>
		<div class="form-group mb-3">
			<label for="name">Code:</label>
			<input type="text" max="2" min="2" value="<?php echo $region[0]->code ?>" class="form-control" id="code" name="code" placeholder="Eg: US for United States America">
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>
