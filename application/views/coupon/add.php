<div class="container">
	<h2>Add Coupon</h2>
	<?php if($this->session->flashdata('error')){ ?>
	<div class="alert alert-warning" role="alert">
		<?php echo $this->session->flashdata('error') ?>
	</div>
	<?php } ?>
	<div class="col-lg-4">
		<form role="form" method="post" action="<?php echo site_url('coupon/addCouponPost')?>">
			<div class="form-group mb-3">
				<label for="region">Region:</label>
				<select class="form-control" id="region" name="region">
					<option value="">Select One</option>
					<?php foreach($region as $reg) { ?>
					<option value="<?= $reg->code ?>"><?= $reg->name ?></option>
					<?php } ?>
				</select>
			</div>

			<div class="form-group">
				<label for="code">Code:</label>
			</div>
			<div class="input-group mb-3">
				<span class="input-group-text" id="regioncode">-</span>
				<input type="text" class="form-control" id="code" name="code">
			</div>
			<!-- <div class="form-group mb-3">
				<label for="code">Code:</label>
				<input type="text" class="form-control" id="code" name="code">
			</div> -->


			<div class="form-group mb-3">

				<label for="region">Price:</label>
				<select class="form-control" id="price" name="price">
					<option value="">Select One</option>
					<?php foreach($price as $pr) { ?>
					<option value="<?= $pr->id ?>"><?= $pr->name ?></option>
					<?php } ?>
				</select>
			</div>


			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>
<script>
	$().ready(function () {
		$("#region").change(function () {
			$("#regioncode").text($(this).val() + "-");
		});
	})

</script>
