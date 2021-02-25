<div class="container">

	<h2>Add New User</h2>
	<?php if($this->session->flashdata('error')){ ?>
    	<div class="alert alert-warning" role="alert">
	    	<?php echo $this->session->flashdata('error') ?>
	    </div>
	<?php } ?>
	<form role="form" method="post" action="<?php echo base_url('user/addUserPost')?>">
		<div class="form-group">
			<label for="username">Username:</label>
			<input type="text" class="form-control" id="username" name="username">
		</div>
		<div class="form-group">
			<label for="password">Password:</label>
			<input type="password" class="form-control" id="password" name="password">
		</div>
		<div class="form-group">
			<label for="email">Email:</label>
			<input type="email" class="form-control" id="email" name="email">
		</div>
		<div class="form-group">
			<label for="firstname">Firstname:</label>
			<input type="text" class="form-control" id="firstname" name="firstname">
		</div>
		<div class="form-group">
			<label for="lastname">Lastname:</label>
			<input type="text" class="form-control" id="lastname" name="lastname">
		</div>
		<div class="form-group">
			<label for="active">Active:</label>
			<input type="checkbox" name="active" value="checked">
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>

</div>
