<div class="container">

	<h2>Update Coupon</h2>
	<?php if($this->session->flashdata('error')){ ?>
	<div class="alert alert-warning" role="alert">
		<?php echo $this->session->flashdata('error') ?>
	</div>
	<?php } ?>
	<form role="form" method="post" action="<?php echo base_url('coupon/editPost')?>" enctype="multipart/form-data">

		<input type="hidden" value="<?php echo $coupon[0]->id ?>" name="coupon_id">

		<div class="form-group mb-3">
				<label for="region">Region:</label>
				<select class="form-control" id="region" name="region">
					<option value="">Select One</option>
					<?php foreach($region as $reg) { ?>
					<option value="<?= $reg->code ?>" <?php if($reg->code == $coupon[0]->region) echo "selected" ?>><?= $reg->name ?></option>
					<?php } ?>
				</select>
			</div>


		<div class="form-group">
				<label for="code">Code:</label>
			</div>
			<div class="input-group mb-3">
				<span class="input-group-text" id="regioncode"><?php echo $coupon[0]->region ?></span>
				<input type="text" value="<?php echo $coupon[0]->code ?>" class="form-control" id="code" name="code">
			</div>

		<div class="form-group">
			<label for="code">Whole Saler:</label>
			<input type="text" value="<?php echo $coupon[0]->whole_saler ?>" class="form-control" id="whole_saler" name="whole_saler">
		</div>
		<div class="form-group mb-3">
				<label for="region">Price:</label>
				<select class="form-control" id="price" name="price">
					<option value="">Select One</option>
					<?php foreach($price as $pr) { ?>
					<option value="<?= $pr->id ?>" <?php if($pr->id == $coupon[0]->price) echo "selected" ?>><?= $pr->name ?></option>
					<?php } ?>
				</select>
			</div>
		<button type="submit" class="btn btn-primary ">Submit</button>
	</form>
</div>
<script>
	$().ready(function(){
		$("#region_id").change(function(){
			$("#regioncode").text($(this).val() + "-");
		});
	})
</script>