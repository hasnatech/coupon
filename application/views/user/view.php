<div class="container">
    <h2>User Details</h2>
	<div class="row">
		<div class="col-xs-12 col-md-10 well">
			Username : <?php echo $user[0]->username ?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-md-10 well">
			Email : <?php echo $user[0]->email ?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-md-10 well">
			Firstname : <?php echo $user[0]->firstname ?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-md-10 well">
			Lastname : <?php echo $user[0]->lastname ?>
		</div>
    </div>
    <div class="space-50"></div>
<div>
    <a href="<?php echo base_url('/user') ?>" class="btn btn-warning">Back </a>
    <a href="<?php echo base_url('/user/edit/') ?><?php echo $user[0]->id ?>" class="btn btn-primary">Edit </a>
</div>

</div>
