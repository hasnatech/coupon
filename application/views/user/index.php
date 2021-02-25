<div class="container">
    <h2>Manage User</h2>
    <a href="<?php echo base_url('user/add') ?>" class="btn btn-primary">Add User</a>
    <br><br>
	<?php if($this->session->flashdata('success')){ ?>
	<div class="alert alert-success">
		<strong><span class="glyphicon glyphicon-ok"></span>
			<?php echo $this->session->flashdata('success'); ?></strong>
	</div>
	<?php } ?>

	<?php if(!empty($users)) {?>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>SL No</th>
				<th>username</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1; foreach($users as $user) { ?>
			<tr>
				<td> <?php echo $i; ?> </td>
				<td> <a href="<?php echo base_url('user/view/')?><?php echo $user->id?>"> <?php echo $user->username ?>
					</a> </td>

				<td>
					<!-- <a href="<?php echo site_url()?>change-status-user/<?php echo $user->id ?>">
						<?php if($user->active==0){ echo "Activate"; } else { echo "Deactivate"; } ?></a> -->
					<a href="<?php echo base_url('user/edit/')?><?php echo $user->id?>">Edit</a>
					<a href="<?php echo base_url('user/delete/')?><?php echo $user->id?>"
						onclick="return confirm('are you sure to delete')">Delete</a>
				</td>

			</tr>
			<?php $i++; } ?>
		</tbody>
	</table>
	<?php } else {?>
	<div class="alert alert-info" role="alert">
		<strong>No Users Found!</strong>
	</div>
	<?php } ?>
</div>
