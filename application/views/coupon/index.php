<div class="container">
	<div class="float-end">
		<a id="export" href="<?php echo base_url('coupon/export') ?>" class="btn btn-success">Export</a>
	</div>
	<h2>Manage Coupon</h2>
	<a href="<?php echo base_url('coupon/add') ?>" class="btn btn-primary">New Coupon</a>
	<br><br>
	<?php if($this->session->flashdata('success')){ ?>
	<div class="alert alert-success">
		<strong><span class="glyphicon glyphicon-ok"></span>
			<?php echo $this->session->flashdata('success'); ?></strong>
	</div>
	<?php } ?>

	<?php if(!empty($coupons)) {?>
	<!-- <table id="datatable" class="table table-hover">
		<thead>
			<tr>
				<th>SL No</th>
				<th>Code</th>
				<th>Price</th>
				<th>Issued</th>
				<th>Issued Date</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1; foreach($coupons as $coupon) { ?>
			<tr>
				<td> <?php echo $i; ?> </td>
				<td> <?php echo $coupon->region . "-".$coupon->code ?></td>
				<td> <?php echo $coupon->price_text[0]->name; ?></td>
				<td>
					<?php if ($coupon->issued == 1) { ?> 
					<div class="badge bg-success ">Issued</div> </td>
					<?php } else {?>
					<div class="badge bg-warning text-dark">Available</div> </td>
					<?php } ?>
				<td> <?php echo $coupon->issued_date ?></td>
				<td>
				<?php if ($coupon->issued != 1) { ?> 
					<a href="<?php echo site_url('coupon/edit/')?><?php echo $coupon->id?>">Edit</a>
					<a href="<?php echo site_url('coupon/delete/')?><?php echo $coupon->id?>"
						onclick="return confirm('are you sure to delete')">Delete</a>
				<?php } ?>
				</td>

			</tr>
			<?php $i++; } ?>
		</tbody>
	</table> -->
	<table id="datatable" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>SL No</th>
				<th>Code</th>
				<th>Price</th>
				<th>Issued</th>
				<th>Issued Date</th>
				<th>Actions</th>
			</tr>
		</thead>
	</table>
	<?php } else {?>
	<div class="alert alert-info" role="alert">
		<strong>No Coupons Found!</strong>
	</div>
	<?php } ?>

	<script>
		$().ready(function (){

	
		var table = $('#datatable').DataTable({
			"language": {                
            	"infoFiltered": ""
        	},
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "<?php echo base_url('coupon/fetch') ?>",
				type: "POST"
			},
			"columnDefs": [{
				"targets": [0,1,2,3,4,5],
				"orderable": false
			}]

		});

		$("#export").click(function(e){
			e.preventDefault();
			var form = $('<form></form>');
			form.attr("method", "post");
			form.attr("action", "<?php echo base_url('coupon/export') ?>");
			var parameters = table.page.info();
			var search = $("#datatable_wrapper input[type='search']").val();
			if(search != ''){
				parameters.search = search;
			}
			$.each(parameters, function(key, value) {
				var field = $('<input></input>');

				field.attr("type", "hidden");
				field.attr("name", key);
				field.attr("value", value);

				form.append(field);
			});
			$(document.body).append(form);
			form.submit();
		});
	});
	</script>
</div>
