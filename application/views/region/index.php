<div class="container">
	<h2>Manage Region</h2>
	<a href="<?php echo base_url('region/add') ?>" class="btn btn-primary">New Region</a>
	<br><br>
	<?php if($this->session->flashdata('success')){ ?>
	<div class="alert alert-success">
		<strong><span class="glyphicon glyphicon-ok"></span>
			<?php echo $this->session->flashdata('success'); ?></strong>
	</div>
	<?php } ?>

	<?php if(!empty($region)) {?>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>SL No</th>
				<th>Name</th>
				<th>Code</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1; foreach($region as $reg) { ?>
			<tr>
				<td> <?php echo $i; ?> </td>
				<td> <?php echo $reg->name ?></td>
				<td> <?php echo $reg->code ?></td>
				<td>
					<!-- <a href="<?php echo base_url('region/edit/')?><?php echo $reg->id ?>">
						<?php if($reg->status==0){ echo "Activate"; } else { echo "Deactivate"; } ?></a> -->
					<a href="<?php echo base_url('region/edit/')?><?php echo $reg->id?>">Edit</a>
					<a href="<?php echo base_url('region/delete/')?><?php echo $reg->id?>"
						onclick="return confirm('are you sure to delete')">Delete</a>
				</td>

			</tr>
			<?php $i++; } ?>
		</tbody>
	</table>
	<?php } else {?>
	<div class="alert alert-info" role="alert">
		<strong>No Regions Found!</strong>
	</div>
	<?php } ?>
</div>
